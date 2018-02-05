<?php
namespace Sewik\Domain;

class FilterFactory
{
    public function createFromDto(AccidentsFilterDto $filterDto): Filter
    {
        $filters = [];
        if (null !== $filterDto->getVoivodeship()) {
            $filters[] = Filter::COLUMN_VOIVODESHIP . ' = \'' . $filterDto->getVoivodeship().'\'';
        }
        if (null !== $filterDto->getLocality()) {
            $filters[] = Filter::COLUMN_LOCALITY . ' = \'' . $filterDto->getLocality().'\'';
        }
        if (null !== $filterDto->getStreet()) {
            $filters[] = Filter::COLUMN_STREET . ' = \'' . $filterDto->getStreet().'\'';
        }
        if (null !== $filterDto->getFromDate()) {
            $filters[] = Filter::COLUMN_DATE . ' >= \'' . $filterDto->getFromDate()->format('Y-m-d').'\'';
        }
        if (null !== $filterDto->getToDate()) {
            $filters[] = Filter::COLUMN_DATE . ' <= \'' . $filterDto->getToDate()->format('Y-m-d').'\'';
        }
        return new Filter($filters);
    }
}