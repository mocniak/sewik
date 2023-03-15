<?php

namespace Sewik\Infrastructure\MysqlReports;

use Sewik\Domain\Dto\Query;
use Sewik\Domain\Dto\QueryResult;
use Sewik\Infrastructure\MysqlDatabase;

class AccidentsPerYearReport
{
    public function __construct(private readonly MysqlDatabase $database)
    {
    }

    public function generate(): QueryResult {
        return $this->database->executeQuery(
            new Query('SELECT YEAR(DATA_ZDARZ) as rok, COUNT(1) as zdarzenia FROM accident GROUP BY rok;')
        );
    }
}
