<?php
namespace Sewik\Domain;

class FilterFactory
{
    public function createFromDto(AccidentsFilterDto $filterDto): Filter
    {
        $filters = [];
        if (null !== $filterDto->voivodeship) {
            $filters[] = Filter::COLUMN_VOIVODESHIP . ' = \'' . $filterDto->voivodeship . '\'';
        }
        if (null !== $filterDto->locality) {
            $filters[] = Filter::COLUMN_LOCALITY . ' = \'' . $filterDto->locality . '\'';
        }
        if (null !== $filterDto->county) {
            $filters[] = 'POWIAT = \'' . $filterDto->county . '\'';
        }
        if (null !== $filterDto->accidentSite) {
            $filters[] = 'chmz_kod = \'' . $filterDto->accidentSite . '\'';
        }
        if (null !== $filterDto->accidentType) {
            $filters[] = 'szrd_kod = \'' . $filterDto->accidentType . '\'';
        }
        if (null !== $filterDto->light) {
            $filters[] = 'szos_kod = \'' . $filterDto->light . '\'';
        }
        if (null !== $filterDto->weather) {
            $filters[] = "sswa_kod = '" . $filterDto->weather . "'";
        }
        if (null !== $filterDto->pavement) {
            $filters[] = " = '" . $filterDto->pavement . "'";
        }
        if (null !== $filterDto->roadType) {
            $filters[] = "rodr_kod = '" . $filterDto->roadType . "'";
        }
        if (null !== $filterDto->trafficLights) {
            $filters[] = "sysw_kod = '" . $filterDto->trafficLights . "'";
        }
        if (null !== $filterDto->surfaceMarking) {
            $filters[] = "ozpo_kod = '" . $filterDto->surfaceMarking . "'";
        }
        if (null !== $filterDto->intersectionType) {
            $filters[] = "skrz_kod = '" . $filterDto->intersectionType . "'";
        }
        if (null !== $filterDto->builtUpArea) {
            $filters[] = " = '" . $filterDto->builtUpArea . "'";
        }
        if (null !== $filterDto->otherCause) {
            $filters[] = "spip_kod = '" . $filterDto->otherCause . "'";
        }
        if (null !== $filterDto->surfaceCondition) {
            $filters[] = "stna_kod = '" . $filterDto->surfaceCondition . "'";
        }
        if (null !== $filterDto->roadGeometry) {
            $filters[] = "geod_kod = '" . $filterDto->roadGeometry . "'";
        }
        if (null !== $filterDto->street) {
            $filters[] = "(ulica_adres = '$filterDto->street' OR ulica_skrzyz = '$filterDto->street')";
        }
        if (null !== $filterDto->fromDate) {
            $filters[] = Filter::COLUMN_DATE . ' >= \'' . $filterDto->fromDate->format('Y-m-d') . '\'';
        }
        if (null !== $filterDto->toDate) {
            $filters[] = Filter::COLUMN_DATE . ' <= \'' . $filterDto->toDate->format('Y-m-d') . '\'';
        }
        if (!empty($filterDto->vehicleType)) {
            //this is to fix multiple value checkbox on frontend. need to be fixed in symfony form in the future
            $singleVehicleTypes = [];
            foreach ($filterDto->vehicleType as $vehicleType) {
                $vehicleTypes = explode(',', $vehicleType);
                $singleVehicleTypes = array_merge($singleVehicleTypes, $vehicleTypes);
            }
            $vehiclesInBraces = [];
            foreach ($singleVehicleTypes as $vehicleType) {
                $vehiclesInBraces[] = "'" . $vehicleType . "'";
            }
            $filters[] = "id IN (SELECT zszd_id FROM pojazdy WHERE rodzaj_pojazdu IN (" . implode(",", $vehiclesInBraces) . "))";
        }
        if (!empty($filterDto->injury)) {
            //this is to fix multiple value checkbox on frontend. need to be fixed in symfony form in the future
            $injuries = explode(',', $filterDto->injury);

            $injuriesInBraces = [];
            foreach ($injuries as $injury) {
                $injuriesInBraces[] = "'" . $injury . "'";
            }
            $filters[] = "id IN (SELECT zszd_id FROM uczestnicy WHERE stuc_kod IN (" . implode(",", $injuriesInBraces) . "))";
        }

        if (null !== $filterDto->driversCause) {
            $filters[] = "id IN (SELECT zszd_id FROM uczestnicy WHERE spsz_kod IN ('" . $filterDto->driversCause . "'))";
        }

        if (null !== $filterDto->pedestriansCause) {
            $filters[] = "id IN (SELECT zszd_id FROM uczestnicy WHERE sppi_kod IN ('" . $filterDto->pedestriansCause . "'))";
        }
        if (null !== $filterDto->pedestriansPresence) {
            if ($filterDto->pedestriansPresence) {
                $filters[] = "id IN (SELECT zszd_id FROM uczestnicy WHERE zspo_id IS NULL)";
            } else {
                $filters[] = "id IN (SELECT zszd_id FROM uczestnicy WHERE zspo_id IS NOT NULL)";
            }
        }

        return new Filter($filters);
    }
}