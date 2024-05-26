<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]
class AdminController extends AbstractController
{
    #[Route('/app/admin/jobs', name: 'app_admin_jobs')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'title' => 'Jobs Admin',
        ]);
    }
}
