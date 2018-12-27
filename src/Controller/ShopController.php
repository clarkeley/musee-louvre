<?php

	namespace App\Controller;

    use App\Entity\Order;
    use App\Events;
    use App\Form\FormHandler\ShopTypeHandler;
    use App\Form\ShopType;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;

    /**
	 * @Route("/billetterie", name = "billetterie")
	 */
	class ShopController extends Controller{

		private $formHandler;

		public function __construct(ShopTypeHandler $formHandler)
		{
			$this->formHandler = $formHandler;
		}

		public function __invoke(Request $request): Response
		{
		    $order = new Order();


            $form = $this->createForm(ShopType::class, $order);

            $form->handleRequest($request);

            if ($this->formHandler->handle($form)) {
                return $this->redirectToRoute('tickets');
            }

            return $this->render('Shop/shop.html.twig', array('form' => $form->createView()));
		}
	}