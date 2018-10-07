<?php

namespace App\Controller;

use App\Entity\Book\BookRent;
use App\Entity\Library\Library;
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
     * @Route("/", name="home_index", methods="GET")
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
