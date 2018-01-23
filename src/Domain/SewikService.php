<?php
namespace Sewik\Domain;

class SewikService
{
    private $database;
    private $queryRepository;

    public function __construct(DatabaseInterface $database, QueryRepositoryInterface $queryRepository)
    {
        $this->database = $database;
        $this->queryRepository = $queryRepository;
    }

    public function showAllReports(ShowAllReportRequest $request)
    {
        $this->database->filter(new Filter());
        $queries = $this->queryRepository->getAll();
        $reports = [];
        foreach ($queries as $query) {
            $reports[] = $this->database->executeQuery($query);
        }
        return new ShowAllReportResponse($reports);
    }
}