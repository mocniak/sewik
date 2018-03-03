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

    public function testFactoryCreatesFilterWithCounty()
    {
        $accidentsFilter = new AccidentsFilterDto();
        $accidentsFilter->setCounty('POWIAT TORUŃ');
        $filter = $this->factory->createFromDto($accidentsFilter);
        $expectedFilter = new Filter(['POWIAT = \'POWIAT TORUŃ\'']);
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

    public function testFactoryCreatesFilterWithInjuredPeople()
    {
        $accidentsFilter = new AccidentsFilterDto();
        $accidentsFilter->setInjury('ZM');
        $filter = $this->factory->createFromDto($accidentsFilter);
        $expectedFilter = new Filter(["id IN (SELECT zszd_id FROM uczestnicy WHERE stuc_kod IN ('ZM'))"]);
        $this->assertEquals($expectedFilter->getAccidentsFilterSql(), $filter->getAccidentsFilterSql());
    }

    public function testFactoryCreatesFilterWithManyInjuredPeople()
    {
        $accidentsFilter = new AccidentsFilterDto();
        $accidentsFilter->setInjury('ZM,ZC');
        $filter = $this->factory->createFromDto($accidentsFilter);
        $expectedFilter = new Filter(["id IN (SELECT zszd_id FROM uczestnicy WHERE stuc_kod IN ('ZM','ZC'))"]);
        $this->assertEquals($expectedFilter->getAccidentsFilterSql(), $filter->getAccidentsFilterSql());
    }

    public function testFactoryCreatesFilterWithAccidentsCausedByDrivers()
    {
        $accidentsFilter = new AccidentsFilterDto();
        $accidentsFilter->setDriversCause('A1_2015');
        $filter = $this->factory->createFromDto($accidentsFilter);
        $expectedFilter = new Filter(["id IN (SELECT zszd_id FROM uczestnicy WHERE spsz_kod IN ('A1_2015'))"]);
        $this->assertEquals($expectedFilter->getAccidentsFilterSql(), $filter->getAccidentsFilterSql());
    }

    public function testFactoryCreatesFilterWithAccidentsCausedByPedestrians()
    {
        $accidentsFilter = new AccidentsFilterDto();
        $accidentsFilter->setPedestriansCause('07');
        $filter = $this->factory->createFromDto($accidentsFilter);
        $expectedFilter = new Filter(["id IN (SELECT zszd_id FROM uczestnicy WHERE sppi_kod IN ('07'))"]);
        $this->assertEquals($expectedFilter->getAccidentsFilterSql(), $filter->getAccidentsFilterSql());
    }

    public function testFactoryCreatesFilterWithAccidentsWithPedestrians()
    {
        $accidentsFilter = new AccidentsFilterDto();
        $accidentsFilter->setPedestriansPresence(true);
        $filter = $this->factory->createFromDto($accidentsFilter);
        $expectedFilter = new Filter(["id IN (SELECT zszd_id FROM uczestnicy WHERE zspo_id IS NULL)"]);
        $this->assertEquals($expectedFilter->getAccidentsFilterSql(), $filter->getAccidentsFilterSql());
    }

    public function testFactoryCreatesFilterWithAccidentsWithoutPedestrians()
    {
        $accidentsFilter = new AccidentsFilterDto();
        $accidentsFilter->setPedestriansPresence(false);
        $filter = $this->factory->createFromDto($accidentsFilter);
        $expectedFilter = new Filter(["id IN (SELECT zszd_id FROM uczestnicy WHERE zspo_id IS NOT NULL)"]);
        $this->assertEquals($expectedFilter->getAccidentsFilterSql(), $filter->getAccidentsFilterSql());
    }
}
