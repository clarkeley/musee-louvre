<?php

namespace App\Controller;

use App\Events;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/rate", name = "rate")
 */
class RateController extends Controller{

    /**
     * @var SessionInterface
     */
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function __invoke()
    {
        // TODO: Implement __invoke() method.
    }

    /*
     $ticket = $form->getData();

     while(getRate() === true)
    {
        $ticket->setRate(9,50);
    }
    $ticket->setRate(15);*/




}