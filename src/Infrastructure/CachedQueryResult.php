<?php

namespace Sewik\Infrastructure;

use Sewik\Domain\Query;
use Sewik\Domain\QueryResult;

class CachedQueryResult
{
    private $queryResult;
    private $queryHash;

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