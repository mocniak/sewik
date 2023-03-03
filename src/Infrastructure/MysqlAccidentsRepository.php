<?php

namespace Sewik\Infrastructure;

use Sewik\Domain\AccidentsRepositoryInterface;
use Sewik\Domain\Entity\Accident;
use Sewik\Domain\Entity\Participant;
use Sewik\Domain\Entity\Vehicle;
use Sewik\Domain\Filter;

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
            $stmt = $this->link->prepare("SELECT * FROM zdarzenie ORDER BY id ASC LIMIT 1000");
        } else {
            $stmt = $this->link->prepare("SELECT * FROM zdarzenie WHERE " . $filter->getAccidentsFilterSql() . " ORDER BY id ASC LIMIT 1000");
        }

        $stmt->execute();
        $rows = $stmt->fetchAll();

        foreach ($rows as $row) {
            $accidents[] = $this->rowToAccident($row, [], []);
        }

        return $accidents;
    }

    public function getAccident(int $accidentID): Accident
    {
        $vehicleStatement = $this->link->prepare("SELECT * FROM pojazdy WHERE zszd_id = :id");
        $vehicleStatement->bindValue(':id', $accidentID);
        $vehicleStatement->execute();
        $vehicleRows = $vehicleStatement->fetchAll();
        $vehicles = [];
        foreach ($vehicleRows as $vehicleRow) {
            $passengers = [];
            $passengersStatement = $this->link->prepare("SELECT * FROM uczestnicy WHERE zspo_id = :id");
            $passengersStatement->bindValue(':id', $vehicleRow['ID']);
            $passengersStatement->execute();
            $passengerRows = $passengersStatement->fetchAll();
            foreach ($passengerRows as $passengerRow) {
                $passengers[] = $this->rowToParticipant($passengerRow);
            }
            $vehicles[] = $this->rowToVehicle($vehicleRow, $passengers);
        }

        $stmt = $this->link->prepare("SELECT * FROM zdarzenie WHERE id = :id");
        $stmt->bindValue(':id', $accidentID);
        $stmt->execute();
        $row = $stmt->fetch();

        $pedestrianStatement = $this->link->prepare("SELECT * FROM uczestnicy WHERE zszd_id = :id AND zspo_id IS NULL");
        $pedestrianStatement->bindValue(':id', $accidentID);
        $pedestrianStatement->execute();
        $pedestrianRows = $pedestrianStatement->fetchAll();

        $pedestrians = [];
        foreach ($pedestrianRows as $pedestrianRow) {
            $pedestrians[] = $this->rowToParticipant($pedestrianRow);
        }

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
            $pedestrians,
            $row['WSP_GPS_X'],
            $row['WSP_GPS_Y']
        );
    }

    private function rowToVehicle(array $row, $passengers): Vehicle
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

    private function rowToParticipant($passengerRow): Participant
    {
        return new Participant(
            $passengerRow['ID'],
            $passengerRow['ZSZD_ID'],
            $passengerRow['SSRU_KOD'],
            (null == $passengerRow['DATA_UR']) ? null : new \DateTimeImmutable($passengerRow['DATA_UR']),
            $passengerRow['PLEC'],
            $passengerRow['SUSU_KOD'],
            $passengerRow['LICZBA_LAT_KIEROWANIA'],
            $passengerRow['SPSZ_KOD'],
            $passengerRow['SPPI_KOD'],
            $passengerRow['SRUZ_KOD'],
            $passengerRow['SUSW_KOD'],
            $passengerRow['STUC_KOD'],
            $passengerRow['SUSB_KOD']
        );
    }
}
