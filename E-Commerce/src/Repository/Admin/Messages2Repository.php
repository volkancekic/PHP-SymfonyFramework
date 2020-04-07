<?php

namespace App\Repository\Admin;

use App\Entity\Admin\Messages2;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Messages2|null find($id, $lockMode = null, $lockVersion = null)
 * @method Messages2|null findOneBy(array $criteria, array $orderBy = null)
 * @method Messages2[]    findAll()
 * @method Messages2[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Messages2Repository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Messages2::class);
    }

//    /**
//     * @return Messages2[] Returns an array of Messages2 objects
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
    public function findOneBySomeField($value): ?Messages2
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
