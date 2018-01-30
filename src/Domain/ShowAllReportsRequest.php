<?php
namespace Sewik\Domain;

class ShowAllReportsRequest
{
    private $voivodeship;
    private $locality;
    private $street;
    private $fromDate;
    private $toDate;

    public function setVoivodeship(string $voivodeship)
    {
        $this->voivodeship = $voivodeship;
    }

    public function setLocality(string $locality)
    {
        $this->locality = $locality;
    }

    public function setStreet(string $street)
    {
        $this->street = $street;
    }

    public function setFromDate(\DateTimeImmutable $fromDate)
    {
        $this->fromDate = $fromDate;
    }

    public function setToDate(\DateTimeImmutable $toDate)
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
}