<?php

	namespace App\Controller;

	use App\Manager\OrderManager;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Annotation\Route;
	use Twig\Environment;

	/**
	 * @Route("/", name="home")
	 */
	class HomeController extends Controller
	{
        /**
         * @var OrderManager
         */
        private $orderManager;

		private $twig;

		public function __construct(Environment $twig, OrderManager $orderManager)
		{
			$this->twig = $twig;
            $this->orderManager = $orderManager;
		}

		public function __invoke(Request $request): Response
		{
            $this->orderManager->stop();

			return new Response($this->twig->render('home.html.twig'));
		}
	}