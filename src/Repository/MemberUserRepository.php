<?php

namespace App\Repository;

use App\Entity\BookRent;
use App\Entity\Library;
use App\Entity\MemberUser;
use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method MemberUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method MemberUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method MemberUser[]    findAll()
 * @method MemberUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MemberUserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MemberUser::class);
    }

    public function findLateByLibrary($libraryId)
    {
        return $this->findAll();
//        return $this->createQueryBuilder('member')
//            ->join( BookRent::class, 'booking' )
//            ->join( Library::class, 'library' )
//            ->join( Book::class, 'pbook' )

//            ->where('booking.endDate < CURRENT_DATE()')
//            ->andWhere('member.id = booking.member_id')
//            ->andWhere('booking.returnDate IS NULL')
//            ->andWhere('library.id = :library_id')
//            ->setParameter('library_id', $libraryId)

//            ->getQuery()
//            ->getResult()
//            ;
    }
}
