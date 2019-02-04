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
    /**
     * @var OrderManager
     */
    private $orderManager;

    /** @var \Swift_Mailer [description] */
    private $mailer;

    public function __construct(\Swift_Mailer $mailer, OrderManager $orderManager)
    {
        $this->mailer = $mailer;

        $this->orderManager = $orderManager;
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

            $this->mailer->send($message);

            return true;
    }

    public function orderMailer(Order $order, Ticket $ticket)
    {
        $message = (new \Swift_Message('Order'))
            ->setSubject('Order Contact'.$order['email'])
            ->setFrom('Musee-Louvre')
            ->setTo($order['email'])
            ->setBody($order, $ticket)
        ;

        $this->mailer->send($message);

        return true;
    }

}