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
    private $address;
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
    private $type;
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
    private $roadPart;

    public function __construct(
        int $id,
        string $voivodeship,
        string $county,
        string $commune,
        string $locality,
        string $address,
        \DateTimeImmutable $time,
        ?string $light,
        ?string $weather,
        ?string $type,
        ?string $speedLimit,
        ?string $pavement,
        ?string $roadType,
        ?string $trafficLights,
        ?string $surfaceMarking,
        ?string $intersectionType,
        ?bool $builtUpArea,
        ?string $roadPart
    )
    {
        $this->id = $id;
        $this->voivodeship = $voivodeship;
        $this->county = $county;
        $this->commune = $commune;
        $this->locality = $locality;
        $this->address = $address;
        $this->time = $time;
        $this->light = $light;
        $this->weather = $weather;
        $this->type = $type;
        $this->speedLimit = $speedLimit;
        $this->pavement = $pavement;
        $this->roadType = $roadType;
        $this->trafficLights = $trafficLights;
        $this->surfaceMarking = $surfaceMarking;
        $this->intersectionType = $intersectionType;
        $this->builtUpArea = $builtUpArea;
        $this->roadPart = $roadPart;
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
    public function getAddress(): string
    {
        return $this->address;
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
    public function getType(): string
    {
        return $this->type;
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
    public function getRoadPart(): string
    {
        return $this->roadPart;
    }
}