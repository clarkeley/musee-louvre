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
        $order = $this->session->get('order');

        $order->session->get('order', 'ticket');

        /*$repository = $this->getDoctrine()->getRepository(Ticket::class);

        $order = $repository->findAll();*/

        return $this->render('Shop/shopBasket.html.twig');
    }
}