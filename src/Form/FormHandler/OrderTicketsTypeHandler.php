<?php
/**
 * Created by PhpStorm.
 * User: Clark
 * Date: 19/12/2018
 * Time: 22:23
 */

namespace App\Form\FormHandler;



use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class OrderTicketsTypeHandler
{
    /**
     * @var SessionInterface
     */
    private $session;


    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function handle(FormInterface $form) : bool
    {
        if ($form->isSubmitted() && $form->isValid()) {
            $order = $form->getData();

            $this->session->set('order', $order); // 0->3 = gratuit, 4->11 = 8 euros, 12->59 = 16 euros, 60 = 12 euros except rate = 10 euros

            if($order->getRate() == true){
                $order->setPrice(10);
            }
            else{
                foreach ($order as $order ){
                    if ($order->getAge() <= 3){
                        $order->setPrice(0);
                    }
                    elseif ($order->getAge() >= 4 & $order->getAge() <= 11){
                        $order->setPrice(8);
                    }
                    elseif ($order->getAge() >= 12 & $order->getAge() <= 59){
                        $order->setPrice(16);
                    }
                    else{
                        $order->setPrice(12);
                    }

                }
                switch ($order){
                    case 1 : if ($order->getAge() <= 3) $order->setPrice(0); break;

                    case 2 : if ($order->getAge() >= 4 & $order->getAge() <= 11) $order->setPrice(8); break;

                    case 3 : if ($order->getAge() >= 12 & $order->getAge() <= 59) $order->setPrice(16); break;

                    case 4 : if ($order->getAge() >= 60) $order->setPrice(12); break;
                }
            }

            return true;
        }

        return false;
    }

}