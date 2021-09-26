<?php

namespace App\Controller;

use App\Controller\Admin\CategoriesCrudController;
use App\Entity\Produits;
use App\Form\ProduitsType;
use App\Repository\ProduitsRepository;
use App\Repository\CategoriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
   
   #[Route('/index', name: 'index')]
    public function index(ProduitsRepository $produitsRepository, CategoriesRepository $categoriesRepository): Response
    {
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
            'produits' => $produitsRepository->findAll(),
            'categories' => $categoriesRepository->findAll()
        ]);
    }


    #[Route('/packs', name: 'pack_njaboot')]
    public function detail(CategoriesRepository $categoriesRepository): Response
    {
        return $this->render('index/pack.html.twig', [
            'controller_name' => 'IndexController',
            'categories' => $categoriesRepository->findAll()
        ]);
    }
}
