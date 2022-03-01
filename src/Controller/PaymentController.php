<?php

namespace App\Controller;

use Stripe\Stripe;
use App\Classes\Panier;
use Stripe\Checkout\Session;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PaymentController extends AbstractController
{
    /**
     * @Route("/checkout", name="checkout")
     */
    
    public function checkout($stripeSK, Panier $panier): Response
    {
        Stripe::setApiKey($stripeSK);

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => 'Ma commande',
                    ],
                'unit_amount' => $panier->getTotalePanier() * 100,
                ],
                'quantity' => $panier->getNombreArticlePanier(),
            ]],
            'mode' => 'payment',
            'success_url' => $this->generateUrl('sucess_url', [], UrlGeneratorInterface::ABSOLUTE_URL),

            'cancel_url' => $this->generateUrl('cancel_url', [], UrlGeneratorInterface::ABSOLUTE_URL),
        ]);

        return $this->redirect($session->url, 303);
    }

    /**
     * @Route("/sucess_url", name="sucess_url")
     */
    public function sucessUrl(): Response
    {
        return $this->render('payment/sucess.html.twig', []);
    }

    /**
     * @Route("/cancel_url", name="cancel_url")
     */
    public function cancelUrl(): Response
    {
        return $this->render('payment/cancel.html.twig', []);
    }
}
