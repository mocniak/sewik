<?php

namespace Sewik\Infrastructure;

use Sewik\Domain\Accident;
use Sewik\Domain\AccidentsRepositoryInterface;
use Sewik\Domain\Filter;
use Sewik\Domain\Vehicle;

class MysqlAccidentsRepository implements AccidentsRepositoryInterface
{
    private $link;

    public function __construct(string $host, string $user, string $password, string $database)
    {
        $this->link = new \PDO(
            'mysql:dbname=' . $database . ';host=' . $host,
            $user,
            $password,
            [\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"]);
    }

    /**
     * @param Filter $filter
     * @return Accident[]
     */
    public function findFilteredAccidents(Filter $filter): array
    {
        $accidents = [];
        if (empty($filter->getAccidentsFilterSql())) {
            $stmt = $this->link->prepare("SELECT * FROM zdarzenie ORDER BY id ASC LIMIT 50");
        } else {
            $stmt = $this->link->prepare("SELECT * FROM zdarzenie WHERE " . $filter->getAccidentsFilterSql() . " ORDER BY id ASC LIMIT 50");
        }

        $stmt->execute();
        $rows = $stmt->fetchAll();

        foreach ($rows as $row) {
            $accidents[] = $this->rowToAccident($row);
        }

        return $accidents;
    }

    public function getAccident(int $id): Accident
    {
        $stmt = $this->link->prepare("SELECT * FROM pojazdy WHERE zszd_id = :id");
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        $vehicles = [];
        foreach ($rows as $row) {
            $passengers = [];
            $vehicles[] = $this->rowToVehicle($row, $passengers);
        }

        $stmt = $this->link->prepare("SELECT * FROM zdarzenie WHERE id = :id");
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch();
        $pedestrians = [];
        return $this->rowToAccident($row, $vehicles, $pedestrians);
    }

    private function rowToAccident(array $row, $vehicles, $pedestrians): Accident
    {
        return new Accident(
            $row['ID'],
            $row['WOJ'],
            $row['POWIAT'],
            $row['GMINA'],
            $row['MIEJSCOWOSC'],
            $row['ULICA_ADRES'],
            $row['NUMER_DOMU'],
            $row['ULICA_SKRZYZ'],
            new \DateTimeImmutable($row['DATA_ZDARZENIA']),
            $row['SZOS_KOD'],
            $row['SSWA_KOD'],
            $row['CHMZ_KOD'],
            $row['PREDKOSC_DOPUSZCZALNA'],
            $row['NADR_KOD'],
            $row['RODR_KOD'],
            $row['SYSW_KOD'],
            $row['OZPO_KOD'],
            $row['SKRZ_KOD'],
            $row['ZABU_KOD'],
            $row['spip_kod'],
            $row['STNA_KOD'],
            $row['SZRD_KOD'],
            $row['GEOD_KOD'],
            $vehicles,
            $pedestrians
        );
    }

    private function rowToVehicle(array $row, $passengers)
    {
        return new Vehicle(
            $row['ID'],
            $row['ZSZD_ID'],
            $row['RODZAJ_POJAZDU'],
            $row['MARKA'],
            $row['SPSP_KOD'],
            $row['SPIC_KOD'],
            $passengers
        );
    }
}