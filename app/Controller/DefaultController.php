<?php

namespace App\Controller;

use Sewik\Domain\AccidentsFilterDto;
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
        $formDto = new AccidentsFilterDto();
        $form = $this->createForm(FilterForm::class, $formDto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $showAllReportsRequest = new ShowAllReportsRequest($formDto);
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
    public function showAccidents() {

    }
}