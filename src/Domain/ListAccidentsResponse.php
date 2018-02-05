<?php
namespace Sewik\Domain;

class ListAccidentsResponse
{
    /**
     * @var array
     */
    private $accidents;

    public function __construct(array $accidents)
    {
        $this->accidents = $accidents;
    }

}