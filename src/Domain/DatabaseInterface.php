<?php
namespace Sewik\Domain;

interface DatabaseInterface
{
    public function filter(Filter $filter);

    public function executeQuery(Query $query): Report;
}