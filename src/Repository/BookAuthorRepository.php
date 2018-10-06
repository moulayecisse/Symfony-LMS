<?php

namespace App\Repository;

use App\Entity\Book\BookAuthor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method BookAuthor|null find($id, $lockMode = null, $lockVersion = null)
 * @method BookAuthor|null findOneBy(array $criteria, array $orderBy = null)
 * @method BookAuthor[]    findAll()
 * @method BookAuthor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookAuthorRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, BookAuthor::class);
    }
}
