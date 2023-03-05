<?php

namespace Sewik\Infrastructure;

use Sewik\Domain\DatabaseInterface;
use Sewik\Domain\InvalidQueryException;
use Sewik\Domain\Query;
use Sewik\Domain\QueryResult;

class MysqlDatabase implements DatabaseInterface
{
    private \PDO $link;

    public function __construct(string $dsn)
    {
        try {
            $this->link = new \PDO($dsn, 'root','very_secure89');
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
