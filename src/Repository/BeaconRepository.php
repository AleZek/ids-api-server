<?php

namespace App\Repository;

use App\Entity\Beacon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Beacon|null find($id, $lockMode = null, $lockVersion = null)
 * @method Beacon|null findOneBy(array $criteria, array $orderBy = null)
 * @method Beacon[]    findAll()
 * @method Beacon[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BeaconRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Beacon::class);
    }

//    /**
//     * @return Beacon[] Returns an array of Beacon objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Beacon
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
