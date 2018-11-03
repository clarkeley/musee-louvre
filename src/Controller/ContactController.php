<?php

    namespace App\Controller;

    use App\Form\ContactType;
    use App\Events;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\EventDispatcher\EventDispatcherInterface;
    use Symfony\Component\EventDispatcher\EventDispatcher;
    use Symfony\Component\EventDispatcher\GenericEvent;
    use Symfony\Component\Form\FormFactoryInterface;
    use App\Form\FormHandler\ContactTypeHandler;
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
                return $this->redirectToRoute('contact');
            }
            
            return new Response($this->twig->render('contact.html.twig', array('form' => $form->createView())));
        }
    }