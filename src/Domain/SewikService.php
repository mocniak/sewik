<?php
namespace Sewik\Domain;

class SewikService
{
    private $database;
    private $templateRepository;
    private $factory;
    private $filterFactory;

    public function __construct(
        DatabaseInterface $database,
        TemplateRepositoryInterface $templateRepository,
        QueryFactory $factory,
        FilterFactory $filterFactory
    )
    {
        $this->database = $database;
        $this->templateRepository = $templateRepository;
        $this->factory = $factory;
        $this->filterFactory = $filterFactory;
    }

    public function showAllReports(ShowAllReportsRequest $request)
    {
        $templates = $this->templateRepository->getAll();
        $filter = $this->filterFactory->createFromRequest($request);
        $reports = [];
        foreach ($templates as $template) {
            $query = $this->factory->createQuery($filter, $template);
            $reports[] = $this->database->executeQuery($query);
        }
        return new ShowAllReportResponse($reports);
    }
}