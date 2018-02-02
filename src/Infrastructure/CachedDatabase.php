<?php

namespace Sewik\Infrastructure;

use Sewik\Domain\DatabaseInterface;
use Sewik\Domain\Query;
use Sewik\Domain\Report;

class CachedDatabase implements DatabaseInterface
{
    private $cache;
    private $actualDatabase;

    public function __construct(ReportCacheInterface $cache, DatabaseInterface $actualDatabase)
    {
        $this->cache = $cache;
        $this->actualDatabase = $actualDatabase;
    }

    public function executeQuery(Query $query): Report
    {
        $report = $this->cache->findForQuery($query);

        if (null !== $report) {
            return $report;
        }

        $report = $this->actualDatabase->executeQuery($query);
        try {
            $this->cache->add($report, $query);
        } catch (\RuntimeException $e) {
            //log something here!
        }
        return $report;
    }
}