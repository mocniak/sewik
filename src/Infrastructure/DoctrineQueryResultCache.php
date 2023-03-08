<?php

namespace Sewik\Infrastructure;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Sewik\Domain\Query;
use Sewik\Domain\QueryResult;

class DoctrineQueryResultCache implements QueryResultCacheInterface
{
    private $entityManager;
    private $repository;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository(CachedQueryResult::class);
    }

    public function findForQuery(Query $query): ?QueryResult
    {
        /** @var CachedQueryResult $cachedReport */
        $cachedReport = $this->repository->findOneBy(['queryHash' => sha1($query->getSqlQuery())]);

        if (null === $cachedReport) {
            return null;
        }

        return $cachedReport->getQueryResult();
    }

    public function add(QueryResult $report, Query $query)
    {
        try {
            if ($this->findForQuery($query) === null) {
                $this->entityManager->persist(new CachedQueryResult($report, $query));
                $this->entityManager->flush();
            }
        } catch (ORMException $e) {
            throw new \RuntimeException('Cache failed: ' . $e->getMessage());
        }
    }
}
