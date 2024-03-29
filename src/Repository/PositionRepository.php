<?php

namespace App\Repository;

use App\Entity\Position;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Position|null find($id, $lockMode = null, $lockVersion = null)
 * @method Position|null findOneBy(array $criteria, array $orderBy = null)
 * @method Position[]    findAll()
 * @method Position[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PositionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Position::class);
    }

    //SELECT beacon,count(beacon) FROM `position` GROUP BY beacon

    public function getSingleBeaconCount($beacon){
        return $this->createQueryBuilder('p')
            ->groupBy("beacon")
            ->select(array('count(beacon)', 'beacon'))
            ->where('beacon = :beacon')
            ->setParameter('beacon', $beacon)
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }

    public function deleteByUser($user){
        return $this->createQueryBuilder('p')

            ->delete()
            ->where('user = :user')
            ->setParameter('user', $user)

            ->getQuery()
            ->getResult();
    }
//    /**
//     * @return Position[] Returns an array of Position objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Position
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
