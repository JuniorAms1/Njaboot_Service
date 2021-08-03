<?php

namespace App\Controller;

use App\Repository\ProduitsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use  Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    #[Route('/panier', name: 'panier')]
    public function index(SessionInterface $session, ProduitsRepository $produitsRepository)
    {
        $panier = $session->get('panier', []);
        $panierWithData = [];
            foreach($panier as $id => $quantity){
                $panierWithData[]=[
                    'produit' => $produitsRepository->find($id),
                    'quantity' => $quantity
                ];
            }

            $total=0;
            $totalLivraison=0;
            foreach($panierWithData as $item){
                $totalItem = $item['produit']->getPrixHt() * $item['quantity'];
                $total +=$totalItem;
                
                $totalLivraison = $item['produit']->getPrixTTC() + $total;
            
            }
              
        return $this->render('panier/panier.html.twig', [
            'items' => $panierWithData,
            'total' => $total,
            'totalLivraison' => $totalLivraison
        ]);
    }

    #[Route('/panier/add/{id}', name: 'panier_add')]
    public function add($id, SessionInterface $session)
    {
       
       $panier = $session->get('panier', []);
            if (!empty($panier[$id])) {
                $panier[$id]++;

            } else {
                $panier[$id] = 1;
            }
  
       $session->set('panier', $panier);

            return $this->redirectToRoute("panier");
    }

    #[Route('/panier/remove/{id}', name: 'panier_remove')]
    public function remove($id, SessionInterface $session)
    {
       
       $panier = $session->get('panier', []);
            if (!empty($panier[$id])) {
                unset($panier[$id]);

            } 
  
       $session->set('panier', $panier);
       
       return $this->redirectToRoute("panier");


    }
}
