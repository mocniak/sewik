<?php
namespace Sewik\Tests\Domain;

use Sewik\Domain\Dto\AccidentsFilterDto;
use Sewik\Domain\Dto\Filter;
use Sewik\Domain\FilterFactory;
use PHPUnit\Framework\TestCase;

class FilterFactoryTest extends TestCase
{
    /** @var FilterFactory */
    private $factory;

    public function setUp(): void
    {
        $this->factory = new FilterFactory();
    }

    public function testFactoryCreatesFilterWithLocality()
    {
        $accidentsFilter = new AccidentsFilterDto();
        $accidentsFilter->locality = 'Warszawa';
        $filter = $this->factory->createFromDto($accidentsFilter);
        $expectedFilter = new Filter([Filter::COLUMN_LOCALITY . ' = \'Warszawa\'']);
        $this->assertEquals($expectedFilter->getAccidentsFilterSql(), $filter->getAccidentsFilterSql());
    }

    public function testFactoryCreatesFilterWithCounty()
    {
        $accidentsFilter = new AccidentsFilterDto();
        $accidentsFilter->county = 'POWIAT TORUŃ';
        $filter = $this->factory->createFromDto($accidentsFilter);
        $expectedFilter = new Filter(['POWIAT = \'POWIAT TORUŃ\'']);
        $this->assertEquals($expectedFilter->getAccidentsFilterSql(), $filter->getAccidentsFilterSql());
    }

    public function testFactoryCreatesFilterWithAccidentSite()
    {
        $accidentsFilter = new AccidentsFilterDto();
        $accidentsFilter->accidentSite = 'A1';
        $filter = $this->factory->createFromDto($accidentsFilter);
        $expectedFilter = new Filter(['chmz_kod = \'A1\'']);
        $this->assertEquals($expectedFilter->getAccidentsFilterSql(), $filter->getAccidentsFilterSql());
    }

    public function testFactoryCreatesFilterWithVehicles()
    {
        $accidentsFilter = new AccidentsFilterDto();
        $accidentsFilter->vehicleType = ['IS01'];
        $filter = $this->factory->createFromDto($accidentsFilter);
        $expectedFilter = new Filter(["id IN (SELECT zszd_id FROM pojazdy WHERE rodzaj_pojazdu IN ('IS01'))"]);
        $this->assertEquals($expectedFilter->getAccidentsFilterSql(), $filter->getAccidentsFilterSql());
    }

    public function testFactoryCreatesFilterWithMultiple()
    {
        $accidentsFilter = new AccidentsFilterDto();
        $accidentsFilter->vehicleType = ['IS01,IS101', 'IS121'];
        $filter = $this->factory->createFromDto($accidentsFilter);
        $expectedFilter = new Filter(["id IN (SELECT zszd_id FROM pojazdy WHERE rodzaj_pojazdu IN ('IS01','IS101','IS121'))"]);
        $this->assertEquals($expectedFilter->getAccidentsFilterSql(), $filter->getAccidentsFilterSql());
    }

    public function testFactoryCreatesFilterWithInjuredPeople()
    {
        $accidentsFilter = new AccidentsFilterDto();
        $accidentsFilter->injury = 'ZM';
        $filter = $this->factory->createFromDto($accidentsFilter);
        $expectedFilter = new Filter(["id IN (SELECT zszd_id FROM uczestnicy WHERE stuc_kod IN ('ZM'))"]);
        $this->assertEquals($expectedFilter->getAccidentsFilterSql(), $filter->getAccidentsFilterSql());
    }

    public function testFactoryCreatesFilterWithManyInjuredPeople()
    {
        $accidentsFilter = new AccidentsFilterDto();
        $accidentsFilter->injury = 'ZM,ZC';
        $filter = $this->factory->createFromDto($accidentsFilter);
        $expectedFilter = new Filter(["id IN (SELECT zszd_id FROM uczestnicy WHERE stuc_kod IN ('ZM','ZC'))"]);
        $this->assertEquals($expectedFilter->getAccidentsFilterSql(), $filter->getAccidentsFilterSql());
    }

    public function testFactoryCreatesFilterWithAccidentsCausedByDrivers()
    {
        $accidentsFilter = new AccidentsFilterDto();
        $accidentsFilter->driversCause = 'A1_2015';
        $filter = $this->factory->createFromDto($accidentsFilter);
        $expectedFilter = new Filter(["id IN (SELECT zszd_id FROM uczestnicy WHERE spsz_kod IN ('A1_2015'))"]);
        $this->assertEquals($expectedFilter->getAccidentsFilterSql(), $filter->getAccidentsFilterSql());
    }

    public function testFactoryCreatesFilterWithAccidentsCausedByPedestrians()
    {
        $accidentsFilter = new AccidentsFilterDto();
        $accidentsFilter->pedestriansCause = '07';
        $filter = $this->factory->createFromDto($accidentsFilter);
        $expectedFilter = new Filter(["id IN (SELECT zszd_id FROM uczestnicy WHERE sppi_kod IN ('07'))"]);
        $this->assertEquals($expectedFilter->getAccidentsFilterSql(), $filter->getAccidentsFilterSql());
    }

    public function testFactoryCreatesFilterWithAccidentsWithPedestrians()
    {
        $accidentsFilter = new AccidentsFilterDto();
        $accidentsFilter->pedestriansPresence = true;
        $filter = $this->factory->createFromDto($accidentsFilter);
        $expectedFilter = new Filter(["id IN (SELECT zszd_id FROM uczestnicy WHERE zspo_id IS NULL)"]);
        $this->assertEquals($expectedFilter->getAccidentsFilterSql(), $filter->getAccidentsFilterSql());
    }

    public function testFactoryCreatesFilterWithAccidentsWithoutPedestrians()
    {
        $accidentsFilter = new AccidentsFilterDto();
        $accidentsFilter->pedestriansPresence = false;
        $filter = $this->factory->createFromDto($accidentsFilter);
        $expectedFilter = new Filter(["id IN (SELECT zszd_id FROM uczestnicy WHERE zspo_id IS NOT NULL)"]);
        $this->assertEquals($expectedFilter->getAccidentsFilterSql(), $filter->getAccidentsFilterSql());
    }
}
