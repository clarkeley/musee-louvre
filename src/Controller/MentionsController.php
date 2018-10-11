<?php

	namespace App\Controller;

	use Symfony\Bundle\FrameworkBundle\Controller\Controller;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Annotation\Route;
	use Twig\Environment;

	/**
	 * @Route("/mentions", name="mentions_legales")
	 */
	class MentionsController extends Controller
	{
		private $twig;

		public function __construct(Environment $twig)
		{
			$this->twig = $twig;
		}

		public function __invoke(Request $request): Response
		{
			return new Response($this->twig->render('mentions.html.twig'));
		}
	}