<?php

namespace Sewik\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
class Accident
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'NONE')]
    private int $id;

    #[ORM\Column(length: 30, nullable: true, name: 'WOJ')]
    private string $voivodeship;

    #[ORM\Column(length: 30, nullable: true, name: 'POWIAT')]
    private string $county;
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
     * @var string
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
    /**
     * @var array
     */
    private $vehicles;
    /**
     * @var array
     */
    private $pedestrians;
    /**
     * @var string|null
     */
    private $gpsX;
    /**
     * @var string|null
     */
    private $gpsY;

    public function __construct(
        int $id,
        ?string $voivodeship = null,
        ?string $county = null,
        ?string $commune = null,
        ?string $locality = null,
        ?string $street = null,
        ?string $houseNumber = null,
        ?string $intersectionStreet = null,
        ?\DateTimeImmutable $time = null,
        ?string $light = null,
        ?string $weather = null,
        ?string $siteCharacteristic = null,
        ?string $speedLimit = null,
        ?string $pavement = null,
        ?string $roadType = null,
        ?string $trafficLights = null,
        ?string $surfaceMarking = null,
        ?string $intersectionType = null,
        ?bool $builtUpArea = null,
        ?string $otherCause = null,
        ?string $surfaceCondition = null,
        ?string $accidentType = null,
        ?string $roadGeometry = null,
        array $vehicles = null,
        array $pedestrians = null,
        ?string $gpsX = null,
        ?string $gpsY = null
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
        $this->vehicles = $vehicles;
        $this->pedestrians = $pedestrians;
        $this->gpsX = $gpsX;
        $this->gpsY = $gpsY;
    }

    /**
     * @return array
     */
    public function getVehicles(): array
    {
        return $this->vehicles;
    }

    /**
     * @return array
     */
    public function getPedestrians(): array
    {
        return $this->pedestrians;
    }

    /**
     * @return string
     */
    public function getHouseNumber(): ?string
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
    public function getVoivodeship(): ?string
    {
        return $this->voivodeship;
    }

    /**
     * @return string
     */
    public function getCounty(): ?string
    {
        return $this->county;
    }

    /**
     * @return string
     */
    public function getCommune(): ?string
    {
        return $this->commune;
    }

    /**
     * @return string
     */
    public function getLocality(): ?string
    {
        return $this->locality;
    }

    /**
     * @return string
     */
    public function getStreet(): ?string
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

    public function getLight(): ?string
    {
        return $this->light;
    }

    public function getWeather(): ?string
    {
        return $this->weather;
    }

    public function getSiteCharacteristic(): ?string
    {
        return $this->siteCharacteristic;
    }

    public function getSpeedLimit(): ?string
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
    public function getTrafficLights(): ?string
    {
        return $this->trafficLights;
    }

    /**
     * @return string
     */
    public function getSurfaceMarking(): ?string
    {
        return $this->surfaceMarking;
    }

    public function getIntersectionType(): ?string
    {
        return $this->intersectionType;
    }

    public function isBuiltUpArea(): ?bool
    {
        return $this->builtUpArea;
    }

    public function getOtherCause(): ?string
    {
        return $this->otherCause;
    }

    public function getSurfaceCondition(): ?string
    {
        return $this->surfaceCondition;
    }

    public function getAccidentType(): ?string
    {
        return $this->accidentType;
    }

    public function getGpsX(): ?string
    {
        return $this->gpsX;
    }

    public function getGpsY(): ?string
    {
        return $this->gpsY;
    }

    public function getDecimalGpsX(): ?float
    {
        return $this->gpsX === null ? null : $this->gpsToDec($this->gpsX);

    }

    public function getDecimalGpsY(): ?float
    {
        return $this->gpsY === null ? null : $this->gpsToDec($this->gpsY);
    }

    private function gpsToDec(string $gpsInDeg): ?float
    {
        try {
            $coordinates = preg_split("/([*'])/", $gpsInDeg);
            $deg = (int)$coordinates[0];
            $min = (int)$coordinates[1];
            $sec = ((int)str_pad($coordinates[2], 3, '0')) / 10;
            return $deg + ((($min * 60) + ($sec)) / 3600);

        } catch (\Exception $exception) {
            return null;
        }
    }
}
