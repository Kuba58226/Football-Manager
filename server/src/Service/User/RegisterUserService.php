<?php

namespace App\Service\User;

use App\Entity\User;
use App\Form\Dto\User\UserRegisterTypeDto;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegisterUserService
{
    /**
     * @var EntityManagerInterface $entityManager
     */
    private $entityManager;

    /**
     * @var UserPasswordHasherInterface $userPasswordHasher
     */
    private $userPasswordHasher;

    public function __construct(
        EntityManagerInterface $entityManager,
        UserPasswordHasherInterface $userPasswordHasher
    ) {
        $this->entityManager = $entityManager;
        $this->userPasswordHasher = $userPasswordHasher;
    }

    public function __invoke(UserRegisterTypeDto $userRegisterTypeDto)
    {
        $user = new User();
        $user->setEmail($userRegisterTypeDto->getEmail());
        $user->setPassword($this->userPasswordHasher->hashPassword($user, $userRegisterTypeDto->getPassword()));
        $user->setRoles(["ROLE_USER"]);

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}