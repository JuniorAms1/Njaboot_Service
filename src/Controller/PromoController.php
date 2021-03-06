<?php

namespace App\Controller;

use App\Entity\Produits;
use App\Entity\Promo;
use App\Form\PromoType;
use App\Repository\PromoRepository;
use App\Repository\ProduitsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/promo')]
class PromoController extends AbstractController
{
    #[Route('/', name: 'promo_index', methods: ['GET'])]
    public function index(PromoRepository $promoRepository): Response
    {
        return $this->render('promo/index.html.twig', [
            'promos' => $promoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'promo_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $promo = new Promo();
        $form = $this->createForm(PromoType::class, $promo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($promo);
            $entityManager->flush();

            return $this->redirectToRoute('promo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('promo/new.html.twig', [
            'promo' => $promo,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'promo_show', methods: ['GET'])]
    public function show(Promo $promo): Response
    {
        return $this->render('promo/show.html.twig', [
            'promo' => $promo,
        ]);
    }

    #[Route('/{id}/edit', name: 'promo_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Promo $promo): Response
    {
        $form = $this->createForm(PromoType::class, $promo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('promo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('promo/edit.html.twig', [
            'promo' => $promo,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'promo_delete', methods: ['POST'])]
    public function delete(Request $request, Promo $promo): Response
    {
        if ($this->isCsrfTokenValid('delete'.$promo->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($promo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('promo_index', [], Response::HTTP_SEE_OTHER);
    }
}
