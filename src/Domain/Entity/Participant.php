<?php

namespace Sewik\Domain\Entity;

class Participant
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
    private $role;
    private $dateOfBirth;
    /**
     * @var string
     */
    private $gender;
    /**
     * @var string
     */
    private $drivingLicence;
    /**
     * @var int
     */
    private $drivingYears;
    /**
     * @var string
     */
    private $fault;
    /**
     * @var string
     */
    private $pedestrianFault;
    /**
     * @var string
     */
    private $penalty;
    /**
     * @var string
     */
    private $influence;
    /**
     * @var string
     */
    private $injury;
    /**
     * @var string
     */
    private $missingUse;

    public function __construct(
        int $id,
        int $accidentId,
        string $role,
        ?\DateTimeImmutable $dateOfBirth,
        string $gender,
        ?string $drivingLicence,
        ?int $drivingYears,
        ?string $fault,
        ?string $pedestrianFault,
        ?string $penalty,
        ?string $influence,
        ?string $injury,
        ?string $missingUse
    )
    {
        $this->id = $id;
        $this->accidentId = $accidentId;
        $this->role = $role;
        $this->dateOfBirth = $dateOfBirth;
        $this->gender = $gender;
        $this->drivingLicence = $drivingLicence;
        $this->drivingYears = $drivingYears;
        $this->fault = $fault;
        $this->pedestrianFault = $pedestrianFault;
        $this->penalty = $penalty;
        $this->influence = $influence;
        $this->injury = $injury;
        $this->missingUse = $missingUse;
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
    public function getRole(): string
    {
        return $this->role;
    }

    public function getDateOfBirth(): ?\DateTimeImmutable
    {
        return $this->dateOfBirth;
    }

    /**
     * @return string
     */
    public function getGender(): string
    {
        return $this->gender;
    }

    /**
     * @return string
     */
    public function getDrivingLicence(): ?string
    {
        return $this->drivingLicence;
    }

    /**
     * @return int
     */
    public function getDrivingYears(): ?int
    {
        return $this->drivingYears;
    }

    /**
     * @return string
     */
    public function getFault(): ?string
    {
        return $this->fault;
    }

    /**
     * @return string
     */
    public function getPedestrianFault(): ?string
    {
        return $this->pedestrianFault;
    }

    /**
     * @return string
     */
    public function getPenalty(): ?string
    {
        return $this->penalty;
    }

    /**
     * @return string
     */
    public function getInfluence(): ?string
    {
        return $this->influence;
    }

    /**
     * @return string
     */
    public function getInjury(): ?string
    {
        return $this->injury;
    }

    /**
     * @return string
     */
    public function getMissingUse(): ?string
    {
        return $this->missingUse;
    }
}
