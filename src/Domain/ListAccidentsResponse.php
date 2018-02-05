<?php
namespace Sewik\Domain;

class ListAccidentsResponse
{
    /**
     * @var Accident[]
     */
    private $accidents;

    /**
     * ListAccidentsResponse constructor.
     * @param Accident[] $accidents
     */
    public function __construct(array $accidents)
    {
        $this->accidents = $accidents;
    }

    /**
     * @return Accident[]
     */
    public function getAccidents(): array
    {
        return $this->accidents;
    }

}