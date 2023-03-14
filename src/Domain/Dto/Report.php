<?php

namespace Sewik\Domain\Dto;

class Report
{
    private $table;
    private $tableHeaders;
    private $timeCost;
    private $title;

    public function __construct(string $title, array $table, array $tableHeaders, float $timeCost)
    {
        $this->title = $title;
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

    public function getTitle(): string
    {
        return $this->title;
    }
}
