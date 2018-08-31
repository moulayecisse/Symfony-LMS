<?php

namespace App\Repository;

use App\Entity\BookFormat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method BookFormat|null find($id, $lockMode = null, $lockVersion = null)
 * @method BookFormat|null findOneBy(array $criteria, array $orderBy = null)
 * @method BookFormat[]    findAll()
 * @method BookFormat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormatRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, BookFormat::class);
    }

//    /**
//     * @return BookFormat[] Returns an array of BookFormat objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BookFormat
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
