<?php
namespace Sewik\Infrastructure;

use Sewik\Domain\DatabaseInterface;
use Sewik\Domain\Query;
use Sewik\Domain\Report;

class MysqlDatabase implements DatabaseInterface
{
    private $link;

    public function __construct(string $host, string $user, string $password, string $database)
    {
        $this->link = new \mysqli($host, $user, $password, $database);
        $this->link->set_charset('utf8');
        if ($this->link->connect_errno) {
            throw new \RuntimeException("Connect failed: %s\n", $this->link->connect_error);
        }
    }

    public function executeQuery(Query $query): Report
    {
        $time = microtime(true);
        $resultQuery = $this->link->query($query->getSqlQuery());
        if (!$resultQuery) throw new \RuntimeException('Query Failed: ' . $this->link->error . '. Query: ' . $query->getSqlQuery());
        $result = $resultQuery->fetch_all(MYSQLI_ASSOC);
        $fields = $resultQuery->fetch_fields();
        $headers = [];
        foreach ($fields as $field) {
            $headers[] = $field->name;
        }

        $resultQuery->close();
        return new Report($result, $headers, microtime(true) - $time);
    }

    public function __destruct()
    {
        $this->link->close();
    }
}