<?php

namespace App\Repository;

use App\Entity\BookModel;
use App\Entity\BookRent;
use App\Entity\ImageFile;
use App\Entity\Library;
use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method BookModel|null find($id, $lockMode = null, $lockVersion = null)
 * @method BookModel|null findOneBy(array $criteria, array $orderBy = null)
 * @method BookModel[]    findAll()
 * @method BookModel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookModelRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, BookModel::class);
    }

    /**
     * @param $libraryId
     *
     * @return array
     */
    public function findByLibrary($libraryId): array
    {
        return $this->createQueryBuilder('bm')
            ->join(Book::class, 'b')
            ->where('b.book_model_id = bm.id')
            ->distinct('b.book_id')

            ->join(Library::class, 'l')
            ->where('l.id = :library_id')
            ->setParameter('library_id', $libraryId)

            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @param int $limit
     *
     * @return array
     */
    public function findBestSellers($limit = 10): array
    {
        return $this->createQueryBuilder('bm')
            //->join(EBook::class, 'eb')
            //->where('eb.book_model_id = b.id')
            //->groupBy('eb.book_model_id')
            //->orderBy('eb.book_model_id')

            ->setMaxResults($limit)

            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @param $libraryId
     *
     * @return int
     */
    public function countByLibrary($libraryId)
    {
        $count = 0;

        try {
            $query = $this->createQueryBuilder('bm')
                ->select('Count( bm )')
                ->distinct('bm')
                ->join(Book::class, 'b', 'WITH', 'b.library_id = :library.id')
                ->setParameter('library_id', $libraryId)
                ->addSelect('b')
//                ->where( 'b = bm.id' )
//                ->andWhere( 'b.library_id = :library_id' )

                ->getQuery()
//                ->getSingleScalarResult()
                ;

//            dd( $query );

//            $count = $query;

            $count = 0;
        } catch (NonUniqueResultException $e) {
            $count = 0;
        }

        return $count;
    }

    public function findTop($topNumber): array
    {
        $myQuery = $this->createQueryBuilder('bm')
            ->join(Book::class, 'b')
            ->join(BookRent::class, 'br')
            ->join(ImageFile::class, 'if')
            ->addSelect('COUNT(bm.id)')
            ->addSelect('if')
            ->groupBy('bm.id')
            ->orderBy('COUNT(bm.id)')
            ->setMaxResults($topNumber);

        return $myQuery
            ->getQuery()
            ->getArrayResult();
    }

    /**
     * Compte le nombre de livres dans la BDD.
     *
     * @return int|mixed
     */
    public function findTotalBooks()
    {
        try {
            return $this->createQueryBuilder('bm')
                ->select('COUNT(bm)')
                ->getQuery()
                ->getSingleScalarResult();
        } catch (NonUniqueResultException $e) {
        }
    }
}
