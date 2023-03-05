<?php

namespace Sewik\Infrastructure\Controller;

use Ramsey\Uuid\Uuid;
use Sewik\Domain\AccidentsFilterDto;
use Sewik\Domain\AccidentsRepositoryInterface;
use Sewik\Domain\ListAccidentsRequest;
use Sewik\Domain\Query;
use Sewik\Domain\Report;
use Sewik\Domain\SewikService;
use Sewik\Infrastructure\FormType\FilterForm;
use Sewik\Infrastructure\MysqlReports\AccidentsDeadAndInjuredByYearReport;
use Sewik\Infrastructure\MysqlReports\OptimizedAccidentsDeadAndInjuredByYearReport;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController
{
    public function index()
    {
        return $this->render('homepage.html.twig');
    }

    public function searchPage(Request $request)
    {
        $filterDto = new AccidentsFilterDto();
        $form = $this->createForm(FilterForm::class, $filterDto);
        $form->add('categories', ChoiceType::class, [
            'label' => 'Typ statystyk',
            'choices' => [
                'Czas zdarzeń' => 'Czas zdarzeń',
                'Lokalizacja zdarzeń' => 'Lokalizacja zdarzeń',
                'Rodzaj zdarzeń' => 'Rodzaj zdarzeń',
                'Miejsce zdarzeń' => 'Miejsce zdarzeń',
                'Pojazdy' => 'Pojazdy',
                'Przyczyny zdarzeń' => 'Przyczyny zdarzeń',
                'Uczestnicy zdarzeń' => 'Uczestnicy zdarzeń',
            ],
            'mapped' => false
        ]);
        $form->add('accidents', SubmitType::class, array('label' => 'Wyświetl zdarzenia'));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get('accidents')->isClicked()) {
                $listAccidentsRequest = new ListAccidentsRequest($filterDto);
                /** @var SewikService $sewikService */
                $sewikService = $this->container->get('sewik.service');
                $response = $sewikService->listAccidents($listAccidentsRequest);

                return $this->render('accidentList.html.twig', [
                    'accidents' => $response->getAccidents(),
                    'form' => $form->createView(),
                ]);
            } else if ($form->get('reports')->isClicked()) {
                return $this->render('reports.html.twig', [
                    'category' => $form->get('categories')->getData(),
                    'form' => $form->createView(),
                ]);
            }
        }
        return $this->render('filterAccidentsForm.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function showReport($originalRequest, string $queryId)
    {
        $filterDto = new AccidentsFilterDto();
        $form = $this->createForm(FilterForm::class, $filterDto);
        $form->handleRequest($originalRequest);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var SewikService $sewikService */
            $sewikService = $this->container->get('sewik.service');
            $report = $sewikService->showReport(Uuid::fromString($queryId), $filterDto);
            return $this->render('report.html.twig', [
                'report' => $report,
            ]);
        }
        return new Response('invalid filter');
    }

    public function showAccident(int $id)
    {
        /** @var AccidentsRepositoryInterface $accidentRepository */
        $accidentRepository = $this->get('sewik.accident_repository');
        $accident = $accidentRepository->getAccident($id);

        if ($accident === null) return new Response('', 404);

        return $this->render('accidentPage.html.twig', [
            'accident' => $accident,
        ]);
    }

    public function singleReportPage(Request $request, string $id)
    {
        $filterDto = new AccidentsFilterDto();
        $form = $this->createForm(FilterForm::class, $filterDto);
        $form->add('categories', ChoiceType::class, [
            'label' => 'Typ statystyk',
            'choices' => [
                'Czas zdarzeń' => 'Czas zdarzeń',
                'Lokalizacja zdarzeń' => 'Lokalizacja zdarzeń',
                'Rodzaj zdarzeń' => 'Rodzaj zdarzeń',
                'Miejsce zdarzeń' => 'Miejsce zdarzeń',
                'Pojazdy' => 'Pojazdy',
                'Przyczyny zdarzeń' => 'Przyczyny zdarzeń',
                'Uczestnicy zdarzeń' => 'Uczestnicy zdarzeń',
            ],
            'mapped' => false
        ]);
        $form->add('accidents', HiddenType::class, ['mapped' => false]);
        $form->handleRequest($request);
        $sewikService = $this->container->get('sewik.service');
        $report = $sewikService->showReport(Uuid::fromString($id), $filterDto);
        return $this->render('singleReportPage.html.twig', [
            'report' => $report,
            'form' => $form->createView(),
        ]);
    }

    public function contactPage()
    {
        return $this->render('contactPage.html.twig');
    }

    public function test(){
        $database = $this->container->get('sewik.database');
        $queries = [
            new OptimizedAccidentsDeadAndInjuredByYearReport(),
            new AccidentsDeadAndInjuredByYearReport(),
        ];
        $reports = [];
        foreach ($queries as $query) {
            $result = $database->executeQuery(new Query($query->getSql()));
            $reports[] = new Report(
                get_class($query),
                $result->getTable(),
                $result->getTableHeaders(),
                $result->getTimeCost()
            );
        }
        return $this->render('many_reports.html.twig', [
            'reports' => $reports,
        ]);
    }
}
