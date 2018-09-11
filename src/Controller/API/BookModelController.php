<?php
/**
 * Created by PhpStorm.
 * User: moula
 * Date: 18/08/2018
 * Time: 18:27.
 */

namespace App\Controller\API;

use App\Entity\BookModel;
use App\Repository\BookModelRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class BookModelController.
 *
 * @Route("/api/book_models")
 */
class BookModelController
{
    private $bookModelRepository;

    /**
     * Count action.
     *
     * @Route(
     *     name="api_book_model_count",
     *     path="/count",
     *     methods={"GET"},
     *     defaults={
     *         "_api_item_operation_name"="count"
     *     }
     * )
     *
     * @param BookModelRepository $bookModelRepository
     *
     * @return JsonResponse
     */
    public function count(BookModelRepository $bookModelRepository)
    {
        $bookModelsCount = $bookModelRepository->count([]);

        return new JsonResponse(['bookModelsCount' => $bookModelsCount]);
    }

    public function __construct(BookModelRepository $bookModelRepository)
    {
        $this->bookModelRepository = $bookModelRepository;
    }

    /**
     * @Route(
     *     name="api_book_model_best_sellers",
     *     path="/best_sellers",
     *     methods={"GET"},
     *     defaults={
     *         "_api_resource_class"=BookModel::class,
     *         "_api_collection_operation_name"="best_sellers"
     *     }
     * )
     *
     * @return array
     */
    public function bestSellers()
    {
        return $this->bookModelRepository->findBestSellers(5);
    }

    /**
     * @Route(
     *     name="api_book_model_new_releases",
     *     path="/new_releases",
     *     methods={"GET"},
     *     defaults={
     *         "_api_resource_class"=BookModel::class,
     *         "_api_collection_operation_name"="new_releases"
     *     }
     * )
     *
     * @return array
     */
    public function newReleases()
    {
        return $this->bookModelRepository->findBestSellers(3);
    }

    /**
     * @Route(
     *     name="api_book_model_featured",
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
        $bookModel = $this->bookModelRepository->findOneBy([]);

        return new JsonResponse(
            [
                'bookModel' => [
                    'title' => $bookModel->getTitle(),
                    'image' => $bookModel->getImage()->getPath(),
                    'isbn' => $bookModel->getIsbn(),
                    'subCategory' => $bookModel->getBookModelCategory()->getName(),
                    'author' => $bookModel->getAuthor()->getFirstName().' '.$bookModel->getAuthor()->getLastName(),
                    'resume' => $bookModel->getResume(),
//                    'pbookModels' => $bookModel->getPBookModels(),
                    'pageNumber' => $bookModel->getPageNumber(),
                    'slug' => $bookModel->getSlug(),
                ],
            ]
        );
    }

    /**
     * @Route(
     *     name="api_book_model_picked_by_author",
     *     path="/picked_by_author",
     *     methods={"GET"},
     *     defaults={
     *         "_api_resource_class"=BookModel::class,
     *         "_api_collection_operation_name"="picked_by_author"
     *     }
     * )
     *
     * @return array
     */
    public function pickedByAuthor()
    {
        return $this->bookModelRepository->findBestSellers(5);
    }
}
