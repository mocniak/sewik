<?php

namespace Sewik\Domain;

class Vehicle
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var int
     */
    private $accidentId;
    /**
     * @var string
     */
    private $type;
    /**
     * @var string
     */
    private $brand;
    /**
     * @var string
     */
    private $issues;
    /**
     * @var string
     */
    private $specialType;
    /**
     * @var array
     */
    private $passengers;

    public function __construct(
        int $id,
        int $accidentId,
        string $type,
        ?string $brand,
        ?string $issues,
        ?string $specialType,
        array $passengers
    )
    {

        $this->id = $id;
        $this->accidentId = $accidentId;
        $this->type = $type;
        $this->brand = $brand;
        $this->issues = $issues;
        $this->specialType = $specialType;
        $this->passengers = $passengers;
    }

    /**
     * @return array
     */
    public function getPassengers(): array
    {
        return $this->passengers;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getAccidentId(): int
    {
        return $this->accidentId;
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
    public function getBrand(): ?string
    {
        return $this->brand;
    }

    /**
     * @return string
     */
    public function getIssues(): ?string
    {
        return $this->issues;
    }

    /**
     * @return string
     */
    public function getSpecialType(): ?string
    {
        return $this->specialType;
    }

}