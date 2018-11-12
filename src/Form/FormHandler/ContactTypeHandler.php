<?php

      namespace App\Form\FormHandler;

      use Symfony\Component\Form\FormInterface;
      use Symfony\Component\Form\ContactType;

      final class ContactTypeHandler
      {

      	public function handle(FormInterface $form) : bool //\Swift_Mailer $mailer
      	{
      		if ($form->isSubmitted() && $form->isValid()) {

                  /*$builder = $form->getData();

                  $message = (new \Swift_Message('ContactMail'))
                        ->setSubject('Contact Form', form.username)
                        ->setFrom(form.email)
                        ->setBody(form.message)

                  $mailer->send($message);

                  $request->getSession()->getFlashBag()->add('notice', 'Form has been sent');*/

                  return true;
                  }

      		return false;
      	}
      }