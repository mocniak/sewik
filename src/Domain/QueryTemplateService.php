<?php
namespace Sewik\Domain;

use Ramsey\Uuid\UuidInterface;

class QueryTemplateService
{
    private $templateRepository;

    public function __construct(TemplateRepositoryInterface $templateRepository)
    {
        $this->templateRepository = $templateRepository;
    }

    public function createNewTemplate()
    {
        $template = new QueryTemplate(
            'SELECT COUNT(*) FROM zdarzenie ' . Filter::ACCIDENTS_PLACEHOLDER . ';',
            'Nowy Raport',
            QueryTemplate::CATEGORY_OTHER);
        $this->templateRepository->save($template);

        return new CreateTemplateResponse($template->getId());
    }

    public function getTemplate(UuidInterface $templateId): QueryTemplate
    {
        $template = $this->templateRepository->get($templateId);

        return $template;
    }

    public function editTemplate(EditTemplateRequest $request): EditTemplateResult
    {
        $template = $this->templateRepository->get($request->templateId);
        $template->setName($request->name);
        $template->setSqlQuery($request->sqlQuery);
        $template->setCategory($request->category);
        $this->templateRepository->save($template);

        return new EditTemplateResult();
    }
}