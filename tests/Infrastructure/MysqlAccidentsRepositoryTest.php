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
        $id = 98080700;
        $accident = $this->repository->getAccident($id);
        $this->assertEquals($id, $accident->getId());
    }
}
