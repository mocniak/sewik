<?php

namespace Sewik\Infrastructure\MysqlReports;

use Sewik\Infrastructure\MysqlDatabase;

class AccidentsPerYearReport
{
    public function __construct(private readonly MysqlDatabase $database)
    {
    }

    public function generate(): array {
        return [];
    }
}
