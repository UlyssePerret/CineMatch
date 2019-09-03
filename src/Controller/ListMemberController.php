<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListMemberController extends AbstractController
{
    /**
     * @Route("/list/member", name="list_member")
     * @param UserRepository $userRepository
     * @return Response
     */
    public function index( UserRepository $userRepository)
    {
        // SELECT * FORM user
        $users = $userRepository->findAll();

        return $this->render('list_member/index.html.twig', [
            'users' => $users
        ]);
    }
}
