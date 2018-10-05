<?php

      namespace App\Form\FormHandler;

      use Symfony\Component\Form\FormInterface;
      use Symfony\Component\EventDispatcher\EventDispatcherInterface;
      use Symfony\Component\EventDispatcher\EventDispatcher;
      use Symfony\Component\EventDispatcher\GenericEvent;

      final class ContactTypeHandler
      {

      	public function handle(FormInterface $form) : bool
      	{
      		if ($form->isSubmitted() && $form->isValid()) {

                  $entityManager = $this->getDoctrine()->getManager();//
                  $entityManager->persist($contact);
                  $entityManager->flush();

                  $event = new GenericEvent($contact);
                  $eventDispatcher = new EventDispatcher();//
                  $eventDispatcher->dispatch(Events::CONTACT_REGISTERED, $contact);

                  $request->getSession()->getFlashBag()->add('notice', 'Form has been sent');


                  return true;
              }

      		return false;
      	}
      }