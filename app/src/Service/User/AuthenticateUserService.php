<?php

namespace App\Service\User;

use App\Entity\User;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class AuthenticateUserService
{
    public function __construct(
        private Security $security,
        private UrlGeneratorInterface $urlGenerator
    )
    {
    }

    public function __invoke(User $user)
    {
        $this->security->login($user);
        return new RedirectResponse($this->urlGenerator->generate('app_home'));
    }
}