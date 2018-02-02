<?php

namespace Sewik\Domain;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class QueryTemplate
{
    private $sqlQuery;
    private $id;
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

    public function getName(): string
    {
        return $this->name;
    }
}
