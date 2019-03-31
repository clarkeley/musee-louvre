<?php
/**
 * Created by PhpStorm.
 * User: Clark
 * Date: 31/01/2019
 * Time: 14:32
 */

namespace App\Services;


use App\Manager\OrderManager;
use Symfony\Component\HttpFoundation\RequestStack;

class StripePaiement
{

    private $request;

    public function __construct(RequestStack $requestStack)
    {
        $this->request = $requestStack->getCurrentRequest();

    }

    /**
     * @param $amount
     * @param $description
     * @return bool|string
     *
     */
    public function doPaiement($amount, $description)
    {

        $token = $this->request->request->get('stripeToken');

        \Stripe\Stripe::setApiKey("sk_test_A20bVsterAEgNtzP7zMp1L43");

        try
        {
            $charge = \Stripe\Charge::create(array(
                "amount" => $amount * 100,
                "currency" => 'eur',
                "source" => $token,
                "description" => $description
            ));
        }catch(\Exception $e){

            return false;
        }

        dump($charge);

        return $charge['id'];
    }

}