<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AboutusController extends AbstractController
{
    /**
     * @Route("/aboutus", name="aboutus")
     */
    public function index()
    {
        return $this->render('aboutus/index.html.twig', [
            'controller_name' => 'AboutusController',
        ]);
    }
}
