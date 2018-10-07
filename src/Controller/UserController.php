<?php
/**
 * Created by PhpStorm.
 * User: moulaye
 * Date: 24/07/18
 * Time: 11:22.
 */

namespace App\Controller;

use App\Entity\User\User;
use App\Form\UserLoginType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Class UserController.
 *
 *
 * @Route( path="/" )
 * Route( path="/user" )
 */
class UserController extends Controller
{
    /**
     * @Route("/", name="user_index", methods="GET")
     *
     * @param UserRepository $userRepository
     *
     * @return Response
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', ['users' => $userRepository->findAll()]);
    }

//    /**
//     * @Route("/new", name="user_new", methods="GET|POST")
//     * @param Request $request
//     *
//     * @return Response
//     */
//    public function new(Request $request): Response
//    {
//        $user = new User();
//        $form = $this->createForm(UserType::class, $user);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($user);
//            $em->flush();
//
//            return $this->redirectToRoute('user_index');
//        }
//
//        return $this->render('user/new.html.twig', [
//            'user' => $user,
//            'form' => $form->createView(),
//        ]);
//    }
//
//    /**
//     * @Route("/{id}", name="user_show", methods="GET")
//     * @param User $user
//     *
//     * @return Response
//     */
//    public function show(User $user): Response
//    {
//        return $this->render('user/show.html.twig', ['user' => $user]);
//    }
//
//    /**
//     * @Route("/{id}/edit", name="user_edit", methods="GET|POST")
//     * @param Request $request
//     * @param User    $user
//     *
//     * @return Response
//     */
//    public function edit(Request $request, User $user): Response
//    {
//        $form = $this->createForm(UserType::class, $user);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $this->getDoctrine()->getManager()->flush();
//
//            return $this->redirectToRoute('user_edit', ['id' => $user->getId()]);
//        }
//
//        return $this->render('user/edit.html.twig', [
//            'user' => $user,
//            'form' => $form->createView(),
//        ]);
//    }
//
//    /**
//     * @Route("/{id}", name="user_delete", methods="DELETE")
//     * @param Request $request
//     * @param User    $user
//     *
//     * @return Response
//     */
//    public function delete(Request $request, User $user): Response
//    {
//        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
//            $em = $this->getDoctrine()->getManager();
//            $em->remove($user);
//            $em->flush();
//        }
//
//        return $this->redirectToRoute('user_index');
//    }

    /**
     * connection.
     *
     * Route(
     *     {
     *          "fr": "/connexion",
     *          "en": "/login"
     *      },
     *     name="user_login"
     * )
     *
     * @Route( path="/login", name="user_login" )
     *
     * @param Request             $request
     * @param AuthenticationUtils $authenticationUtils
     *
     * @return Response
     */
    public function login(Request $request, AuthenticationUtils $authenticationUtils)
    {
        /*
         * If user is login and is granted permissions go to home page
         *
         * @Todo add home controller
         * @Todo add permission check
         */
        if ($this->getUser()) {
            return $this->redirectToRoute('home_index');
        }

        /**
         * Retrieve user login form.
         */
        $form = $this->createForm(UserLoginType::class, ['email' => $authenticationUtils->getLastUsername()]);

        /**
         * Get error message.
         */
        $error = $authenticationUtils->getLastAuthenticationError();

        return $this->render(
            'user/login.html.twig',
            [
                'login_form' => $form->createView(),
                'login_error' => $error,
            ]
        );
    }

    /**
     * @Route("/api/user/login", name="api_user_login", defaults={
     *   "#_api_resource_class"=Card::class,
     *   "_api_item_operation_name"="generate",
     *   "_api_receive"=false
     * })
     */
    public function api_login(Request $request)
    {
        dd($request);

        $user = ['user' => $this->getUser()->getUsername()];

        $card = new Card();
        $card->setCode(rand(12, 148));

        $this->getDoctrine()->getManager()->persist($card);
        $this->getDoctrine()->getManager()->flush();

        $responseCard = [
            'id' => $card->getId(),
            'code' => $card->getCode(),
        ];

        return new JsonResponse($responseCard);
    }
}
