<?php

namespace Sewik\Infrastructure;


use Sewik\Domain\Query;
use Sewik\Domain\Report;

class CachedReport
{
    private $report;
    private $queryHash;

    public function __construct(Report $report, Query $query)
    {
        $this->report = $report;
        $this->queryHash = sha1($query->getSqlQuery());
    }

    public function getReport(): Report
    {
        return $this->report;
    }

    public function getQueryHash(): string
    {
        return $this->queryHash;
    }
}