<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Entity\Library;
use App\Service\Book\BookProvider;
use DateInterval;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class HomeController extends Controller
{
    /**
     * @Route("/", name="home", methods="GET")
     *
     * @return Response
     *
     * @throws \Exception
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig', []);
    }
}
