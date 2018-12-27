<?php

namespace App\Controller;

use App\Entity\Ticket;
use App\Events;
use App\Form\FormHandler\TicketTypeHandler;
use App\Form\OrderTicketsType;
use App\Form\TicketType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

/**
 * @Route("/tickets", name = "tickets")
 */
class ShopTicketController extends Controller{

    /**
     * @var SessionInterface
     */
    private $session;

    public function __construct( SessionInterface $session)
    {
        $this->session = $session;
    }

    public function __invoke(Request $request): Response
    {
        $order = $this->session->get('order');

        $form = $this->createForm(OrderTicketsType::class, $order);

        $form->handleRequest($request);


//        if ($this->formHandler->handle($form)) {
//            return $this->redirectToRoute('tickets');
//        }

        return $this->render('Shop/shopTicket.html.twig', array('form' => $form->createView()));
    }
}