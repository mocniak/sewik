<?php

namespace Sewik\Infrastructure\Entity;

use Sewik\Domain\Dto\Query;
use Sewik\Domain\Dto\QueryResult;

class CachedQueryResult
{
    private readonly QueryResult$queryResult;
    private readonly string $queryHash;

    public function __construct(QueryResult $queryResult, Query $query)
    {
        $this->queryResult = $queryResult;
        $this->queryHash = sha1($query->getSqlQuery());
    }

    public function getQueryResult(): QueryResult
    {
        return $this->queryResult;
    }

    public function getQueryHash(): string
    {
        return $this->queryHash;
    }
}
