<?php
/**
 * Created by PhpStorm.
 * User: Clark
 * Date: 04/02/2019
 * Time: 21:34
 */

namespace App\Services;


use App\Entity\Order;
use App\Entity\Ticket;
use App\Manager\OrderManager;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\ContactType;

class SwiftMailer
{

    /** @var \Swift_Mailer [description] */
    private $mailer;

    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function doContact(FormInterface $form)
    {
            $builder = $form->getData();

            $message = (new \Swift_Message('ContactMail'))
                ->setSubject('Contact Form '.$builder['username'])
                ->setFrom($builder['from'])
                ->setTo('aemmanuel.project@gmail.com')
                ->setBody($builder['message'])
            ;

            return $this->mailer->send($message);


    }

    public function orderMailer(Order $order)
    {
        $message = (new \Swift_Message('Order'))
            ->setSubject('Order Contact')
            ->setFrom('aemmanuel.project@gmail.com')
            ->setTo($order->getEmail())
            ->setBody($order->getRef())
        ;

        return $this->mailer->send($message);
    }

}