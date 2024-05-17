<?php

namespace App\Service\User;

use App\Entity\User;
use App\Repository\UserRepository;

class CheckIfUserExistsService
{
    public function __construct(
        private UserRepository $repository
    )
    {}

    public function __invoke(string $email) : ?User
    {
        return $this->repository->findOneBy(['email' => $email]);
    }
}