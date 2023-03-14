<?php

namespace Sewik\Tests\Unit\Domain;

use PHPUnit\Framework\TestCase;
use Sewik\Domain\Dto\AccidentsFilterDto;
use Sewik\Domain\Dto\Filter;
use Sewik\Domain\FilterFactory;

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
        $this->assertEquals($expectedFilter->getFilterSql(), $filter->getFilterSql());
    }

    public function testFactoryCreatesFilterWithCounty()
    {
        $accidentsFilter = new AccidentsFilterDto();
        $accidentsFilter->county = 'POWIAT TORUŃ';
        $filter = $this->factory->createFromDto($accidentsFilter);
        $expectedFilter = new Filter(['POWIAT = \'POWIAT TORUŃ\'']);
        $this->assertEquals($expectedFilter->getFilterSql(), $filter->getFilterSql());
    }

    public function testFactoryCreatesFilterWithAccidentSite()
    {
        $accidentsFilter = new AccidentsFilterDto();
        $accidentsFilter->accidentSite = 'A1';
        $filter = $this->factory->createFromDto($accidentsFilter);
        $expectedFilter = new Filter(['chmz_kod = \'A1\'']);
        $this->assertEquals($expectedFilter->getFilterSql(), $filter->getFilterSql());
    }

    public function testFactoryCreatesFilterWithSingleStreet()
    {
        $accidentsFilter = new AccidentsFilterDto();
        $accidentsFilter->streets = ['Wojska Polskiego', '', '', ''];
        $filter = $this->factory->createFromDto($accidentsFilter);
        $expectedFilter = new Filter(['(ulica_adres = \'Wojska Polskiego\' OR ulica_skrzyz = \'Wojska Polskiego\')']);
        $this->assertEquals($expectedFilter->getFilterSql(), $filter->getFilterSql());
    }

    public function testFactoryCreatesFilterWithManyStreets()
    {
        $accidentsFilter = new AccidentsFilterDto();
        $accidentsFilter->streets = ['Wojska Polskiego', 'Armii Krajowej', '', ''];
        $filter = $this->factory->createFromDto($accidentsFilter);
        $expectedFilter = new Filter([
            'ulica_adres IN (\'Wojska Polskiego\',\'Armii Krajowej\')',
            'ulica_skrzyz IN (\'Wojska Polskiego\',\'Armii Krajowej\')',
        ]);

        $this->assertEquals($expectedFilter->getFilterSql(), $filter->getFilterSql());
    }

    public function testFactoryCreatesFilterWithVehicles()
    {
        $accidentsFilter = new AccidentsFilterDto();
        $accidentsFilter->vehicleType = ['IS01'];
        $filter = $this->factory->createFromDto($accidentsFilter);
        $expectedFilter = new Filter(["id IN (SELECT zszd_id FROM pojazdy WHERE rodzaj_pojazdu IN ('IS01'))"]);
        $this->assertEquals($expectedFilter->getFilterSql(), $filter->getFilterSql());
    }

    public function testFactoryCreatesFilterWithMultiple()
    {
        $accidentsFilter = new AccidentsFilterDto();
        $accidentsFilter->vehicleType = ['IS01,IS101', 'IS121'];
        $filter = $this->factory->createFromDto($accidentsFilter);
        $expectedFilter = new Filter(["id IN (SELECT zszd_id FROM pojazdy WHERE rodzaj_pojazdu IN ('IS01','IS101','IS121'))"]);
        $this->assertEquals($expectedFilter->getFilterSql(), $filter->getFilterSql());
    }

    public function testFactoryCreatesFilterWithInjuredPeople()
    {
        $accidentsFilter = new AccidentsFilterDto();
        $accidentsFilter->injury = 'ZM';
        $filter = $this->factory->createFromDto($accidentsFilter);
        $expectedFilter = new Filter(["id IN (SELECT zszd_id FROM uczestnicy WHERE stuc_kod IN ('ZM'))"]);
        $this->assertEquals($expectedFilter->getFilterSql(), $filter->getFilterSql());
    }

    public function testFactoryCreatesFilterWithManyInjuredPeople()
    {
        $accidentsFilter = new AccidentsFilterDto();
        $accidentsFilter->injury = 'ZM,ZC';
        $filter = $this->factory->createFromDto($accidentsFilter);
        $expectedFilter = new Filter(["id IN (SELECT zszd_id FROM uczestnicy WHERE stuc_kod IN ('ZM','ZC'))"]);
        $this->assertEquals($expectedFilter->getFilterSql(), $filter->getFilterSql());
    }

    public function testFactoryCreatesFilterWithAccidentsCausedByDrivers()
    {
        $accidentsFilter = new AccidentsFilterDto();
        $accidentsFilter->driversCause = 'A1_2015';
        $filter = $this->factory->createFromDto($accidentsFilter);
        $expectedFilter = new Filter(["id IN (SELECT zszd_id FROM uczestnicy WHERE spsz_kod IN ('A1_2015'))"]);
        $this->assertEquals($expectedFilter->getFilterSql(), $filter->getFilterSql());
    }

    public function testFactoryCreatesFilterWithAccidentsCausedByPedestrians()
    {
        $accidentsFilter = new AccidentsFilterDto();
        $accidentsFilter->pedestriansCause = '07';
        $filter = $this->factory->createFromDto($accidentsFilter);
        $expectedFilter = new Filter(["id IN (SELECT zszd_id FROM uczestnicy WHERE sppi_kod IN ('07'))"]);
        $this->assertEquals($expectedFilter->getFilterSql(), $filter->getFilterSql());
    }

    public function testFactoryCreatesFilterWithAccidentsWithPedestrians()
    {
        $accidentsFilter = new AccidentsFilterDto();
        $accidentsFilter->pedestriansPresence = true;
        $filter = $this->factory->createFromDto($accidentsFilter);
        $expectedFilter = new Filter(["id IN (SELECT zszd_id FROM uczestnicy WHERE zspo_id IS NULL)"]);
        $this->assertEquals($expectedFilter->getFilterSql(), $filter->getFilterSql());
    }

    public function testFactoryCreatesFilterWithAccidentsWithoutPedestrians()
    {
        $accidentsFilter = new AccidentsFilterDto();
        $accidentsFilter->pedestriansPresence = false;
        $filter = $this->factory->createFromDto($accidentsFilter);
        $expectedFilter = new Filter(["id NOT IN (SELECT zszd_id FROM uczestnicy WHERE zspo_id IS NULL)"]);
        $this->assertEquals($expectedFilter->getFilterSql(), $filter->getFilterSql());
    }
}
