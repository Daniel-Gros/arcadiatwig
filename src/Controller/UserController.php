<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\User;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]

    public function registration(UserPasswordHasherInterface $passwordHasher, User $user): Response
    {
        $user = new User();
        $plaintextPassword = 'your_plaintext_password';

        // hash the password (based on the security.yaml config for the $user class)
        $hashedPassword = $passwordHasher->hashPassword(
            $user,
            $plaintextPassword
        );
        $user->setPassword($hashedPassword);

        // ...
        return new Response('User registered successfully');
    }
    public function delete(UserPasswordHasherInterface $passwordHasher, PasswordAuthenticatedUserInterface $user): void
    {
        // ... e.g. get the password from a "confirm deletion" dialog
        $plaintextPassword = 'your_plaintext_password';

        if (!$passwordHasher->isPasswordValid($user, $plaintextPassword)) {
            throw new AccessDeniedHttpException();
        }
    }


    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
}
