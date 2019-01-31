<?php

namespace App\Controller;

use App\Manager\OrderManager;
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
     * @var OrderManager
     */
    private $orderManager;

    public function __construct(OrderManager $orderManager)
    {
        $this->orderManager = $orderManager;
    }

    public function __invoke(Request $request): Response
    {
        $order = $this->orderManager->getCurrentOrder();
        if ($request->isMethod('POST')) {

            if($this->orderManager->pay($order)){

                $this->addFlash('success', 'Order Complete !');

                return $this->redirectToRoute('home');
            }else{
                $this->addFlash('danger', 'Problème stripe');
            }


        }

        return $this->render('Shop/shopBasket.html.twig',['order'=>$order]);
    }

}