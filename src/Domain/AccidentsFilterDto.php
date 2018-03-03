<?php

namespace Sewik\Domain;

class AccidentsFilterDto
{
    private $voivodeship;
    private $county;
    private $locality;
    private $street;
    private $fromDate;
    private $toDate;
    private $injury;
    private $vehicleType;
    private $accidentType;
    private $driversCause;
    private $pedestriansCause;
    private $pedestriansPresence;
    private $accidentSite;

    public function getPedestriansCause()
    {
        return $this->pedestriansCause;
    }

    public function setPedestriansCause($pedestriansCause)
    {
        $this->pedestriansCause = $pedestriansCause;
    }

    public function getDriversCause()
    {
        return $this->driversCause;
    }

    public function setDriversCause($driversCause)
    {
        $this->driversCause = $driversCause;
    }

    public function getInjury(): ?string
    {
        return $this->injury;
    }

    public function setInjury(?string $injury)
    {
        $this->injury = $injury;
    }

    public function getVehicleType(): ?array
    {
        return $this->vehicleType;
    }

    public function setVehicleType(?array $vehicleType)
    {
        $this->vehicleType = $vehicleType;
    }

    public function setVoivodeship(?string $voivodeship)
    {
        $this->voivodeship = $voivodeship;
    }

    public function setLocality(?string $locality)
    {
        $this->locality = $locality;
    }

    public function setStreet(?string $street)
    {
        $this->street = $street;
    }

    public function setFromDate(?\DateTimeImmutable $fromDate)
    {
        $this->fromDate = $fromDate;
    }

    public function setToDate(?\DateTimeImmutable $toDate)
    {
        $this->toDate = $toDate;
    }

    public function getVoivodeship(): ?string
    {
        return $this->voivodeship;
    }

    public function getLocality(): ?string
    {
        return $this->locality;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function getFromDate(): ?\DateTimeImmutable
    {
        return $this->fromDate;
    }

    public function getToDate(): ?\DateTimeImmutable
    {
        return $this->toDate;
    }

    public function getCounty():?string
    {
        return $this->county;
    }

    public function setCounty(?string $county)
    {
        $this->county = $county;
    }

    public function getAccidentType()
    {
        return $this->accidentType;
    }

    public function setAccidentType($accidentType)
    {
        $this->accidentType = $accidentType;
    }

    public function getPedestriansPresence(): ?bool
    {
        return $this->pedestriansPresence;
    }

    public function setPedestriansPresence(?bool $pedestriansPresence)
    {
        $this->pedestriansPresence = $pedestriansPresence;
    }

    public function getAccidentSite()
    {
        return $this->accidentSite;
    }

    public function setAccidentSite($accidentSite)
    {
        $this->accidentSite = $accidentSite;
    }
}