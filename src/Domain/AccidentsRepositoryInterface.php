<?php

namespace Sewik\Domain;

interface AccidentsRepositoryInterface
{
    /**
     * @param Filter $filter
     * @return Accident[]
     */
    public function findFilteredAccidents(Filter $filter): array;

    public function getAccident(int $id): Accident;
}