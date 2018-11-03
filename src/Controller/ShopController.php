<?php

	namespace App\Controller;

	use Symfony\Bundle\FrameworkBundle\Controller\Controller;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Annotation\Route;
	use Twig\Environment;

	/**
	 * @Route("/billetterie", name = "billetterie")
	 */
	class ShopController extends Controller{

		private $twig;

		public function __construct(Environment $twig)
		{
			$this->twig = $twig;
		}

		public function __invoke(Request $request): Response
		{
			return new Response($this->twig->render('Shop/shop.html.twig'));
		}
	}