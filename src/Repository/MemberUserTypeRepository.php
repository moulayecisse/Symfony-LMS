<?php

namespace App\Repository;

use App\Entity\MemberUserType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method MemberUserType|null find($id, $lockMode = null, $lockVersion = null)
 * @method MemberUserType|null findOneBy(array $criteria, array $orderBy = null)
 * @method MemberUserType[]    findAll()
 * @method MemberUserType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MemberUserTypeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MemberUserType::class);
    }
}
