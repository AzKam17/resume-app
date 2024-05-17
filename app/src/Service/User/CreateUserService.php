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

    public function __invoke(string $email, string $password) : ?User
    {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            throw new \Exception('Invalid email adress');
            return null;
        }

        $user = (new User())
            ->setSocialId("none")
            ->setEmail($email)
            ->setAuthMethod('form_login')
        ;

        $hashedPassword = $this->passwordHasher->hashPassword($user, $password);
        $user->setPassword($hashedPassword);

        $this->manager->persist($user);
        $this->manager->flush();

        return $user;
    }
}