<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/app/cv')]
class CVController extends AbstractController
{
    #[Route('/', name: 'app_cv_home')]
    public function index(): Response
    {
        return $this->render('cv/index.html.twig', [
            'title' => 'Mes CVs',
        ]);
    }

    #[Route('/new', name: 'app_cv_new')]
    public function new(): Response
    {
        return $this->render('cv/new.html.twig', [
            'title' => 'Nouveau CV',
        ]);
    }

    #[Route('/create', name: 'app_cv_create')]
    public function create(): Response
    {
        return $this->render('cv/new.html.twig', [
            'title' => 'Nouveau CV',
        ]);
    }
}
