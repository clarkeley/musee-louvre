<?php
/**
 * Created by PhpStorm.
 * User: Clark
 * Date: 13/12/2018
 * Time: 14:05
 */

namespace App\Form;


use App\Entity\Ticket;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TicketType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tickets', CollectionType::class, [
                'entry_type' => TicketType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'by_reference' => false
            ])

            ->add('firstName', TextType::class)

            ->add('lastName', TextType::class)

            ->add('country', ChoiceType::class, [
                'choices' => [
                    'France' => 'fr',
                    'Belgique' => 'be',
                    'United Kingdom' => 'uk',
                    'United States' => 'usa',
                    'Espagne' => 'es',
                    'Italie' => 'ita'
                ]
            ])

            ->add('birthday',BirthdayType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd'
            ])

            ->add('rate',MoneyType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ticket::class,
        ]);
    }

}