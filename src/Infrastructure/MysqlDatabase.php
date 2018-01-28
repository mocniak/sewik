<?php
namespace Sewik\Infrastructure;

use Sewik\Domain\DatabaseInterface;
use Sewik\Domain\Filter;
use Sewik\Domain\Query;
use Sewik\Domain\Report;

class MysqlDatabase implements DatabaseInterface
{
    private $link;
    private $isFiltered;

    public function __construct(string $host, string $user, string $password, string $database)
    {
        $this->link = new \mysqli($host, $user, $password, $database);
        if ($this->link->connect_errno) {
            throw new \RuntimeException("Connect failed: %s\n", $this->link->connect_error);
        }
        $this->isFiltered = false;
    }

    public function filter(Filter $filter)
    {
        $this->isFiltered = true;
    }

    public function executeQuery(Query $query): Report
    {
        $time = microtime(true);
        if (!$this->isFiltered) throw new \RuntimeException('You cannot run queries on unfiltered database!');
        $query = $this->link->query($query->getSqlQuery());
        if (!$query) throw new \RuntimeException('Query Failed: ' . $this->link->error);
        $result = $query->fetch_all();
        $query->close();
        return new Report($result, microtime(true) - $time);
    }

    public function __destruct()
    {
        $this->link->close();
    }
}