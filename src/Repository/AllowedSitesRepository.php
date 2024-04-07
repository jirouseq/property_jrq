<?php

namespace App\Repository;

use App\Entity\AllowedSites;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AllowedSites>
 *
 * @method AllowedSites|null find($id, $lockMode = null, $lockVersion = null)
 * @method AllowedSites|null findOneBy(array $criteria, array $orderBy = null)
 * @method AllowedSites[]    findAll()
 * @method AllowedSites[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AllowedSitesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AllowedSites::class);
    }

    //    /**
    //     * @return AllowedSites[] Returns an array of AllowedSites objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('a.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?AllowedSites
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
