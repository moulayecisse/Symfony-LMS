<?php
/**
 * Created by PhpStorm.
 * User: moula
 * Date: 18/08/2018
 * Time: 18:27.
 */

namespace App\Controller\API;

use App\Repository\MemberUserTestimonialRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MemberUserTestimonialController.
 *
 * @Route("/api/testimonials")
 */
class MemberUserTestimonialController
{
    /**
     * @Route(
     *     "/count",
     *     name="api_testimonial_count",
     *     defaults={
     *          "#_api_resource_class"=MemberUserTestimonial::class,
     *          "_api_item_operation_name"="count",
     *          "_api_receive"=false
     *      }
     * )
     *
     * @param MemberUserTestimonialRepository $testimonialRepository
     *
     * @return JsonResponse
     */
    public function count(MemberUserTestimonialRepository $testimonialRepository)
    {
        $testimonialsCount = $testimonialRepository->count([]);

        return new JsonResponse(['testimonialsCount' => $testimonialsCount]);
    }
}
