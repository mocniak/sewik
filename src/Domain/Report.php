<?php
namespace Sewik\Domain;

class Report
{
    private $table;
    private $timeCost;

    public function __construct(array $table, float $timeCost)
    {
        $this->table = $table;
        $this->timeCost = $timeCost;
    }

    public function getTable(): array
    {
        return $this->table;
    }

    public function getTimeCost(): float
    {
        return $this->timeCost;
    }
}