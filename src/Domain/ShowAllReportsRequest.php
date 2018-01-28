<?php
namespace Sewik\Domain;

class ShowAllReportsRequest
{
    /**
     * @var string
     */
    private $voivodeship;
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
    private $fromDate;
    /**
     * @var \DateTimeImmutable
     */
    private $toDate;

    public function __construct(
        ?string $voivodeship,
        ?string $locality,
        ?string $street,
        ?\DateTimeImmutable $fromDate,
        ?\DateTimeImmutable $toDate
    )
    {

        $this->voivodeship = $voivodeship;
        $this->locality = $locality;
        $this->street = $street;
        $this->fromDate = $fromDate;
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