<?php
/**
 * Created by PhpStorm.
 * User: Clark
 * Date: 14/03/2019
 * Time: 13:45
 */

namespace App\EventListener;


use App\Exception\NoCurrentOrderException;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\Routing\RouterInterface;

class NoCurrentOrderListener
{

    /**
     * @var RouterInterface
     */
    private $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        // You get the exception object from the received event
        $exception = $event->getException();



        // HttpExceptionInterface is a special type of exception that
        // holds status code and header details
        if ($exception instanceof NoCurrentOrderException) {
            $event->setResponse(new RedirectResponse($this->router->generate('home')));

        }
    }

}