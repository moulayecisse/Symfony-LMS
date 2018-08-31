<?php

namespace App\Repository;

use App\Entity\LibrarianUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method LibrarianUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method LibrarianUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method LibrarianUser[]    findAll()
 * @method LibrarianUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LibrarianRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, LibrarianUser::class);
    }
}
