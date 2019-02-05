<?php
/**
 * Created by PhpStorm.
 * User: Clark
 * Date: 04/02/2019
 * Time: 22:33
 */

namespace App\Controller;


use App\Entity\Order;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/success", name = "success")
 */
class ShopSuccessController extends Controller{

    public function showSuccess()
    {
        $repository = $this->getDoctrine()->getRepository(Order::class);

        $order = $repository->findAll();

        return $this->render('Shop/shopSuccess.html.twig', ['order', $order]);
    }

}