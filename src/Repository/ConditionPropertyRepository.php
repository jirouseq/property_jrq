<?php

namespace App\Repository;

use App\Entity\ConditionProperty;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ConditionProperty>
 *
 * @method ConditionProperty|null find($id, $lockMode = null, $lockVersion = null)
 * @method ConditionProperty|null findOneBy(array $criteria, array $orderBy = null)
 * @method ConditionProperty[]    findAll()
 * @method ConditionProperty[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConditionPropertyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ConditionProperty::class);
    }

    //    /**
    //     * @return ConditionProperty[] Returns an array of ConditionProperty objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?ConditionProperty
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
