<?php

namespace App\Form;

use App\Entity\Order;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;


class ShopType extends AbstractType
{
    const BILLET1 = 'Demi-journée';
    const BILLET2 = 'Journée';

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', DateType::class,[
                'widget' => 'single_text'
            ])

            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Demi-journée' => self::BILLET1,
                    'Journée' => self::BILLET2
                ],
                'expanded' => true,
                'multiple' => false,
            ])

            ->add('quantite', NumberType::class, array(
                'attr' => array(
                    'min' => 1,
                    'max' => 10
                )
            ))

            ->add('email', EmailType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
}