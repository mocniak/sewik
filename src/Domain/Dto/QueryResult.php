<?php

namespace Sewik\Domain\Dto;

class QueryResult
{
    private array $table;
    private array $tableHeaders;
    private float $timeCost;

    public function __construct(array $table, array $tableHeaders, float $timeCost)
    {
        $this->table = $table;
        $this->tableHeaders = $tableHeaders;
        $this->timeCost = $timeCost;
    }

    public function getTable(): array
    {
        return $this->table;
    }

    public function getTableHeaders(): array
    {
        return $this->tableHeaders;
    }

    public function getTimeCost(): float
    {
        return $this->timeCost;
    }
}
