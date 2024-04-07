<?php

namespace App\Repository;

use App\Entity\NearByGroup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<NearByGroup>
 *
 * @method NearByGroup|null find($id, $lockMode = null, $lockVersion = null)
 * @method NearByGroup|null findOneBy(array $criteria, array $orderBy = null)
 * @method NearByGroup[]    findAll()
 * @method NearByGroup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NearByGroupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NearByGroup::class);
    }

    //    /**
    //     * @return NearByGroup[] Returns an array of NearByGroup objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('n')
    //            ->andWhere('n.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('n.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?NearByGroup
    //    {
    //        return $this->createQueryBuilder('n')
    //            ->andWhere('n.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
