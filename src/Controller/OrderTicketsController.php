<?php

namespace App\Controller;

use App\Events;
use App\Form\FormHandler\OrderTicketsTypeHandler;
use App\Form\OrderTicketsType;
use App\Manager\OrderManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/tickets", name = "tickets")
 */
class OrderTicketsController extends Controller{

    /**
     * @var OrderTicketsTypeHandler
     */
    private $formHandler;

    /**
     * @var OrderManager
     */
    private $orderManager;

    public function __construct(OrderTicketsTypeHandler $formHandler, OrderManager $orderManager)
    {
        $this->formHandler = $formHandler;
        $this->orderManager = $orderManager;
    }

    public function __invoke(Request $request): Response
    {
        $order = $this->orderManager->getCurrentOrder();

        $form = $this->createForm(OrderTicketsType::class, $order);

        $form->handleRequest($request);

        if ($this->formHandler->handle($form)) {
            return $this->redirectToRoute('basket');
        }

        return $this->render('Shop/shopTicket.html.twig', array('form' => $form->createView()));
    }
}