<?php

namespace App\Repository;

use App\Entity\Mappa;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Mappa|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mappa|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mappa[]    findAll()
 * @method Mappa[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MappaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Mappa::class);
    }

//    /**
//     * @return Mappa[] Returns an array of Mappa objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Mappa
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
