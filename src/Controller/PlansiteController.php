<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PlansiteController extends AbstractController
{
    /**
     * @Route("/plansite", name="plansite")
     */
    public function index()
    {
        return $this->render('plansite/index.html.twig', [
            'controller_name' => 'PlansiteController',
        ]);
    }
}
