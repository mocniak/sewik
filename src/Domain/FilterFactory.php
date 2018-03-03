<?php
namespace Sewik\Domain;

class FilterFactory
{
    public function createFromDto(AccidentsFilterDto $filterDto): Filter
    {
        $filters = [];
        if (null !== $filterDto->getVoivodeship()) {
            $filters[] = Filter::COLUMN_VOIVODESHIP . ' = \'' . $filterDto->getVoivodeship() . '\'';
        }
        if (null !== $filterDto->getLocality()) {
            $filters[] = Filter::COLUMN_LOCALITY . ' = \'' . $filterDto->getLocality() . '\'';
        }
        if (null !== $filterDto->getStreet()) {
            $filters[] = Filter::COLUMN_STREET . ' = \'' . $filterDto->getStreet() . '\'';
        }
        if (null !== $filterDto->getFromDate()) {
            $filters[] = Filter::COLUMN_DATE . ' >= \'' . $filterDto->getFromDate()->format('Y-m-d') . '\'';
        }
        if (null !== $filterDto->getToDate()) {
            $filters[] = Filter::COLUMN_DATE . ' <= \'' . $filterDto->getToDate()->format('Y-m-d') . '\'';
        }
        if (!empty($filterDto->getVehicleType())) {
            //this is to fix multiple value checkbox on frontend. need to be fixed in symfony form in the future
            $singleVehicleTypes = [];
            foreach ($filterDto->getVehicleType() as $vehicleType) {
                $vehicleTypes = explode(',', $vehicleType);
                $singleVehicleTypes = array_merge($singleVehicleTypes, $vehicleTypes);
            }
            $vehiclesInBraces = [];
            foreach ($singleVehicleTypes as $vehicleType) {
                $vehiclesInBraces[] = "'" . $vehicleType . "'";
            }
            $filters[] = "id IN (SELECT zszd_id FROM pojazdy WHERE rodzaj_pojazdu IN (" . implode(",", $vehiclesInBraces) . "))";
        }

        return new Filter($filters);
    }
}