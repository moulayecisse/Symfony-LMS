<?php

namespace App\Repository;

use App\Entity\User\Member\MemberUserSubscriptionType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method MemberUserSubscriptionType|null find($id, $lockMode = null, $lockVersion = null)
 * @method MemberUserSubscriptionType|null findOneBy(array $criteria, array $orderBy = null)
 * @method MemberUserSubscriptionType[]    findAll()
 * @method MemberUserSubscriptionType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MemberSubscriptionTypeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MemberUserSubscriptionType::class);
    }
}
