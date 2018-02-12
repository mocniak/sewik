<?php

namespace Sewik\Infrastructure;

use PHPUnit\Framework\TestCase;
use Sewik\Domain\Accident;

class MysqlAccidentsRepositoryTest extends TestCase
{
    /** @var MysqlAccidentsRepository */
    private $repository;

    public function setUp()
    {
        $this->repository = new MysqlAccidentsRepository('localhost', 'root', 'dupa.8', 'sewik');
    }

    public function testRepositoryFetchesSingleObjectFromDatabase()
    {
        $this->assertInstanceOf(Accident::class, $this->repository->getAccident(123));
    }
}
