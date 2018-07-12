<?php

namespace App\Repository;

use App\Entity\Arco;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Arco|null find($id, $lockMode = null, $lockVersion = null)
 * @method Arco|null findOneBy(array $criteria, array $orderBy = null)
 * @method Arco[]    findAll()
 * @method Arco[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArcoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Arco::class);
    }

    public function insert($json_data)
    {

        $arco = new Arco();
        $arco->setBegin($json_data->begin);
        $arco->setEnd($json_data->end);
        $arco->setWidth($json_data->width);
        $arco->setLength($json_data->length);
        $arco->setLos($json_data->los);
        $arco->setV($json_data->v);
        $arco->setI($json_data->i);
        $arco->setC($json_data->c);
        $arco->setStairs($json_data->stairs);

        $entityManager = $this->getEntityManager();
        $entityManager->persist($arco);
        $entityManager->flush();

        return array("id" => $arco->getId());
    }

    public function deleteAll(){
        $em = $this->getEntityManager();
        $cmd = $em->getClassMetadata(Arco::class);

        $connection = $em->getConnection();
        $connection->beginTransaction();

        try {
            $connection->query('SET FOREIGN_KEY_CHECKS=0');
            $connection->query('DELETE FROM '.$cmd->getTableName());
            // Beware of ALTER TABLE here--it's another DDL statement and will cause
            // an implicit commit.
            $connection->query('SET FOREIGN_KEY_CHECKS=1');
            $connection->commit();
        } catch (\Exception $e) {
            $connection->rollback();
        }

        $em->flush();
    }

}
