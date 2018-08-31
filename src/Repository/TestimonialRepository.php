<?php

namespace App\Repository;

use App\Entity\MemberTestimonial;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method MemberTestimonial|null find($id, $lockMode = null, $lockVersion = null)
 * @method MemberTestimonial|null findOneBy(array $criteria, array $orderBy = null)
 * @method MemberTestimonial[]    findAll()
 * @method MemberTestimonial[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TestimonialRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MemberTestimonial::class);
    }
}
