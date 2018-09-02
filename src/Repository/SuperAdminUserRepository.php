<?php

namespace App\Repository;

use App\Entity\SuperAdminUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SuperAdminUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method SuperAdminUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method SuperAdminUser[]    findAll()
 * @method SuperAdminUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SuperAdminUserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SuperAdminUser::class);
    }
}
