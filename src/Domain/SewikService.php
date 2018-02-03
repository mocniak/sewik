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
            try {
                $queryResult = $this->database->executeQuery($query);
            } catch (InvalidQueryException $exception) {
                continue;
            }
            $reports[] = new Report(
                $template->getName(),
                $queryResult->getTable(),
                $queryResult->getTableHeaders(),
                $queryResult->getTimeCost()
            );
        }
        return new ShowAllReportResponse($reports);
    }
}