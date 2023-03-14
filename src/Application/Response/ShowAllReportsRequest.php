<?php

namespace Sewik\Application\Response;

use Sewik\Domain\Dto\AccidentsFilterDto;

class ShowAllReportsRequest
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
