<?php

namespace Sewik\Domain;

use PHPUnit\Framework\TestCase;

class FilterTest extends TestCase
{
    /**
     * @dataProvider sqlProvider
     */
    public function testFilterReturnsFilterSqlAccordinglyToItsContraints($constraints, $expectedSql)
    {
        $filter = new Filter($constraints);

        $this->assertEquals($expectedSql, $filter->getAccidentsFilterSql());
    }

    public function sqlProvider()
    {
        return [
            [
                [],
                ""
            ],
            [
                ["miejscowosc = 'Warszawa'"],
                "miejscowosc = 'Warszawa'"
            ],
            [
                ["miejscowosc = 'Warszawa'", "data_zdarz >= '2011-11-01"],
                "miejscowosc = 'Warszawa' AND data_zdarz >= '2011-11-01"
            ],
            [
                ["miejscowosc = 'Warszawa'", "data_zdarz >= '2011-11-01", "id IN (SELECT zszd_id FROM pojazdy WHERE rodzaj_pojazdu IN ('IS01'))"],
                "miejscowosc = 'Warszawa' AND data_zdarz >= '2011-11-01 AND id IN (SELECT zszd_id FROM pojazdy WHERE rodzaj_pojazdu IN ('IS01'))"
            ],
        ];
    }
}
