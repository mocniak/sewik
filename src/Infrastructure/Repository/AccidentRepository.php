<?php

namespace Sewik\Infrastructure\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Sewik\Domain\Entity\Accident;

class AccidentRepository
{
    private readonly EntityManagerInterface $entityManager;
    private readonly ObjectRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository(Accident::class);
    }

    public function add(Accident $accident): void
    {
        $this->entityManager->persist($accident);
        $this->entityManager->flush();
    }

    public function removeAll(): void
    {
        foreach ($this->repository->findAll() as $accident) {
            $this->entityManager->remove($accident);
        }
        $this->entityManager->flush();
    }
}
