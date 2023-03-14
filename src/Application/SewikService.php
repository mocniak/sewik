<?php

namespace Sewik\Application;

use Ramsey\Uuid\UuidInterface;
use Sewik\Application\Request\ListAccidentsRequest;
use Sewik\Application\Response\ListAccidentsResponse;
use Sewik\Application\Response\ShowAllReportResponse;
use Sewik\Application\Response\ShowAllReportsRequest;
use Sewik\Domain\AccidentsRepositoryInterface;
use Sewik\Domain\DatabaseInterface;
use Sewik\Domain\Dto\AccidentsFilterDto;
use Sewik\Domain\Dto\Report;
use Sewik\Domain\Exception\InvalidQueryException;
use Sewik\Domain\FilterFactory;
use Sewik\Domain\QueryFactory;
use Sewik\Domain\TemplateRepositoryInterface;

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
