<?php

namespace App\Repository;

use App\Entity\BookEditor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method BookEditor|null find($id, $lockMode = null, $lockVersion = null)
 * @method BookEditor|null findOneBy(array $criteria, array $orderBy = null)
 * @method BookEditor[]    findAll()
 * @method BookEditor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EditorRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, BookEditor::class);
    }

//    /**
//     * @return BookEditor[] Returns an array of BookEditor objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BookEditor
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
