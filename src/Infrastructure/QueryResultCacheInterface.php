<?php

namespace Sewik\Infrastructure;

use Sewik\Domain\Query;
use Sewik\Domain\QueryResult;

interface QueryResultCacheInterface
{
    public function findForQuery(Query $query): ?QueryResult;

    public function add(QueryResult $report, Query $query);
}
