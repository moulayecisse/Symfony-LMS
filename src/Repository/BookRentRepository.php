<?php

namespace App\Repository;

use App\Entity\BookModel;
use App\Entity\BookRent;
use App\Entity\ImageFile;
use App\Entity\Library;
use App\Entity\Book;
use App\Entity\MemberUser;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\DBALException;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method BookRent|null find($id, $lockMode = null, $lockVersion = null)
 * @method BookRent|null findOneBy(array $criteria, array $orderBy = null)
 * @method BookRent[]    findAll()
 * @method BookRent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, BookRent::class);
    }

    public function findByLibrary($libraryId)
    {
        return $this->createQueryBuilder('br')
            ->join(Book::class, 'b')
            ->join(Library::class, 'l')
            ->andWhere('l.id = :library_id')
            ->setParameter('library_id', $libraryId)

            ->getQuery()
            ->getResult();
    }

    /**
     * @param bool $libraryId
     * @param bool $memberUserId
     * @param bool $currentOnly
     * @param bool $late
     * @param null $date
     *
     * @return QueryBuilder
     */
    private function queryBooking($libraryId = false, $memberUserId = false, $currentOnly = false, $late = false, $date = null): QueryBuilder
    {
        $queryBuilder = $this->createQueryBuilder('br');

        $date = $date ?? new DateTime('now');

        if ($libraryId && is_int($libraryId)) {
            $queryBuilder->join(Book::class, 'b');
            $queryBuilder->join(Library::class, 'l');
            $queryBuilder->where('l.id = :library_id');
            $queryBuilder->setParameter('library_id', $libraryId);
        }

        if ($memberUserId && is_int($memberUserId)) {
            $queryBuilder->join(MemberUser::class, 'mu');
            $queryBuilder->where('mu.id = :member_user_id');
            $queryBuilder->setParameter('member_user_id', $memberUserId);
        }

        if ($currentOnly) {
            $queryBuilder->andWhere('br.returnDate IS NULL');
//            $queryBuilder->andWhere('br.endDate < :date');
//            $queryBuilder->setParameter('date', $date);
        }

        if ($late) {
            $queryBuilder->andWhere('br.returnDate IS NULL');
        }

        return $queryBuilder;
    }

    /**
     * @param bool $libraryId
     * @param bool $memberUserId
     * @param bool $currentOnly
     * @param bool $late
     * @param null $date
     *
     * @return BookRent[]
     */
    public function findBooking($libraryId = false, $memberUserId = false, $currentOnly = false, $late = false, $date = null): array
    {
        $queryBuilder = $this->queryBooking($libraryId, $memberUserId, $currentOnly, $late, $date);

        $query = $queryBuilder->getQuery();

        return $query->getResult();
    }

    /**
     * @param bool $libraryId
     * @param bool $memberId
     * @param bool $currentOnly
     * @param bool $late
     * @param null $date
     *
     * @return int
     */
    public function countBooking($libraryId = false, $memberId = false, $currentOnly = false, $late = false, $date = null): int
    {
        $queryBuilder = $this->queryBooking($libraryId, $memberId, $currentOnly, $late, $date);
        $queryBuilder = $queryBuilder->select('COUNT(br)');
        $query = $queryBuilder->getQuery();

        try {
            return $query->getSingleScalarResult();
        } catch (NonUniqueResultException $e) {
            return 0;
        }
    }

    public function findLateByLibrary($libraryId)
    {
        return $this->createQueryBuilder('br')
            ->join(Book::class, 'b')
            ->join(Library::class, 'l')

            ->where('br.endDate < CURRENT_DATE()')
            ->andWhere('br.returnDate IS NULL')
            ->andWhere('l.id = :library_id')
            ->setParameter('library_id', $libraryId)

            ->getQuery()
            ->getResult();
    }

    public function countLateByLibrary($libraryId)
    {
        try {
            return $this->createQueryBuilder('br')
                ->select('COUNT(br)')
                ->join(Book::class, 'b')
                ->join(Library::class, 'l')

                ->where('br.endDate < CURRENT_DATE()')
                ->andWhere('br.returnDate IS NULL')
                ->andWhere('l.id = :library_id')
                ->setParameter('library_id', $libraryId)

                ->getQuery()
                ->getSingleScalarResult();
        } catch (NonUniqueResultException $e) {
            return 0;
        }
    }

    /**
     * @param $libraryId
     *
     * @return int
     *
     */
    public function countByLibrary($libraryId): int
    {
        try {
            return $this->createQueryBuilder('br')
                ->select('COUNT(br)')
                ->join(Book::class, 'b')

                ->join(Library::class, 'library')
                ->where('b.id = :library_id')

                ->setParameter('library_id', $libraryId)

                ->getQuery()
                ->getSingleScalarResult();
        } catch (NonUniqueResultException $e) {
            return 0;
        }
    }

    public function truncate()
    {
        $connection = $this->getEntityManager()->getConnection();
        try {
            $platform = $connection->getDatabasePlatform();
            try {
                $connection->executeUpdate($platform->getTruncateTableSQL('book_rent', true));
            } catch (DBALException $e) {
            }
        } catch (DBALException $e) {
        }

    }

    /**
     * @param $value
     *
     * @return mixed
     */
    public function findValueOfBookingForOneMember($value)
    {
        try {
            $count = $this->createQueryBuilder('br')
                ->select('COUNT(br)')
                ->where('br.member = :member_id')
                ->setParameter('member_id', $value)
                ->andWhere('br.endDate > CURRENT_DATE()')
                ->getQuery()
                ->getSingleScalarResult();
        } catch (NonUniqueResultException $e) {
            return 0;
        }

        return $count;
    }

    /**
     * Find top bookings
     *
     * @param $topNumber
     *
     * @return array
     *
     */
    public function findTop($topNumber): array
    {
        $query = $this->createQueryBuilder('br')
            ->join(Book::class, 'b')
            ->join(BookModel::class, 'bm')
            ->join(ImageFile::class, 'im')
            ->addSelect('COUNT(bm.id)')
            ->addSelect('if')
            ->groupBy('bm.id')
            ->orderBy('COUNT(bm.id)')
            ->setMaxResults($topNumber);
        ;

        return $query
            ->getQuery()
            ->getArrayResult();

    }
}
