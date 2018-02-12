<?php

namespace Sewik\Infrastructure;

use Sewik\Domain\Accident;
use Sewik\Domain\AccidentsRepositoryInterface;
use Sewik\Domain\Filter;

class MysqlAccidentsRepository implements AccidentsRepositoryInterface
{
    private $link;

    public function __construct(string $host, string $user, string $password, string $database)
    {
        $this->link = new \PDO('mysql:dbname=' . $database . ';host=' . $host, $user, $password);
    }

    /**
     * @param Filter $filter
     * @return Accident[]
     */
    public function findFilteredAccidents(Filter $filter): array
    {

        $accidents = [];

        return $accidents;
    }

    public function getAccident(int $id): Accident
    {
        $stmt = $this->link->prepare("SELECT * FROM zdarzenie WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch();

        return new Accident(
            $row['ID'],
            $row['WOJ'],
            $row['POWIAT'],
            $row['GMINA'],
            $row['MIEJSCOWOSC'],
            $row['ULICA_ADRES'],
            new \DateTimeImmutable($row['DATA_ZDARZENIA']),
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null
        );
    }
}