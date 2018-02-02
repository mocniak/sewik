<?php

namespace Sewik\Infrastructure;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Sewik\Domain\Query;
use Sewik\Domain\Report;

class DoctrineReportCache implements ReportCacheInterface
{
    private $entityManager;
    private $repository;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository(CachedReport::class);
    }

    public function findForQuery(Query $query): ?Report
    {
        /** @var CachedReport $cachedReport */
        $cachedReport = $this->repository->findOneBy(['queryHash' => sha1($query->getSqlQuery())]);

        if (null == $cachedReport) {
            return null;
        }

        return $cachedReport->getReport();
    }

    public function add(Report $report, Query $query)
    {
        try {
            $this->entityManager->persist(new CachedReport($report, $query));
            $this->entityManager->flush();
        } catch (ORMException $e) {
            throw new \RuntimeException('Cache failed: ' . $e->getMessage());
        }
    }
}