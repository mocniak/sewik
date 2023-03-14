<?php

namespace Sewik\Domain\Dto;

class Query
{
    private $sqlQuery;

    public function __construct(string $sqlQuery)
    {
        $this->sqlQuery = $sqlQuery;
    }

    public function getSqlQuery(): string
    {
        return $this->sqlQuery;
    }
}
