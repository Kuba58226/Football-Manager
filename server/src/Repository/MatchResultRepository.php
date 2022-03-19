<?php

namespace App\Repository;

use App\Entity\MatchResult;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MatchResult|null find($id, $lockMode = null, $lockVersion = null)
 * @method MatchResult|null findOneBy(array $criteria, array $orderBy = null)
 * @method MatchResult[]    findAll()
 * @method MatchResult[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MatchResultRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MatchResult::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(MatchResult $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(MatchResult $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function findMatchResultsOlderThanCurrentDate(): array
    {
        return $this->createQueryBuilder('mr')
            ->where('mr.date < :currentDate')
            ->setParameter(':currentDate', new \DateTime())
            ->getQuery()
            ->getResult();
    }
}
