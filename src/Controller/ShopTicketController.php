<?php

namespace App\Controller;

use App\Events;
use App\Form\FormHandler\TicketTypeHandler;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

/**
 * @Route("/tickets", name = "tickets")
 */
class ShopTicketController extends Controller{

    private $twig;
    private $formHandler;
    private $formFactory;

    public function __construct(Environment $twig, TicketTypeHandler $formHandler, FormFactoryInterface $formFactory)
    {
        $this->twig = $twig;
        $this->formHandler = $formHandler;
        $this->formFactory = $formFactory;
    }

    public function __invoke(Request $request): Response
    {


        $form = $this->createForm();

        $form->handleRequest($request);

        if ($this->formHandler->handle($form)) {
            return $this->redirectToRoute('tickets');
        }

        return new Response($this->twig->render('Shop/shopTicket.html.twig', array('form' => $form->createView())));
    }
}