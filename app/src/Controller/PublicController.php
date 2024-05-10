<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PublicController extends AbstractController
{
    #[Route('/', name: 'app_public')]
    public function public(): Response
    {
        return $this->render('public/index.html.twig', [
            'title' => 'HomeController',
        ]);
    }
}
