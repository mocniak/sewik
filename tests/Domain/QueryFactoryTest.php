<?php
namespace Sewik\Tests\Domain;

use PHPUnit\Framework\TestCase;
use Sewik\Domain\Filter;
use Sewik\Domain\Query;
use Sewik\Domain\QueryFactory;
use Sewik\Domain\QueryTemplate;

class QueryFactoryTest extends TestCase
{
    /** @var QueryFactory */
    private $queryFactory;

    public function setUp()
    {
        $this->queryFactory = new QueryFactory();
    }

    /**
     * @dataProvider sqlProvider
     */
    public function testQueryFactoryInjectsFilterSubquery($filter, $templateSql, $expectedSql)
    {
        $template = new QueryTemplate($templateSql, "random name", QueryTemplate::CATEGORY_LOCATION);
        $expectedQuery = new Query($expectedSql);
        $filter = new Filter($filter);
        $computedQuery = $this->queryFactory->createQuery($filter, $template);
        $this->assertEquals($expectedQuery->getSqlQuery(), $computedQuery->getSqlQuery());
    }

    public function sqlProvider()
    {
        return [
            [
                ["miejscowosc = 'Warszawa'"],
                'SELECT COUNT(*) AS zdarzenia FROM zdarzenie %zdarzenie_filter%',
                "SELECT COUNT(*) AS zdarzenia FROM zdarzenie WHERE miejscowosc = 'Warszawa'"
            ],
            [
                [],
                'SELECT COUNT(*) AS zdarzenia FROM zdarzenie %zdarzenie_filter%',
                "SELECT COUNT(*) AS zdarzenia FROM zdarzenie"
            ],
            [
                ["miejscowosc = 'Warszawa'"],
                "SELECT COUNT(*) AS zdarzenia FROM zdarzenie %zdarzenie_filter% AND derp = 'derp'",
                "SELECT COUNT(*) AS zdarzenia FROM zdarzenie WHERE miejscowosc = 'Warszawa' AND derp = 'derp'"
            ],
            [
                [],
                "SELECT COUNT(*) AS zdarzenia FROM zdarzenie %zdarzenie_filter% AND derp = 'derp'",
                "SELECT COUNT(*) AS zdarzenia FROM zdarzenie WHERE derp = 'derp'"
            ],
            [
                ["miejscowosc = 'Warszawa'"],
                'SELECT COUNT(*) AS pojazdy FROM pojazdy %pojazdy_filter%',
                "SELECT COUNT(*) AS pojazdy FROM pojazdy WHERE zszd_id IN (SELECT id FROM zdarzenie WHERE miejscowosc = 'Warszawa')"
            ],
            [
                [],
                'SELECT COUNT(*) AS pojazdy FROM pojazdy %pojazdy_filter%',
                "SELECT COUNT(*) AS pojazdy FROM pojazdy"
            ],

        ];
    }
}
