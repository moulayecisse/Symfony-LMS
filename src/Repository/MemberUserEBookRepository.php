<?php

namespace App\Repository;

use App\Entity\MemberUserEBook;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method MemberUserEBook|null find($id, $lockMode = null, $lockVersion = null)
 * @method MemberUserEBook|null findOneBy(array $criteria, array $orderBy = null)
 * @method MemberUserEBook[]    findAll()
 * @method MemberUserEBook[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MemberUserEBookRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MemberUserEBook::class);
    }
}
