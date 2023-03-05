<?php

namespace Sewik\Domain;

use Ramsey\Uuid\UuidInterface;

class SewikService
{
    private $database;
    private $templateRepository;
    private $queryFactory;
    private $filterFactory;
    private $accidentsRepository;

    public function __construct(
        DatabaseInterface $database,
        TemplateRepositoryInterface $templateRepository,
        QueryFactory $factory,
        FilterFactory $filterFactory,
        AccidentsRepositoryInterface $accidentsRepository
    )
    {
        $this->database = $database;
        $this->templateRepository = $templateRepository;
        $this->queryFactory = $factory;
        $this->filterFactory = $filterFactory;
        $this->accidentsRepository = $accidentsRepository;
    }

    public function showAllReports(ShowAllReportsRequest $request)
    {
        $templates = $this->templateRepository->getAll();
        $filter = $this->filterFactory->createFromDto($request->getAccidentsFilter());
        $reports = [];
        foreach ($templates as $template) {
            $query = $this->queryFactory->createQuery($filter, $template);
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

    public function listAccidents(ListAccidentsRequest $request): ListAccidentsResponse
    {
        $filter = $this->filterFactory->createFromDto($request->getAccidentsFilter());
        $accidents = $this->accidentsRepository->findFilteredAccidents($filter);

        return  new ListAccidentsResponse($accidents);
    }

    public function showReport(UuidInterface $queryId, AccidentsFilterDto $filterDto): Report
    {
        $template = $this->templateRepository->get($queryId);
        $filter = $this->filterFactory->createFromDto($filterDto);
        $query = $this->queryFactory->createQuery($filter, $template);
        $queryResult = $this->database->executeQuery($query);
        return new Report(
            $template->getName(),
            $queryResult->getTable(),
            $queryResult->getTableHeaders(),
            $queryResult->getTimeCost()
        );
    }
}
