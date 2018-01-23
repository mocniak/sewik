<?php

namespace App\Controller;

use Sewik\Domain\SewikService;
use Sewik\Domain\ShowAllReportRequest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function index()
    {
        return new Response('index');
    }

    public function reports()
    {
        /** @var SewikService $sewikService */
        $sewikService = $this->container->get('sewik.service');
        $response = $sewikService->showAllReports(new ShowAllReportRequest());

        return $this->render('reports.html.twig', ['reports' => $response->getReports()]);
    }
}