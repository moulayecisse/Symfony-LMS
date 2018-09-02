<?php

namespace App\Repository;

use App\Entity\MemberUserSubscription;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method MemberUserSubscription|null find($id, $lockMode = null, $lockVersion = null)
 * @method MemberUserSubscription|null findOneBy(array $criteria, array $orderBy = null)
 * @method MemberUserSubscription[]    findAll()
 * @method MemberUserSubscription[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MemberUserSubscriptionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MemberUserSubscription::class);
    }
}
