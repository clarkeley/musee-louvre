<?php

    namespace App\Controller;

    use App\Events;
    use App\Form\ContactType;
    use App\Form\FormHandler\ContactTypeHandler;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\Form\FormFactoryInterface;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Twig\Environment;

    /**
     * @Route("/contact", name="contact")
     */
    class ContactController extends Controller
    {
        private $formHandler;
        private $formFactory;
        private $twig;

        public function __construct(ContactTypeHandler $handler, FormFactoryInterface $formFactory, Environment $twig)
        {
            $this->formHandler = $handler;
            $this->formFactory = $formFactory;
            $this->twig = $twig;
        }

        public function __invoke(Request $request)
        {
            $form = $this->createForm(ContactType::class);
            $form->handleRequest($request);

            if ($this->formHandler->handle($form)) {
                $this->addFlash('success', 'Message envoyé !');
                return $this->redirectToRoute('contact');
            }
            
            return new Response($this->twig->render('contact.html.twig', array('form' => $form->createView())));
        }
    }