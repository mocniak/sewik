<?php

namespace Sewik\Infrastructure\Controller;

use Ramsey\Uuid\Uuid;
use Sewik\Application\Request\EditTemplateRequest;
use Sewik\Domain\QueryTemplateService;
use Sewik\Domain\TemplateRepositoryInterface;
use Sewik\Infrastructure\FormType\TemplateForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends AbstractController
{
    public function __construct(
        private readonly TemplateRepositoryInterface $templateRepository,
        private readonly QueryTemplateService $templateService,
    )
    {
    }

    public function dashboard()
    {
        $templates = $this->templateRepository->getAll();

        return $this->render('admin/dashboard.html.twig', [
            'templates' => $templates
        ]);
    }

    public function createTemplate()
    {
        $result = $this->templateService->createNewTemplate();

        return $this->redirectToRoute(
            'edit_template',
            ['id' => $result->getTemplateId()->toString()]
        );
    }

    public function editTemplate($id, Request $request)
    {
        $template = $this->templateService->getTemplate(Uuid::fromString($id));
        $editTemplateRequest = EditTemplateRequest::fromTemplate($template);
        $form = $this->createForm(TemplateForm::class, $editTemplateRequest);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->templateService->editTemplate($editTemplateRequest);

            return $this->redirectToRoute(
                'edit_template',
                ['id' => $template->getId()->toString()]
            );
        }

        return $this->render(
            'admin/editTemplate.html.twig',
            ['form' => $form->createView()]
        );
    }
}
