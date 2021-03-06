<?php
namespace Sewik\Domain;

class ListAccidentsRequest
{
    private $accidentsFilter;

    public function __construct(AccidentsFilterDto $accidentsFilter)
    {
        $this->accidentsFilter = $accidentsFilter;
    }

    public function getAccidentsFilter(): AccidentsFilterDto
    {
        return $this->accidentsFilter;
    }
}