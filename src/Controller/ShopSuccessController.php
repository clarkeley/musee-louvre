<?php
/**
 * Created by PhpStorm.
 * User: Clark
 * Date: 04/02/2019
 * Time: 22:33
 */

namespace App\Controller;


use App\Entity\Order;
use App\Manager\OrderManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class ShopSuccessController extends Controller{
    /**
     * @var OrderManager
     */
    private $orderManager;

    public function __construct(OrderManager $orderManager)
    {
        $this->orderManager = $orderManager;
    }

    /**
     * @Route("/success", name = "success")
     * @throws \App\Exception\NoCurrentOrderException
     */
    public function showSuccess()
    {
        $order = $this->orderManager->getCurrentOrder();

        return $this->render('Shop/shopSuccess.html.twig', ['order'=> $order]);
    }

}