<?php

namespace Sewik\Tests\Infrastructure;

use PHPUnit\Framework\TestCase;
use Sewik\Domain\Dto\Filter;
use Sewik\Domain\Entity\Accident;
use Sewik\Infrastructure\MysqlAccidentsRepository;

class MysqlAccidentsRepositoryTest extends TestCase
{
    /** @var MysqlAccidentsRepository */
    private $repository;

    public function setUp(): void
    {
        $this->repository = new MysqlAccidentsRepository('localhost', 'root', 'dupa.8', 'sewik');
    }

    public function testRepositoryFetchesSingleObjectFromDatabase()
    {
        $id = 98080700;
        $accident = $this->repository->getAccident($id);
        $this->assertEquals($id, $accident->getId());
    }

    public function testRepositoryReturnsArrayOfAccidentsForGivenFilter()
    {
        $expectedCity = 'WARSZAWA';
        /** @var Accident $accident */
        $filter = new Filter([Filter::COLUMN_LOCALITY . ' = \'' . $expectedCity . '\'']);
        $accidents = $this->repository->findFilteredAccidents($filter);
        $this->assertEquals(50, count($accidents));
        foreach ($accidents as $accident) {
            $this->assertEquals($expectedCity, $accident->getLocality());
        }
    }
}
