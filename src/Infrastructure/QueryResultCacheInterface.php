<?php

namespace Sewik\Infrastructure;

use Sewik\Domain\Dto\Query;
use Sewik\Domain\Dto\QueryResult;

interface QueryResultCacheInterface
{
    public function findForQuery(Query $query): ?QueryResult;

    public function add(QueryResult $report, Query $query);
}
