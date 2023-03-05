<?php

namespace Sewik\Infrastructure\MysqlReports;

class OptimizedAccidentsDeadAndInjuredByYearReport
{
    private string $sql = "
SELECT *
FROM (SELECT YEAR(DATA_ZDARZ) AS rok, count(1) AS zdarzenia FROM zdarzenie GROUP BY rok) AS r
         LEFT JOIN (SELECT count(1) as zmarli, rok FROM uczestnicy_z_data WHERE STUC_KOD IN ('ZM', 'ZC')
                    GROUP BY ROK) AS zm ON r.rok = zm.rok
         LEFT JOIN (SELECT count(1) as ciezko_ranni,  rok FROM uczestnicy_z_data WHERE STUC_KOD ='RC'
                    GROUP BY ROK) AS rc ON r.rok = rc.rok
         LEFT JOIN (SELECT count(1) as lekko_ranni, rok FROM uczestnicy_z_data WHERE STUC_KOD ='RL'
                    GROUP BY ROK) AS rl ON r.rok = rl.rok
ORDER BY r.rok;";

    public function getSql(): string {
        return $this->sql;
    }
}
