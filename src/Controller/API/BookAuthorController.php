<?php
/**
 * Created by PhpStorm.
 * User: moula
 * Date: 18/08/2018
 * Time: 18:27.
 */

namespace App\Controller\API;

use App\Entity\Author;
use App\Repository\BookAuthorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class BookAuthorController.
 *
 * @Route("/api/book_authors")
 */
class BookAuthorController
{
    private $bookAuthorRepository;

    public function __construct(BookAuthorRepository $bookAuthorRepository)
    {
        $this->bookAuthorRepository = $bookAuthorRepository;
    }

    /**
     * @Route(
     *     "/count",
     *     name="api_book_author_count",
     *     defaults={
     *          "#_api_resource_class"=BookAuthor::class,
     *          "_api_item_operation_name"="count",
     *          "_api_receive"=false
     *      }
     * )
     *
     * @return JsonResponse
     */
    public function count()
    {
        $authorsCount = $this->bookAuthorRepository->count([]);

        return new JsonResponse(['authorsCount' => $authorsCount]);
    }

    /**
     * @Route(
     *     name="api_book_author_most_populars",
     *     path="/most_populars",
     *     methods={"GET"},
     *     defaults={
     *         "_api_resource_class"=BookAuthor::class,
     *         "_api_collection_operation_name"="most_populars"
     *     }
     * )
     *
     * @return array
     */
    public function mostPopulars()
    {
        return $this->bookAuthorRepository->findBy([], [], 10);
    }

    /**
     * @Route(
     *     name="api_book_author_best_selling",
     *     path="/best_selling",
     *     methods={"GET"},
     *     defaults={
     *         "_api_resource_class"=BookAuthor::class,
     *         "_api_collection_operation_name"="best_selling"
     *     }
     * )
     *
     * @return array
     */
    public function bestSelling()
    {
        return $this->bookAuthorRepository->findBy([], [], 10);
    }
}
