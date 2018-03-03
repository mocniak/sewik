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
        if (null !== $filterDto->getCounty()) {
            $filters[] = 'POWIAT = \'' . $filterDto->getCounty() . '\'';
        }
        if (null !== $filterDto->getAccidentSite()) {
            $filters[] = 'chmz_kod = \'' . $filterDto->getAccidentSite() . '\'';
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
        if (!empty($filterDto->getInjury())) {
            //this is to fix multiple value checkbox on frontend. need to be fixed in symfony form in the future
            $injuries = explode(',', $filterDto->getInjury());

            $injuriesInBraces = [];
            foreach ($injuries as $injury) {
                $injuriesInBraces[] = "'" . $injury . "'";
            }
            $filters[] = "id IN (SELECT zszd_id FROM uczestnicy WHERE stuc_kod IN (" . implode(",", $injuriesInBraces) . "))";
        }

        if (null !== $filterDto->getDriversCause()) {
            $filters[] = "id IN (SELECT zszd_id FROM uczestnicy WHERE spsz_kod IN ('" . $filterDto->getDriversCause() . "'))";
        }

        if (null !== $filterDto->getPedestriansCause()) {
            $filters[] = "id IN (SELECT zszd_id FROM uczestnicy WHERE sppi_kod IN ('" . $filterDto->getPedestriansCause() . "'))";
        }
        if (null !== $filterDto->getPedestriansPresence()) {
            if ($filterDto->getPedestriansPresence()) {
                $filters[] = "id IN (SELECT zszd_id FROM uczestnicy WHERE zspo_id IS NULL)";
            } else {
                $filters[] = "id IN (SELECT zszd_id FROM uczestnicy WHERE zspo_id IS NOT NULL)";
            }
        }

        return new Filter($filters);
    }
}