<?php

namespace Sewik\Tests\Unit\Domain;

use PHPUnit\Framework\TestCase;
use Sewik\Domain\Dto\Filter;
use Sewik\Domain\Dto\Query;
use Sewik\Domain\Entity\QueryTemplate;
use Sewik\Domain\QueryFactory;

class QueryFactoryTest extends TestCase
{
    /** @var QueryFactory */
    private $queryFactory;

    public function setUp(): void
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
                "SELECT COUNT(*) AS pojazdy FROM pojazdy WHERE pojazdy.zszd_id IN (SELECT id FROM zdarzenie WHERE miejscowosc = 'Warszawa')"
            ],
            [
                [],
                'SELECT COUNT(*) AS pojazdy FROM pojazdy %pojazdy_filter%',
                "SELECT COUNT(*) AS pojazdy FROM pojazdy"
            ],
            [
                [],
                'SELECT COUNT(*) AS pojazdy FROM pojazdy %pojazdy_filter% AND STUC_KOD = \'RC\'',
                "SELECT COUNT(*) AS pojazdy FROM pojazdy WHERE STUC_KOD = 'RC'"
            ],
            [
                ["miejscowosc = 'Warszawa'"],
                'SELECT COUNT(*) AS uczestnicy FROM uczestnicy %uczestnicy_filter%',
                "SELECT COUNT(*) AS uczestnicy FROM uczestnicy WHERE uczestnicy.zszd_id IN (SELECT id FROM zdarzenie WHERE miejscowosc = 'Warszawa')"
            ],
            [
                [],
                'SELECT COUNT(*) AS uczestnicy FROM uczestnicy %uczestnicy_filter%',
                "SELECT COUNT(*) AS uczestnicy FROM uczestnicy"
            ],
            [
                [],
                'SELECT COUNT(*) AS uczestnicy FROM uczestnicy %pojazdy_filter% AND STUC_KOD = \'RC\'',
                "SELECT COUNT(*) AS uczestnicy FROM uczestnicy WHERE STUC_KOD = 'RC'"
            ],
            [
                [],
                'SELECT COUNT(*) AS uczestnicy FROM uczestnicy %pojazdy_filter% 
AND STUC_KOD = \'RC\'',
                "SELECT COUNT(*) AS uczestnicy FROM uczestnicy WHERE STUC_KOD = 'RC'"
            ],

        ];
    }
}
