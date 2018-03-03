<?php
namespace Sewik\Tests\Domain;

use Sewik\Domain\AccidentsFilterDto;
use Sewik\Domain\Filter;
use Sewik\Domain\FilterFactory;
use PHPUnit\Framework\TestCase;
use Sewik\Domain\ShowAllReportsRequest;

class FilterFactoryTest extends TestCase
{
    /** @var FilterFactory */
    private $factory;

    public function setUp()
    {
        $this->factory = new FilterFactory();
    }

    public function testFactoryCreatesFilterWithLocality()
    {
        $accidentsFilter = new AccidentsFilterDto();
        $accidentsFilter->setLocality('Warszawa');
        $filter = $this->factory->createFromDto($accidentsFilter);
        $expectedFilter = new Filter([Filter::COLUMN_LOCALITY . ' = \'Warszawa\'']);
        $this->assertEquals($expectedFilter->getAccidentsFilterSql(), $filter->getAccidentsFilterSql());
    }

    public function testFactoryCreatesFilterWithVehicles()
    {
        $accidentsFilter = new AccidentsFilterDto();
        $accidentsFilter->setVehicleType(['IS01']);
        $filter = $this->factory->createFromDto($accidentsFilter);
        $expectedFilter = new Filter(["id IN (SELECT zszd_id FROM pojazdy WHERE rodzaj_pojazdu IN ('IS01'))"]);
        $this->assertEquals($expectedFilter->getAccidentsFilterSql(), $filter->getAccidentsFilterSql());
    }

    public function testFactoryCreatesFilterWithMultiple()
    {
        $accidentsFilter = new AccidentsFilterDto();
        $accidentsFilter->setVehicleType(['IS01,IS101', 'IS121']);
        $filter = $this->factory->createFromDto($accidentsFilter);
        $expectedFilter = new Filter(["id IN (SELECT zszd_id FROM pojazdy WHERE rodzaj_pojazdu IN ('IS01','IS101','IS121'))"]);
        $this->assertEquals($expectedFilter->getAccidentsFilterSql(), $filter->getAccidentsFilterSql());
    }
}
