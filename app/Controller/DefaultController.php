<?php

namespace App\Controller;

use Ramsey\Uuid\Uuid;
use Sewik\Domain\AccidentsFilterDto;
use Sewik\Domain\AccidentsRepositoryInterface;
use Sewik\Domain\ListAccidentsRequest;
use Sewik\Domain\SewikService;
use Sewik\Domain\ShowAllReportsRequest;
use Sewik\Infrastructure\FormType\FilterForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function index()
    {
        return new Response('index');
    }

    public function searchPage(Request $request)
    {
        $filterDto = new AccidentsFilterDto();
        $form = $this->createForm(FilterForm::class, $filterDto);
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
}