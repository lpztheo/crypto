<?php

namespace App\Controller;

use App\Entity\Owned;
use App\Form\OwnedType;
use App\Repository\OwnedRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/owned")
 */
class OwnedController extends AbstractController
{
    /**
     * @Route("/", name="app_owned_index", methods={"GET"})
     */
    public function index(OwnedRepository $ownedRepository): Response
    {
        return $this->render('owned/index.html.twig', [
            'owneds' => $ownedRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_owned_new", methods={"GET", "POST"})
     */
    public function new(Request $request, OwnedRepository $ownedRepository): Response
    {
        $owned = new Owned();
        $form = $this->createForm(OwnedType::class, $owned);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ownedRepository->add($owned, true);

            return $this->redirectToRoute('app_owned_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('owned/new.html.twig', [
            'owned' => $owned,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_owned_show", methods={"GET"})
     */
    public function show(Owned $owned): Response
    {
        return $this->render('owned/show.html.twig', [
            'owned' => $owned,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_owned_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Owned $owned, OwnedRepository $ownedRepository): Response
    {
        $form = $this->createForm(OwnedType::class, $owned);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ownedRepository->add($owned, true);

            return $this->redirectToRoute('app_owned_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('owned/edit.html.twig', [
            'owned' => $owned,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_owned_delete", methods={"POST"})
     */
    public function delete(Request $request, Owned $owned, OwnedRepository $ownedRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$owned->getId(), $request->request->get('_token'))) {
            $ownedRepository->remove($owned, true);
        }

        return $this->redirectToRoute('app_owned_index', [], Response::HTTP_SEE_OTHER);
    }
}
