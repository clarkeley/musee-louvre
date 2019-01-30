<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/panier", name = "basket")
 */
class BasketController extends Controller{

    /**
     * @var SessionInterface
     */
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function __invoke(Request $request): Response
    {
        if ($request->isMethod('POST')) {

            $order = $this->session->get('order');

            $token = $request->request->get('stripeToken');

            \Stripe\Stripe::setApiKey("sk_test_A20bVsterAEgNtzP7zMp1L43");
            \Stripe\Charge::create(array(
                "amount" => $order->getTotalPrice() * 100,
                "currency" => 'eur',
                "source" => $token,
                "description" => "Stripe paiement tests"
            ));

            $this->addFlash('sucess', 'Order Complete !');

            return $this->redirectToRoute('home');
        }

        return $this->render('Shop/shopBasket.html.twig',['order'=>$this->session->get('order')]);
    }

}