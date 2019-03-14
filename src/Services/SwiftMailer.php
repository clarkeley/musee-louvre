<?php
/**
 * Created by PhpStorm.
 * User: Clark
 * Date: 04/02/2019
 * Time: 21:34
 */

namespace App\Services;


use App\Entity\Order;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\FormInterface;
use Twig\Environment;

class SwiftMailer
{

    /** @var \Swift_Mailer [description] */
    private $mailer;

    /**
     * @var Environment
     */
    private $twig;


    public function __construct(\Swift_Mailer $mailer, Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    public function doContact(FormInterface $form)
    {
            $builder = $form->getData();

            $message = (new \Swift_Message('ContactMail'))
                ->setSubject('Contact Form '.$builder['Pseudo'])
                ->setFrom($builder['Email'])
                ->setTo('aemmanuel.project@gmail.com')
                ->setBody($builder['Message'])
            ;

            return $this->mailer->send($message);


    }

    /**
     * @param Order $order
     * @return int
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function orderMailer(Order $order)
    {
        $message = (new \Swift_Message('Order'))
            ->setSubject('Order Contact')
            ->setFrom('aemmanuel.project@gmail.com')
            ->setTo($order->getEmail())
            ->setBody($this->twig->render('Email/shopMail.html.twig', ['order'=>$order]), 'text/html')
        ;

        return $this->mailer->send($message);
    }

}