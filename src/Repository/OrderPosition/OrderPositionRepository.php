<?php

namespace App\Repository\OrderPosition;

use App\Entity\OrderPosition;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<OrderPosition>
 *
 * @method OrderPosition|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderPosition|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderPosition[]    findAll()
 * @method OrderPosition[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderPositionRepository extends ServiceEntityRepository
{
    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrderPosition::class);
    }
}
