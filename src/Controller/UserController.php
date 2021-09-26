<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/user', name: 'user')]
    public function index(): Response
    {
        return $this->render('user/connect.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    #[Route('/inscription', name: 'user_register')]
    public function inscrire(): Response
    {
        return $this->render('user/register.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
}
