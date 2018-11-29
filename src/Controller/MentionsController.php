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

        /**
         * @param Request $request
         * @return Response
         * @throws \Twig_Error_Loader
         * @throws \Twig_Error_Runtime
         * @throws \Twig_Error_Syntax
         */
        public function __invoke(Request $request): Response
		{
			return new Response($this->twig->render('mentions.html.twig'));
		}
	}