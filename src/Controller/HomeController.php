<?php

	namespace App\Controller;

	use Symfony\Bundle\FrameworkBundle\Controller\Controller;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Annotation\Route;
	use Twig\Environment;

	/**
	 * @Route("/", name="home")
	 */
	class HomeController extends Controller
	{
		private $twig;

		public fuction __construct(Environment $twig)
		{
			$this->twig = $twig;
		}

		return new Response($this->twig->render('home.html.twig'));//hello
	}