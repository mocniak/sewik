<?php

namespace App\Controller;

use Ramsey\Uuid\Uuid;
use Sewik\Domain\EditTemplateRequest;
use Sewik\Domain\QueryTemplateService;
use Sewik\Domain\TemplateRepositoryInterface;
use Sewik\Infrastructure\FormType\TemplateForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        /** @var TemplateRepositoryInterface $templateRepository */
        $templateRepository = $this->container->get('sewik.template_repository');
        $templates = $templateRepository->getAll();

        return $this->render('admin/dashboard.html.twig', [
            'templates' => $templates
        ]);
    }

    public function createTemplate()
    {
        /** @var QueryTemplateService $templateService */
        $templateService = $this->container->get('sewik.template_service');
        $result = $templateService->createNewTemplate();

        return $this->redirectToRoute('edit_template', ['id' => $result->getTemplateId()->toString()]);
    }

    public function editTemplate($id, Request $request)
    {
        /** @var QueryTemplateService $templateService */
        $templateService = $this->container->get('sewik.template_service');
        $template = $templateService->getTemplate(Uuid::fromString($id));
        $editTemplateRequest = EditTemplateRequest::fromTemplate($template);
        $form = $this->createForm(TemplateForm::class, $editTemplateRequest);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $templateService->editTemplate($editTemplateRequest);

            return $this->redirectToRoute('edit_template', ['id' => $template->getId()->toString()]);
        }

        return $this->render('admin/editTemplate.html.twig', ['form' => $form->createView()]);
    }
}