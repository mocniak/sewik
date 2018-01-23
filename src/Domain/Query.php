<?php

namespace Sewik\Domain;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class Query
{
    private $sqlQuery;
    private $id;

    public function __construct(string $sqlQuery)
    {
        $this->id = Uuid::uuid4();
        $this->sqlQuery = $sqlQuery;
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getSqlQuery(): string
    {
        return $this->sqlQuery;
    }
}
