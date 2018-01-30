<?php

namespace App\Controller;

use Sewik\Domain\SewikService;
use Sewik\Domain\ShowAllReportsRequest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function index()
    {
        return new Response('index');
    }

    public function showFilteredReports()
    {
        $request = new ShowAllReportsRequest();

        $form = $this->createFormBuilder($request)
            ->add('voivodeship', TextType::class)
            ->add('locality', TextType::class)
            ->add('street', TextType::class)
            ->add('fromDate', DateType::class)
            ->add('toDate', DateType::class)
            ->add('save', SubmitType::class, array('label' => 'Wyświetl zdarzenia'))
            ->getForm();

        if ($form->isSubmitted() && $form->isValid()) {
            $request = $form->getData();
            /** @var SewikService $sewikService */
            $sewikService = $this->container->get('sewik.service');
            $response = $sewikService->showAllReports($request);

            return $this->render('reports.html.twig', ['reports' => $response->getReports()]);
        }

        return $this->render('filterAccidentsForm.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}