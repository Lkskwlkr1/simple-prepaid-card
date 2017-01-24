<?php

declare(strict_types=1);

namespace SimplePrepaidCard\CreditCard\Infrastructure;

use Doctrine\ORM\EntityManager;
use Ramsey\Uuid\UuidInterface;
use SimplePrepaidCard\CreditCard\Application\Query\StatementQuery;
use SimplePrepaidCard\CreditCard\Application\Query\StatementView;

class DoctrineORMStatementQuery implements StatementQuery
{
    /** @var EntityManager */
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function get(UuidInterface $creditCardId): array
    {
        return $this->entityManager
            ->getRepository(StatementView::class)
            ->findBy(['creditCardId' => $creditCardId->toString()], ['date' => 'DESC']);
    }
}
