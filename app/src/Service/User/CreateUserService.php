<?php

namespace App\Service\User;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;

class CreateUserService
{
    public function __construct(
        private EntityManagerInterface $manager,
        private UserPasswordHasherInterface $passwordHasher
    )
    {}

    public function __invoke(string $email, string $password) : User
    {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            throw new \Exception('Invalid email adress');
        }

        $user = (new User())
            ->setEmail($email);

        $password = $this->passwordHasher->hashPassword($user, 'pass_1234');
        $user->setPassword($password);

        $this->manager->persist($user);
        $this->manager->flush();

        return $user;
    }
}