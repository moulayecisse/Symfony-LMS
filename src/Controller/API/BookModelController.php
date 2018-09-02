<?php
/**
 * Created by PhpStorm.
 * User: moula
 * Date: 18/08/2018
 * Time: 18:27.
 */

namespace App\Controller\API;

use App\Entity\Book;
use App\Repository\BookModelRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class BookModelController.
 *
 * @Route("/api/books")
 */
class BookModelController
{
    private $bookRepository;

    /**
     * Count action.
     *
     * @Route(
     *     name="api_book_count",
     *     path="/count",
     *     methods={"GET"},
     *     defaults={
     *         "_api_item_operation_name"="count"
     *     }
     * )
     *
     * @param BookModelRepository $bookRepository
     *
     * @return JsonResponse
     */
    public function count(BookModelRepository $bookRepository)
    {
        $booksCount = $bookRepository->count([]);

        return new JsonResponse(['booksCount' => $booksCount]);
    }

    public function __construct(BookModelRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    /**
     * @Route(
     *     name="api_book_best_sellers",
     *     path="/best-sellers",
     *     methods={"GET"},
     *     defaults={
     *         "_api_resource_class"=Book::class,
     *         "_api_collection_operation_name"="best_sellers"
     *     }
     * )
     *
     * @return array
     */
    public function bestSellers()
    {
        return $this->bookRepository->findBestSellers(5);
    }

    /**
     * @Route(
     *     name="api_book_new_releases",
     *     path="/new-releases",
     *     methods={"GET"},
     *     defaults={
     *         "_api_resource_class"=Book::class,
     *         "_api_collection_operation_name"="new_releases"
     *     }
     * )
     *
     * @return array
     */
    public function newReleases()
    {
        return $this->bookRepository->findBestSellers(3);
    }

    /**
     * @Route(
     *     name="api_book_featured",
     *     path="/featured",
     *     methods={"GET"},
     *     defaults={
     *         "_api_item_operation_name"="featured"
     *     }
     * )
     *
     * @return JsonResponse
     */
    public function featured()
    {
        $book = $this->bookRepository->findOneBy([]);

        return new JsonResponse(
            [
                'book' => [
                    'title' => $book->getTitle(),
                    'image' => $book->getImage()->getPath(),
                    'isbn' => $book->getIsbn(),
                    'subCategory' => $book->getBookCategory()->getName(),
                    'author' => $book->getAuthor()->getFirstName().' '.$book->getAuthor()->getLastName(),
                    'resume' => $book->getResume(),
//                    'pbooks' => $book->getPBooks(),
                    'pageNumber' => $book->getPageNumber(),
                    'slug' => $book->getSlug(),
                ],
            ]
        );
    }

    /**
     * @Route(
     *     name="api_book_picked_by_author",
     *     path="/picked-by-author",
     *     methods={"GET"},
     *     defaults={
     *         "_api_resource_class"=Book::class,
     *         "_api_collection_operation_name"="picked_by_author"
     *     }
     * )
     *
     * @return array
     */
    public function pickedByAuthor()
    {
        return $this->bookRepository->findBestSellers(5);
    }
}
