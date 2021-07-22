<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    #[Route('/index', name: 'index')]
    public function index(): Response
    {
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }


    #[Route('/detail', name: 'detail_produit')]
    public function detail(): Response
    {
        return $this->render('index/detail.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }
}
