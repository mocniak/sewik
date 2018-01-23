<?php
namespace Sewik\Domain;

class Report
{
    private $table;

    public function __construct(array $table)
    {
        $this->table = $table;
    }

    public function getTable(): array
    {
        return $this->table;
    }
}