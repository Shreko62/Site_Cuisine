<?php

namespace App\Repository;

use App\Entity\CookTool;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CookTool|null find($id, $lockMode = null, $lockVersion = null)
 * @method CookTool|null findOneBy(array $criteria, array $orderBy = null)
 * @method CookTool[]    findAll()
 * @method CookTool[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CookToolRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CookTool::class);
    }

    // /**
    //  * @return CookTool[] Returns an array of CookTool objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CookTool
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
