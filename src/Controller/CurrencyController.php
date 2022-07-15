<?php

namespace App\Controller;

use App\Entity\Currency;
use App\Form\CurrencyType;
use App\Repository\CurrencyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class CurrencyController extends AbstractController
{
    /**
     * @Route("", name="app_currency_index", methods={"GET"})
     */
    public function index(CurrencyRepository $currencyRepository): Response
    {
        return $this->render('currency/index.html.twig', [
            'currencies' => $currencyRepository->findAll(),
        ]);
    }

    /**
     * @Route("currency/new", name="app_currency_new", methods={"GET", "POST"})
     */
    public function new(Request $request, CurrencyRepository $currencyRepository): Response
    {
        $currency = new Currency();
        $form = $this->createForm(CurrencyType::class, $currency);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $currencyRepository->add($currency, true);

            return $this->redirectToRoute('app_currency_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('currency/new.html.twig', [
            'currency' => $currency,
            'form' => $form,
        ]);
    }

    /**
     * @Route("currency/{id}", name="app_currency_show", methods={"GET"})
     */
    public function show(Currency $currency): Response
    {
        return $this->render('currency/show.html.twig', [
            'currency' => $currency,
        ]);
    }

    /**
     * @Route("currency/{id}/edit", name="app_currency_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Currency $currency, CurrencyRepository $currencyRepository): Response
    {
        $form = $this->createForm(CurrencyType::class, $currency);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $currencyRepository->add($currency, true);

            return $this->redirectToRoute('app_currency_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('currency/edit.html.twig', [
            'currency' => $currency,
            'form' => $form,
        ]);
    }

    /**
     * @Route("currency/{id}", name="app_currency_delete", methods={"POST"})
     */
    public function delete(Request $request, Currency $currency, CurrencyRepository $currencyRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$currency->getId(), $request->request->get('_token'))) {
            $currencyRepository->remove($currency, true);
        }

        return $this->redirectToRoute('app_currency_index', [], Response::HTTP_SEE_OTHER);
    }
}
