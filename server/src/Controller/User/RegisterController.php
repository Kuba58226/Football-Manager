<?php

namespace App\Controller\User;

use App\Form\Dto\User\UserRegisterTypeDto;
use App\Form\Type\User\UserRegisterType;
use App\Repository\UserRepository;
use App\Service\User\RegisterUserService;
use App\Shared\Controller\AppController;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RegisterController extends AppController
{
    /**
     * @var RegisterUserService $registerUserService
     */
    private $registerUserService;

    /**
     * @var UserRepository $userRepository
     */
    private $userRepository;

    public function __construct(
        RegisterUserService $registerUserService,
        UserRepository $userRepository
    ) {
        $this->registerUserService = $registerUserService;
        $this->userRepository = $userRepository;
    }

    public function register(Request $request)
    {
        $form = $this->createForm(UserRegisterType::class);
        $form->handleRequest($request);

        /** @var UserRegisterTypeDto $userRegisterTypeDto */
        $userRegisterTypeDto = $form->getData();

        if ($form->isSubmitted() && $form->isValid()) {
            $existingUser = $this->userRepository->findOneByEmail($userRegisterTypeDto->getEmail());

            if ($existingUser) {
                throw new Exception('User already exists');
            }

            ($this->registerUserService)($userRegisterTypeDto);

            return $this->jsonResponse(
                'User succesfully registered',
                null,
                Response::HTTP_OK
            );
        }

        return $this->jsonResponse(
            'User registration failed',
            null,
            Response::HTTP_BAD_REQUEST
        );
    }
}