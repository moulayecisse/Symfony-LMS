<?php

namespace App\Repository;

use App\Entity\Book\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Book::class);
    }


    /**
     * @param $libraryId
     *
     * @return int
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function countLibraryPbook($libraryId) : int
    {
        try {
            return $this->createQueryBuilder('pbook')
                ->select('COUNT(pbook)')
                ->join(Book::class, 'pbook')
                ->join(Library::class, 'library')

                ->andWhere('library.id = :library_id')
                ->setParameter('library_id', $libraryId)

                ->getQuery()
                ->getSingleScalarResult();
        } catch (NonUniqueResultException $e) {
            return 0;
        }
    }

    public function findMostRentedByLibrary($libraryId, $limit = 10, $offset = 0)
    {
        return $this->findBy([ 'library' => $libraryId ], ['id' => 'ASC'], $limit, $offset);
    }
}
