<?php

namespace Sewik\Infrastructure;

use Sewik\Domain\Query;
use Sewik\Domain\Report;

interface ReportCacheInterface
{
    public function findForQuery(Query $query): ?Report;

    public function add(Report $report, Query $query);
}
