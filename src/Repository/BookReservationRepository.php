<?php

namespace App\Repository;

use App\Entity\Book\BookBooking;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method BookBooking|null find($id, $lockMode = null, $lockVersion = null)
 * @method BookBooking|null findOneBy(array $criteria, array $orderBy = null)
 * @method BookBooking[]    findAll()
 * @method BookBooking[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookReservationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, BookBooking::class);
    }
}
