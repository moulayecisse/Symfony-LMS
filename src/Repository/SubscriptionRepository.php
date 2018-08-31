<?php

namespace App\Repository;

use App\Entity\MemberSubscriptionType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method MemberSubscriptionType|null find($id, $lockMode = null, $lockVersion = null)
 * @method MemberSubscriptionType|null findOneBy(array $criteria, array $orderBy = null)
 * @method MemberSubscriptionType[]    findAll()
 * @method MemberSubscriptionType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubscriptionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MemberSubscriptionType::class);
    }
}
