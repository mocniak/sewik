<?php

namespace Sewik\Domain;

use Sewik\Domain\Dto\Query;
use Sewik\Domain\Dto\QueryResult;

interface DatabaseInterface
{
    public function executeQuery(Query $query): QueryResult;
}
