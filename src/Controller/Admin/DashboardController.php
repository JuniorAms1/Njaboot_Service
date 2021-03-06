<?php

namespace App\Controller\Admin;

use App\Entity\Categories;
use App\Entity\Produits;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Back-Office Njaboot Service');
    }

    public function configureMenuItems(): iterable
    {
      
        yield MenuItem::linktoRoute('Page d\'accueil du site', 'fas fa-home', 'index');
        yield MenuItem::linkToCrud('Gestion des Catégories', 'fas fa-list', Categories::class);
       }
}
