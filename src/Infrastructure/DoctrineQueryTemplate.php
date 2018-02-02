<?php

namespace Sewik\Infrastructure;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Sewik\Domain\QueryTemplate;
use Sewik\Domain\TemplateRepositoryInterface;

class DoctrineQueryTemplate implements TemplateRepositoryInterface
{
    private $entityManager;
    private $repository;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository(QueryTemplate::class);
    }

    /**
     * @return QueryTemplate[]
     */
    public function getAll(): array
    {
        return $this->repository->findAll();
    }

    public function save(QueryTemplate $template): void
    {
        try {
            $this->entityManager->persist($template);
            $this->entityManager->flush();
        } catch (ORMException $e) {
            throw new \RuntimeException('Saving Template failed: ' . $e->getMessage());
        }
    }
}