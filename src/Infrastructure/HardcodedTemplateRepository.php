<?php
namespace Sewik\Infrastructure;

use Ramsey\Uuid\UuidInterface;
use Sewik\Domain\QueryTemplate;
use Sewik\Domain\TemplateRepositoryInterface;

class HardcodedTemplateRepository implements TemplateRepositoryInterface
{
    private $queries;

    public function __construct()
    {
        $this->queries = [];
        $this->queries[] = ['name' => 'Zdarzenia wg miesiąca','query' => 'SELECT MONTH(DATA_ZDARZ) AS lp, MONTHNAME(DATA_ZDARZ) AS miesiac, COUNT(*) AS zdarzenia FROM zdarzenie %zdarzenie_filter% GROUP BY lp,miesiac ORDER BY lp ASC;'];
        $this->queries[] = ['name' => 'Zdarzenia wg dnia tygodnia','query' => 'SELECT DAYOFWEEK(DATA_ZDARZ) AS lp, DAYNAME(DATA_ZDARZ) AS dzien_tygodnia, COUNT(*) AS zdarzenia FROM zdarzenie %zdarzenie_filter% GROUP BY lp,dzien_tygodnia ORDER BY lp ASC;'];
        $this->queries[] = ['name' => 'Zdarzenia wg godziny','query' => 'SELECT HOUR(GODZINA_ZDARZ) AS godzina, COUNT(*) AS zdarzenia FROM zdarzenie  %zdarzenie_filter%  GROUP BY godzina;'];
//        $this->queries[] = 'SELECT szos.opis AS oswietlenie, zdarzenia FROM (
//    SELECT
//      szos_kod, count(*) AS zdarzenia FROM zdarzenie %zdarzenie_filter%
//  GROUP BY SZOS_KOD
//  ) AS zdarzenie
//    LEFT JOIN szos
//    ON zdarzenie.szos_kod=szos.kod ORDER BY zdarzenia DESC';
//        $this->queries[] = 'SELECT sswa.opis AS warunki, zdarzenia FROM (
//    SELECT SSWA_KOD, count(*) AS zdarzenia FROM zdarzenie %zdarzenie_filter%  GROUP BY SSWA_KOD) AS zdarzenie
//LEFT JOIN sswa ON sswa.kod=zdarzenie.sswa_kod ORDER BY zdarzenia DESC';
//        $this->queries[] = 'SELECT powiat, COUNT(*) ilosc FROM zdarzenie %zdarzenie_filter%  GROUP BY powiat ORDER BY ilosc DESC LIMIT 30';
//        $this->queries[] = 'SELECT miejscowosc, COUNT(*) ilosc FROM zdarzenie %zdarzenie_filter%  GROUP BY miejscowosc ORDER BY ilosc DESC LIMIT 30';
//        $this->queries[] = 'SELECT predkosc_dopuszczalna, COUNT(*) ilosc FROM zdarzenie %zdarzenie_filter%  GROUP BY predkosc_dopuszczalna ORDER BY ilosc DESC LIMIT 30';
//        $this->queries[] = 'SELECT chmz.opis AS miejsce, zdarzenia FROM
//  (SELECT chmz_kod, COUNT(*) AS zdarzenia
//   FROM zdarzenie %zdarzenie_filter%  GROUP BY chmz_kod) AS zdarzenie
//  LEFT JOIN chmz ON chmz.kod=zdarzenie.chmz_kod
//ORDER BY zdarzenia DESC';
//        $this->queries[] = 'SELECT zabu.opis AS obszar, zdarzenia FROM
//  (SELECT ZABU_KOD, COUNT(*) AS zdarzenia FROM zdarzenie  %zdarzenie_filter% GROUP BY ZABU_KOD) AS zdarzenie
//  INNER JOIN zabu ON zabu.kod=zdarzenie.zabu_kod ORDER BY zdarzenia DESC';
//        $this->queries[] = 'SELECT geod.opis AS geometria, zdarzenia FROM
//  (SELECT geod_KOD, COUNT(*) AS zdarzenia FROM zdarzenie  %zdarzenie_filter%  GROUP BY geod_KOD) AS zdarzenie
//  INNER JOIN geod ON geod.kod=zdarzenie.geod_kod ORDER BY zdarzenia DESC;';
    }

    public function getAll(): array
    {
        $queries = [];
        foreach ($this->queries as $sqlQuery) {
            $queries[] = new QueryTemplate($sqlQuery['query'],$sqlQuery['name']);
        }
        return $queries;
    }

    public function save(QueryTemplate $template): void
    {
        // TODO: Implement save() method.
    }

    public function get(UuidInterface $templateId): QueryTemplate
    {
        // TODO: Implement get() method.
    }
}