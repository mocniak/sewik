<?php

namespace Sewik\Domain;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class QueryTemplate
{
    private $id;
    private $sqlQuery;
    private $name;

    public function __construct(string $sqlQuery, string $name)
    {
        $this->id = Uuid::uuid4();
        $this->sqlQuery = $sqlQuery;
        $this->name = $name;
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getSqlQuery(): string
    {
        return $this->sqlQuery;
    }

    public function setSqlQuery(string $sqlQuery)
    {
        $this->sqlQuery = $sqlQuery;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }
}
