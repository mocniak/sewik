<?php

namespace App\Controller;

use Sewik\Domain\AccidentsFilterDto;
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

    public function showFilteredReports(Request $request)
    {
        $filterDto = new AccidentsFilterDto();
        $form = $this->createForm(FilterForm::class, $filterDto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $showAllReportsRequest = new ShowAllReportsRequest($filterDto);
            /** @var SewikService $sewikService */
            $sewikService = $this->container->get('sewik.service');
            $response = $sewikService->showAllReports($showAllReportsRequest);

            return $this->render('reports.html.twig', [
                'reports' => $response->getReports(),
                'form' => $form->createView(),
            ]);
        }

        return $this->render('filterAccidentsForm.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    public function accidentList(Request $request) {
        $filterDto = new AccidentsFilterDto();
        $form = $this->createForm(FilterForm::class, $filterDto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $listAccidentsRequest = new ListAccidentsRequest($filterDto);
            /** @var SewikService $sewikService */
            $sewikService = $this->container->get('sewik.service');
            $response = $sewikService->listAccidents($listAccidentsRequest);

            return $this->render('accidentList.html.twig', [
                'accidents' => $response->getAccidents(),
                'form' => $form->createView(),
            ]);
        }

        return $this->render('filterAccidentsForm.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}