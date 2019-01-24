<?php

	namespace App\Controller;

    use App\Entity\Order;
    use App\Events;
    use App\Form\FormHandler\ShopTypeHandler;
    use App\Form\ShopType;
    use App\Manager\OrderManager;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;

    /**
	 * @Route("/billetterie", name = "billetterie")
	 */
	class ShopController extends Controller{

		private $formHandler;
        /**
         * @var OrderManager
         */
        private $orderManager;

        public function __construct(ShopTypeHandler $formHandler, OrderManager $orderManager)
		{
			$this->formHandler = $formHandler;
            $this->orderManager = $orderManager;
        }

		public function __invoke(Request $request): Response
		{
		    $order = $this->orderManager->getNewOrder();

            $form = $this->createForm(ShopType::class, $order);

            $form->handleRequest($request);

            if ($this->formHandler->handle($form)) {
                return $this->redirectToRoute('tickets');
            }

            return $this->render('Shop/shop.html.twig', array('form' => $form->createView()));
		}
	}