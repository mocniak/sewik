<?php

namespace Sewik\Infrastructure\MysqlReports;

class OptimizedAccidentsDeadAndInjuredByYearReport
{
    private string $sql = "
SELECT *
FROM (SELECT YEAR(DATA_ZDARZ) AS rok, count(1) AS zdarzenia FROM zdarzenie WHERE POWIAT='POWIAT WARSZAWA' GROUP BY rok) AS r
         LEFT JOIN (SELECT count(1) as zmarli, rok FROM uczestnicy_join_zdarzenie 
                                                   WHERE STUC_KOD IN ('ZM', 'ZC') AND POWIAT='POWIAT WARSZAWA'
                    GROUP BY ROK) AS zm ON r.rok = zm.rok
         LEFT JOIN (SELECT count(1) as ciezko_ranni,  rok FROM uczestnicy_join_zdarzenie WHERE STUC_KOD ='RC' AND POWIAT='POWIAT WARSZAWA'
                    GROUP BY ROK) AS rc ON r.rok = rc.rok
         LEFT JOIN (SELECT count(1) as lekko_ranni, rok FROM uczestnicy_join_zdarzenie WHERE STUC_KOD ='RL' AND POWIAT='POWIAT WARSZAWA'
                    GROUP BY ROK) AS rl ON r.rok = rl.rok
ORDER BY r.rok;";

    private ?string $powiat;

    public function __construct()
    {
        $this->powiat = null;
    }

    public function getSql(): string {
        return $this->sql;
    }

    public function setPowiat(string $powiat): void
    {
        $this->powiat = $powiat;
    }
}
