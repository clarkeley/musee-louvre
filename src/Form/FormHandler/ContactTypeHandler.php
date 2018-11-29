<?php

      namespace App\Form\FormHandler;

      use Symfony\Component\Form\FormInterface;
      use Symfony\Component\Form\ContactType;

      final class ContactTypeHandler
      {

            /** @var \Swift_Mailer [description] */
            private $mailer;

            public function __construct(\Swift_Mailer $mailer)
            {
                  $this->mailer = $mailer;
            }

      	public function handle(FormInterface $form) : bool
      	{
      		if ($form->isSubmitted() && $form->isValid()) {

                  $builder = $form->getData();

                  $message = (new \Swift_Message('ContactMail'))
                        ->setSubject('Contact Form '.$builder['username'])
                        ->setFrom($builder['from'])
                        ->setTo('aemmanuel.project@gmail.com')
                        ->setBody($builder['message'])
                        ;

                  $this->mailer->send($message);


                  return true;
                  }

      		return false;
      	}
      }