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

    public function getInjury(): ?string
    {
        return $this->injury;
    }

    public function setInjury(?string $injury)
    {
        $this->injury = $injury;
    }

    public function getVehicleType(): ?string
    {
        return $this->vehicleType;
    }

    public function setVehicleType(?string $vehicleType)
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
}