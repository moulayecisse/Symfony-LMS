<?php

namespace App\Repository;

use App\Entity\MemberUserTestimonial;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method MemberUserTestimonial|null find($id, $lockMode = null, $lockVersion = null)
 * @method MemberUserTestimonial|null findOneBy(array $criteria, array $orderBy = null)
 * @method MemberUserTestimonial[]    findAll()
 * @method MemberUserTestimonial[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MemberUserTestimonialRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MemberUserTestimonial::class);
    }
}
