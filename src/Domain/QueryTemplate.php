<?php

namespace Sewik\Domain;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class QueryTemplate
{
    const CATEGORY_TIME = 'time';
    const CATEGORY_LOCATION = 'location';
    const CATEGORY_SITE = 'site';
    const CATEGORY_PARTICIPANTS = 'participants';
    const CATEGORY_VEHICLES = 'vehicles';
    const CATEGORY_OTHER = 'other';

    const CATEGORIES = [
        'CATEGORY_TIME' => self::CATEGORY_TIME,
        'CATEGORY_LOCATION' => self::CATEGORY_LOCATION,
        'CATEGORY_SITE' => self::CATEGORY_SITE,
        'CATEGORY_PARTICIPANTS' => self::CATEGORY_PARTICIPANTS,
        'CATEGORY_VEHICLES' => self::CATEGORY_VEHICLES,
        'CATEGORY_OTHER' => self::CATEGORY_OTHER,
    ];

    private $id;
    private $sqlQuery;
    private $name;
    private $category;

    public function __construct(string $sqlQuery, string $name, string $category)
    {
        $this->id = Uuid::uuid4();
        $this->sqlQuery = $sqlQuery;
        $this->name = $name;
        $this->category = $category;
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

    public function getCategory(): string
    {
        return $this->category;
    }

    public function setCategory(string $category)
    {
        $this->category = $category;
    }
}
