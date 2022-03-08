<?php

namespace App\Repository;

use App\Entity\DefaultPlayer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DefaultPlayer|null find($id, $lockMode = null, $lockVersion = null)
 * @method DefaultPlayer|null findOneBy(array $criteria, array $orderBy = null)
 * @method DefaultPlayer[]    findAll()
 * @method DefaultPlayer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DefaultPlayerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DefaultPlayer::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(DefaultPlayer $entity, bool $flush = true): void
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
    public function remove(DefaultPlayer $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }
}
