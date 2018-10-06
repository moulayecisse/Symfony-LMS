<?php

namespace App\Repository;

use App\Entity\Book\BookLocation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method BookLocation|null find($id, $lockMode = null, $lockVersion = null)
 * @method BookLocation|null findOneBy(array $criteria, array $orderBy = null)
 * @method BookLocation[]    findAll()
 * @method BookLocation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookLocationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, BookLocation::class);
    }
}
