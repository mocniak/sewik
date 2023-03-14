<?php

namespace Sewik\Infrastructure;

use Sewik\Domain\DatabaseInterface;
use Sewik\Domain\Dto\Query;
use Sewik\Domain\Dto\QueryResult;
use Sewik\Domain\Exception\InvalidQueryException;

class MysqlDatabase implements DatabaseInterface
{
    private \PDO $link;

    public function __construct(string $host, string $user, string $password, string $database)
    {
        try {
        $this->link = new \PDO(
            'mysql:dbname=' . $database . ';host=' . $host,
            $user,
            $password,
            [\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"]);
        } catch (\Throwable $e) {
            throw new \RuntimeException("Connection failed: %s\n", 0, $e);
        }
    }

    public function executeQuery(Query $query): QueryResult
    {
        $time = microtime(true);
        try {
            $statement = $this->link->query($query->getSqlQuery());
        } catch (\Throwable $throwable) {
            throw new InvalidQueryException('Query Failed: ' . $throwable->getMessage() . '. Query: ' . $query->getSqlQuery(), 0, $throwable);
        }
        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
        if(count($result)>0) {
            $headerRow = array_keys($result[0]);
        } else {
            $headerRow = [];
        }

        return new QueryResult($result, $headerRow, microtime(true) - $time);
    }
}
