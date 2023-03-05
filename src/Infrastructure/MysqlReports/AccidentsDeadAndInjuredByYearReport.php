<?php

namespace Sewik\Infrastructure\MysqlReports;

class AccidentsDeadAndInjuredByYearReport
{
    private string $sql = "
SELECT r.rok, zdarzenia, zmarli, ciezko_ranni, lekko_ranni
FROM (SELECT YEAR (DATA_ZDARZ) AS rok, count(1) AS zdarzenia FROM zdarzenie GROUP BY rok) AS r
         LEFT JOIN (SELECT rok, count(1) AS zmarli
                    FROM (SELECT ZSZD_ID, STUC_KOD FROM uczestnicy WHERE STUC_KOD IN ('ZM', 'ZC')) AS u
                             LEFT JOIN (SELECT id, YEAR (DATA_ZDARZ) AS rok FROM zdarzenie) AS z ON z.ID = u.ZSZD_ID
                    GROUP BY ROK) AS zm ON r.rok = zm.rok
         LEFT JOIN (SELECT rok, count(1) AS ciezko_ranni
                    FROM (SELECT ZSZD_ID, STUC_KOD FROM uczestnicy WHERE STUC_KOD = 'RC') AS u
                             LEFT JOIN (SELECT id, YEAR (DATA_ZDARZ) AS rok FROM zdarzenie) AS z ON z.ID = u.ZSZD_ID
                    GROUP BY ROK) AS rc ON r.rok = rc.rok
         LEFT JOIN (SELECT rok, count(1) AS lekko_ranni
                    FROM (SELECT ZSZD_ID, STUC_KOD FROM uczestnicy WHERE STUC_KOD = 'RL') AS u
                             LEFT JOIN (SELECT id, YEAR (DATA_ZDARZ) AS rok FROM zdarzenie) AS z ON z.ID = u.ZSZD_ID
                    GROUP BY ROK) AS rl ON r.rok = rl.rok
ORDER BY r.rok;";

    public function getSql(): string {
        return $this->sql;
    }
}
