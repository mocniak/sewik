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
                "WHERE miejscowosc = 'Warszawa'"
            ],
            [
                ["miejscowosc = 'Warszawa'","data_zdarz >= '2011-11-01"],
                "WHERE miejscowosc = 'Warszawa' AND data_zdarz >= '2011-11-01"
            ]
        ];
    }
}
