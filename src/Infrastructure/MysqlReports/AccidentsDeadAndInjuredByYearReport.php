<?php

namespace Sewik\Infrastructure\MysqlReports;

class AccidentsDeadAndInjuredByYearReport
{
    private string $sql = "
SELECT r.rok, zdarzenia, zmarli, ciezko_ranni, lekko_ranni
FROM (SELECT YEAR (DATA_ZDARZ) AS rok, count(1) AS zdarzenia FROM zdarzenie WHERE POWIAT='POWIAT WARSZAWA' GROUP BY rok) AS r
         LEFT JOIN (SELECT rok, count(1) AS zmarli
                    FROM (SELECT ZSZD_ID, STUC_KOD FROM uczestnicy WHERE STUC_KOD IN ('ZM', 'ZC')
                        AND ZSZD_ID IN (SELECT ID FROM zdarzenie wHERE POWIAT='POWIAT WARSZAWA'))
                        AS u
                             LEFT JOIN (SELECT id, YEAR (DATA_ZDARZ) AS rok FROM zdarzenie) AS z ON z.ID = u.ZSZD_ID
                    GROUP BY ROK) AS zm ON r.rok = zm.rok
         LEFT JOIN (SELECT rok, count(1) AS ciezko_ranni
                    FROM (SELECT ZSZD_ID, STUC_KOD FROM uczestnicy WHERE STUC_KOD = 'RC'
                                                                   AND ZSZD_ID IN (SELECT ID FROM zdarzenie wHERE POWIAT='POWIAT WARSZAWA')
                                                                   ) AS u
                             LEFT JOIN (SELECT id, YEAR (DATA_ZDARZ) AS rok FROM zdarzenie) AS z ON z.ID = u.ZSZD_ID
                    GROUP BY ROK) AS rc ON r.rok = rc.rok
         LEFT JOIN (SELECT rok, count(1) AS lekko_ranni
                    FROM (SELECT ZSZD_ID, STUC_KOD FROM uczestnicy WHERE STUC_KOD = 'RL'
                                                                   AND ZSZD_ID IN (SELECT ID FROM zdarzenie wHERE POWIAT='POWIAT WARSZAWA')
                                                                   ) AS u
                             LEFT JOIN (SELECT id, YEAR (DATA_ZDARZ) AS rok FROM zdarzenie) AS z ON z.ID = u.ZSZD_ID
                    GROUP BY ROK) AS rl ON r.rok = rl.rok
ORDER BY r.rok;";

    private ?string $powiat;

    public function __construct()
    {
        $this->powiat = null;
    }

    public function getSql(): string
    {
        return $this->sql;
    }

    public function setPowiat(string $powiat): void
    {
        $this->powiat = $powiat;
    }
}
