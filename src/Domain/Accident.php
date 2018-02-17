<?php

namespace Sewik\Domain;


class Accident
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $voivodeship;
    /**
     * @var string
     */
    private $county;
    /**
     * @var string
     */
    private $commune;
    /**
     * @var string
     */
    private $locality;
    /**
     * @var string
     */
    private $street;
    /**
     * @var \DateTimeImmutable
     */
    private $time;
    /**
     * @var string
     */
    private $light;
    /**
     * @var string
     */
    private $weather;
    /**
     * @var string
     */
    private $siteCharacteristic;
    /**
     * @var string
     */
    private $speedLimit;
    /**
     * @var string
     */
    private $pavement;
    /**
     * @var string
     */
    private $roadType;
    /**
     * @var string
     */
    private $trafficLights;
    /**
     * @var string
     */
    private $surfaceMarking;
    /**
     * @var null|string
     */
    private $intersectionType;
    /**
     * @var bool
     */
    private $builtUpArea;
    /**
     * @var string
     */
    private $otherCause;
    /**
     * @var null|string
     */
    private $surfaceCondition;
    /**
     * @var null|string
     */
    private $accidentType;
    /**
     * @var null|string
     */
    private $roadGeometry;
    /**
     * @var null|string
     */
    private $intersectionStreet;
    /**
     * @var string
     */
    private $houseNumber;

    public function __construct(
        int $id,
        string $voivodeship,
        string $county,
        string $commune,
        string $locality,
        string $street,
        string $houseNumber,
        ?string $intersectionStreet,
        \DateTimeImmutable $time,
        ?string $light,
        ?string $weather,
        ?string $siteCharacteristic,
        ?string $speedLimit,
        ?string $pavement,
        ?string $roadType,
        ?string $trafficLights,
        ?string $surfaceMarking,
        ?string $intersectionType,
        ?bool $builtUpArea,
        ?string $otherCause,
        ?string $surfaceCondition,
        ?string $accidentType,
        ?string $roadGeometry
    )
    {
        $this->id = $id;
        $this->voivodeship = $voivodeship;
        $this->county = $county;
        $this->commune = $commune;
        $this->locality = $locality;
        $this->street = $street;
        $this->time = $time;
        $this->light = $light;
        $this->weather = $weather;
        $this->siteCharacteristic = $siteCharacteristic;
        $this->speedLimit = $speedLimit;
        $this->pavement = $pavement;
        $this->roadType = $roadType;
        $this->trafficLights = $trafficLights;
        $this->surfaceMarking = $surfaceMarking;
        $this->intersectionType = $intersectionType;
        $this->builtUpArea = $builtUpArea;
        $this->otherCause = $otherCause;
        $this->surfaceCondition = $surfaceCondition;
        $this->accidentType = $accidentType;
        $this->roadGeometry = $roadGeometry;
        $this->intersectionStreet = $intersectionStreet;
        $this->houseNumber = $houseNumber;
    }

    /**
     * @return string
     */
    public function getHouseNumber(): string
    {
        return $this->houseNumber;
    }

    /**
     * @return null|string
     */
    public function getIntersectionStreet(): ?string
    {
        return $this->intersectionStreet;
    }

    /**
     * @return null|string
     */
    public function getRoadGeometry(): ?string
    {
        return $this->roadGeometry;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getVoivodeship(): string
    {
        return $this->voivodeship;
    }

    /**
     * @return string
     */
    public function getCounty(): string
    {
        return $this->county;
    }

    /**
     * @return string
     */
    public function getCommune(): string
    {
        return $this->commune;
    }

    /**
     * @return string
     */
    public function getLocality(): string
    {
        return $this->locality;
    }

    /**
     * @return string
     */
    public function getStreet(): string
    {
        return $this->street;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getTime(): \DateTimeImmutable
    {
        return $this->time;
    }

    /**
     * @return string
     */
    public function getLight(): string
    {
        return $this->light;
    }

    /**
     * @return string
     */
    public function getWeather(): string
    {
        return $this->weather;
    }

    /**
     * @return string
     */
    public function getSiteCharacteristic(): string
    {
        return $this->siteCharacteristic;
    }

    /**
     * @return string
     */
    public function getSpeedLimit(): string
    {
        return $this->speedLimit;
    }

    /**
     * @return string
     */
    public function getPavement(): string
    {
        return $this->pavement;
    }

    /**
     * @return string
     */
    public function getRoadType(): string
    {
        return $this->roadType;
    }

    /**
     * @return string
     */
    public function getTrafficLights(): string
    {
        return $this->trafficLights;
    }

    /**
     * @return string
     */
    public function getSurfaceMarking(): string
    {
        return $this->surfaceMarking;
    }

    /**
     * @return null|string
     */
    public function getIntersectionType(): ?string
    {
        return $this->intersectionType;
    }

    /**
     * @return bool
     */
    public function isBuiltUpArea(): bool
    {
        return $this->builtUpArea;
    }

    /**
     * @return string
     */
    public function getOtherCause(): string
    {
        return $this->otherCause;
    }

    /**
     * @return null|string
     */
    public function getSurfaceCondition(): ?string
    {
        return $this->surfaceCondition;
    }

    /**
     * @return null|string
     */
    public function getAccidentType(): ?string
    {
        return $this->accidentType;
    }
}