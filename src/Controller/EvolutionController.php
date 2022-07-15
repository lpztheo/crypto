<?php

namespace App\Controller;

use App\Entity\Evolution;
use App\Form\EvolutionType;
use App\Repository\EvolutionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/evolution")
 */
class EvolutionController extends AbstractController
{
    /**
     * @Route("/", name="app_evolution_index", methods={"GET"})
     */
    public function index(EvolutionRepository $evolutionRepository): Response
    {
        return $this->render('evolution/index.html.twig', [
            'evolutions' => $evolutionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_evolution_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EvolutionRepository $evolutionRepository): Response
    {
        $evolution = new Evolution();
        $form = $this->createForm(EvolutionType::class, $evolution);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $evolutionRepository->add($evolution, true);

            return $this->redirectToRoute('app_evolution_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('evolution/new.html.twig', [
            'evolution' => $evolution,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_evolution_show", methods={"GET"})
     */
    public function show(Evolution $evolution): Response
    {
        return $this->render('evolution/show.html.twig', [
            'evolution' => $evolution,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_evolution_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Evolution $evolution, EvolutionRepository $evolutionRepository): Response
    {
        $form = $this->createForm(EvolutionType::class, $evolution);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $evolutionRepository->add($evolution, true);

            return $this->redirectToRoute('app_evolution_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('evolution/edit.html.twig', [
            'evolution' => $evolution,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_evolution_delete", methods={"POST"})
     */
    public function delete(Request $request, Evolution $evolution, EvolutionRepository $evolutionRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$evolution->getId(), $request->request->get('_token'))) {
            $evolutionRepository->remove($evolution, true);
        }

        return $this->redirectToRoute('app_evolution_index', [], Response::HTTP_SEE_OTHER);
    }
}
