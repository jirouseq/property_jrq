<?php

namespace App\Repository;

use App\Entity\Ownership;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Ownership>
 *
 * @method Ownership|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ownership|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ownership[]    findAll()
 * @method Ownership[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OwnershipRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ownership::class);
    }

    //    /**
    //     * @return Ownership[] Returns an array of Ownership objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('o')
    //            ->andWhere('o.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('o.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Ownership
    //    {
    //        return $this->createQueryBuilder('o')
    //            ->andWhere('o.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
