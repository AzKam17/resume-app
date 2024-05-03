<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('app/index.html.twig', [
            'title' => 'HomeController',
        ]);
    }

    #[Route('/public', name: 'app_public')]
    public function public(): Response
    {
        return $this->render('public/index.html.twig', [
            'title' => 'HomeController',
        ]);
    }
}
