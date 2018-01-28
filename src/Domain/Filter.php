<?php
namespace Sewik\Domain;

class Filter
{
    const ACCIDENTS_PLACEHOLDER = '%zdarzenie_filter%';
    const COLUMN_LOCALITY = 'miejscowosc';
    const COLUMN_DATE = 'data_zdarz';

    private $accidentsFilter;

    public function __construct(array $accidentsFilter)
    {
        $this->accidentsFilter = $accidentsFilter;
    }

    public function getAccidentsFilter(): array
    {
        return $this->accidentsFilter;
    }
}