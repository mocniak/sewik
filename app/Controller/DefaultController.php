<?php

namespace App\Controller;

use Sewik\Domain\SewikService;
use Sewik\Domain\ShowAllReportsRequest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
        $showAllReportsRequest = new ShowAllReportsRequest();

        $form = $this->createFormBuilder($showAllReportsRequest)
            ->add('voivodeship', TextType::class, ['required' => false, 'label' => 'Województwo'])
            ->add('locality', TextType::class, ['required' => false, 'label' => 'Miejscowość'])
            ->add('street', TextType::class, ['required' => false, 'label' => 'Ulica'])
            ->add('fromDate', DateType::class, ['required' => false, 'label' => 'Od dnia'])
            ->add('toDate', DateType::class, ['required' => false, 'label' => 'Do dnia'])
            ->add('save', SubmitType::class, array('label' => 'Wyświetl zdarzenia'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $showAllReportsRequest = $form->getData();
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
}