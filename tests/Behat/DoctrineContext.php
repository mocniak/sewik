<?php

declare(strict_types=1);

namespace Sewik\Tests\Behat;

use Behat\Behat\Context\Context;
use Behat\Hook\BeforeScenario;
use Behat\Hook\BeforeStep;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManagerInterface;

final class DoctrineContext implements Context
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @BeforeScenario
     */
    public function purgeDatabase(): void
    {
        $this->entityManager->getConnection()->getConfiguration()->setSQLLogger(null);
        $purger = new ORMPurger($this->entityManager);
        $purger->purge();
        $this->entityManager->clear();
    }

    /**
     * @BeforeStep
     */
    public function clearEntityManager(): void
    {
        $this->entityManager->clear();
    }
}
