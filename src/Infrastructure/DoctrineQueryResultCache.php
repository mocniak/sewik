<?php

namespace Sewik\Infrastructure;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\ORMException;
use Sewik\Domain\Dto\Query;
use Sewik\Domain\Dto\QueryResult;
use Sewik\Infrastructure\Entity\CachedQueryResult;

class DoctrineQueryResultCache implements QueryResultCacheInterface
{
    private readonly EntityManagerInterface $entityManager;
    private readonly EntityRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
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
