<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class MonEspaceController extends AbstractController
{
    /**
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     * @Route("/mon/espace", name="mon_espace")
     * @param UserRepository $userRepository
     * @return Response
     */
    public function index( UserRepository $userRepository)
    {
        return $this->render('mon_espace/index.html.twig');
    }
}

