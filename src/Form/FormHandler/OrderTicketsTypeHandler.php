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
use Symfony\Component\Validator\Constraints\DateTime;

class OrderTicketsTypeHandler
{
    /**
     * @var SessionInterface
     */
    private $session;

    /* public $today = dateTime();
    public $today = $dateTime->format("yyyy-MM-dd");
    public $dateTime = \DateTime::createFromFormat("yyyy-MM-dd", );*/


    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function handle(FormInterface $form) : bool
    {
        if ($form->isSubmitted() && $form->isValid()) {
            $order = $form->getData();
            $tickets = $form->getData();

            $this->session->set('order', $order);
            $this->session->set('tickets', $tickets);

           if ($tickets->getBirthday() >= "2001-01-10" & $tickets->getRate() === true or $tickets->getBirthday() < "2001-01-10" & $tickets->getRate() === true) {
               $tickets->setPrice();
           }
           elseif ($tickets->getBirthday() >= "2001-01-10" & $tickets->getRate() === false or $tickets->getBirthday() < "2001-01-10" & $tickets->getRate() === false){
               $tickets->setPrice();
           }



            return true;
        }

        return false;
    }

}