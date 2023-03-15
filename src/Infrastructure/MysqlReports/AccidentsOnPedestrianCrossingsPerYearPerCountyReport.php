<?php

namespace Sewik\Infrastructure\MysqlReports;

use Sewik\Infrastructure\MysqlDatabase;

class AccidentsOnPedestrianCrossingsPerYearPerCountyReport
{
    public function __construct(private readonly MysqlDatabase $database)
    {
    }

    public function generate(): array
    {
        $counties = $this->database->execute('SELECT DISTINCT CONCAT_WS(\'/\', WOJ, POWIAT) as POWIAT FROM accident;');
        $years = $this->database->execute('SELECT DISTINCT YEAR(DATA_ZDARZ) as rok FROM accident;');
        $accidentsByCounties = [];
        foreach ($counties as $countyRow) {
            $countyName = $countyRow['POWIAT'];
            $accidentsByCounties[$countyName] = $this->database->execute(
                'SELECT YEAR(DATA_ZDARZ) as rok, COUNT(1) as zdarzenia FROM accident WHERE CONCAT_WS(\'/\', WOJ, POWIAT) = \'' . $countyName . '\' GROUP BY rok;'
            );
        }
        $result = [];
        foreach ($years as $yearRow) {
            $year = $yearRow['rok'];
            foreach ($counties as $countyRow) {
                $county = $countyRow['POWIAT'];
                $yearRow = array_values(array_filter($accidentsByCounties[$county], fn($yearRow) => $yearRow['rok'] === $year));
                $result[$year][$county] = $yearRow === [] ? 0 : $yearRow[0]['zdarzenia'];
            }
        }
        return $result;
    }
}
