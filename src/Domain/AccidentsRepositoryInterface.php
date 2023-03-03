<?php

namespace Sewik\Domain;

use Sewik\Domain\Entity\Accident;

interface AccidentsRepositoryInterface
{
    /**
     * @param Filter $filter
     * @return Accident[]
     */
    public function findFilteredAccidents(Filter $filter): array;

    public function getAccident(int $accidentID): Accident;
}
