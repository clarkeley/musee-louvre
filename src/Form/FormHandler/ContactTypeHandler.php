<?php

      namespace App\Form\FormHandler;

      use Symfony\Component\Form\FormInterface;
      use Symfony\Component\Form\ContactType;

      final class ContactTypeHandler
      {

      	public function handle(FormInterface $form) : bool
      	{
      		if ($form->isSubmitted() && $form->isValid()) {

                  /*$builder = $form->getData();
                  $mailer = new Swift_Mailer($transport);
                  $transport

                  $builder = new \Swift_Message::newInstance();
                  $this->get('mailer')->send($builder);

                  $message = (new \Swift_Message('ContactMail'))
                        ->setSubject('Contact Form', form.username)
                        ->setFrom(form.email)
                        ->setBody(form.message)

                  //$result = $mailer->send($message);

                  //$request->getSession()->getFlashBag()->add('notice', 'Form has been sent');

                  //return true;
                  //$form->getData();*/

                 // $builder = new \Swift_Message::newInstance();
                  $this->get('mailer')->send($builder);

                  $request->getSession()->getFlashBag()->add('notice', 'Form has been sent');


                  return true;
              }

      		return false;
      	}
      }