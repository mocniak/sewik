<?php
namespace Sewik\Tests\Domain;

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
        $request = new ShowAllReportsRequest(null, 'Warszawa', null, null, null);
        $filter = $this->factory->createFromRequest($request);
        $expectedFilter = new Filter([Filter::COLUMN_LOCALITY . ' = \'Warszawa\'']);
        $this->assertEquals($expectedFilter->getAccidentsFilter(), $filter->getAccidentsFilter());
    }
}
