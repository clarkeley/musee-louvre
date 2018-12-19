<?php

	namespace App\Controller;

    use App\Entity\Order;
    use App\Events;
    use App\Form\ShopType;
    use App\Form\FormHandler\ShopTypeHandler;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\Form\FormFactoryInterface;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Twig\Environment;

	/**
	 * @Route("/billetterie", name = "billetterie")
	 */
	class ShopController extends Controller{

		private $twig;
		private $formHandler;
		private $formFactory;

		public function __construct(Environment $twig, ShopTypeHandler $formHandler, FormFactoryInterface $formFactory)
		{
			$this->twig = $twig;
			$this->formHandler = $formHandler;
			$this->formFactory = $formFactory;
		}

		public function __invoke(Request $request): Response
		{
		    $order = new Order();

            try {
                $order->setRefOrder(random_int(1, 999999));
            } catch (\Exception $e) {
            }

            $form = $this->createForm(ShopType::class, $order);

            $form->handleRequest($request);

            if ($this->formHandler->handle($form)) {
                return $this->redirectToRoute('billetterie');
            }

            return new Response($this->twig->render('Shop/shop.html.twig', array('form' => $form->createView())));
		}
	}