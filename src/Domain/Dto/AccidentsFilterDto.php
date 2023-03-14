<?php

namespace Sewik\Domain\Dto;

class AccidentsFilterDto
{
    public $voivodeship;
    public $county;
    public $locality;
    /** @var array */
    public $streets;
    public $fromDate;
    public $toDate;
    public $injury;
    public $vehicleType;
    public $accidentType;
    public $driversCause;
    public $pedestriansCause;
    public $pedestriansPresence;
    public $accidentSite;
    public $light;
    public $weather;
    public $pavement;
    public $roadType;
    public $trafficLights;
    public $surfaceMarking;
    public $intersectionType;
    public $builtUpArea;
    public $otherCause;
    public $surfaceCondition;
    public $roadGeometry;
    public function __construct()
    {
        $this->streets = ['','','',''];
    }
}
