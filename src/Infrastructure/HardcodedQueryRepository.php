<?php
namespace Sewik\Infrastructure;

use Sewik\Domain\Query;
use Sewik\Domain\QueryRepositoryInterface;

class HardcodedQueryRepository implements QueryRepositoryInterface
{
    private $queries;

    public function __construct()
    {
        $this->queries = [];
        $this->queries[] = 'SELECT MONTH(DATA_ZDARZ) AS lp, MONTHNAME(DATA_ZDARZ) AS miesiac, COUNT(*) AS zdarzenia FROM zdarzenie GROUP BY lp,miesiac ORDER BY lp ASC;';
        $this->queries[] = 'SELECT DAYOFWEEK(DATA_ZDARZ) AS lp, DAYNAME(DATA_ZDARZ) AS dzien_tygodnia, COUNT(*) AS zdarzenia FROM zdarzenie GROUP BY lp,dzien_tygodnia ORDER BY lp ASC;';
        $this->queries[] = 'SELECT HOUR(GODZINA_ZDARZ) AS godzina, COUNT(*) AS zdarzenia FROM zdarzenie GROUP BY godzina;';
        $this->queries[] = 'SELECT szos.opis AS oswietlenie, zdarzenia FROM (
    SELECT
      szos_kod, count(*) AS zdarzenia FROM zdarzenie
  GROUP BY SZOS_KOD
  ) AS zdarzenie
    LEFT JOIN szos
    ON zdarzenie.szos_kod=szos.kod ORDER BY zdarzenia DESC';
        $this->queries[] = 'SELECT sswa.opis AS warunki, zdarzenia FROM (
    SELECT SSWA_KOD, count(*) AS zdarzenia FROM zdarzenie GROUP BY SSWA_KOD) AS zdarzenie
LEFT JOIN sswa ON sswa.kod=zdarzenie.sswa_kod ORDER BY zdarzenia DESC';
        $this->queries[] = 'SELECT $typ, COUNT($typ) ilosc FROM zdarzenie GROUP BY powiat ORDER BY ilosc DESC LIMIT 30';
        $this->queries[] = 'SELECT $typ, COUNT($typ) ilosc FROM zdarzenie GROUP BY miejscowosc ORDER BY ilosc DESC LIMIT 30';
        $this->queries[] = 'SELECT $typ, COUNT($typ) ilosc FROM zdarzenie GROUP BY predkosc_dopuszczalna ORDER BY ilosc DESC LIMIT 30';
        $this->queries[] = 'SELECT chmz.opis AS miejsce, zdarzenia FROM
  (SELECT chmz_kod, COUNT(*) AS zdarzenia
   FROM zdarzenie GROUP BY chmz_kod) AS zdarzenie
  LEFT JOIN chmz ON chmz.kod=zdarzenie.chmz_kod
ORDER BY zdarzenia DESC';
        $this->queries[] = 'SELECT $typ, COUNT($typ) ilosc FROM zdarzenie GROUP BY powiat ORDER BY ilosc DESC LIMIT 30';
        $this->queries[] = 'SELECT zabu.opis AS obszar, zdarzenia FROM
  (SELECT ZABU_KOD, COUNT(*) AS zdarzenia FROM zdarzenie GROUP BY ZABU_KOD) AS zdarzenie
  INNER JOIN zabu ON zabu.kod=zdarzenie.zabu_kod ORDER BY zdarzenia DESC';
        $this->queries[] = 'SELECT geod.opis AS geometria, zdarzenia FROM
  (SELECT geod_KOD, COUNT(*) AS zdarzenia FROM zdarzenie GROUP BY geod_KOD) AS zdarzenie
  INNER JOIN geod ON geod.kod=zdarzenie.geod_kod ORDER BY zdarzenia DESC;';
    }

    public function getAll(): array
    {
        $queries = [];
        foreach ($this->queries as $sqlQuery) {
            $queries[] = new Query($sqlQuery);
        }
        return $queries;
    }
}