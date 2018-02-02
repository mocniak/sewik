<?php
namespace Sewik\Domain;

class QueryTemplateService
{
    private $templateRepository;

    public function __construct(TemplateRepositoryInterface $templateRepository)
    {
        $this->templateRepository = $templateRepository;
    }

    public function createNewTemplate(CreateTemplateRequest $request)
    {
        $template = new QueryTemplate('SELECT COUNT(*) from zdarzenie;', 'Nowy Raport');
        $this->templateRepository->save($template);
        return new CreateTemplateResponse($template->getId());
    }
}