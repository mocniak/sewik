<?php
namespace Sewik\Domain;

interface DatabaseInterface
{
    public function executeQuery(Query $query): QueryResult;
}