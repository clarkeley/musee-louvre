<?php
/**
 * Created by PhpStorm.
 * User: Clark
 * Date: 13/12/2018
 * Time: 14:05
 */

namespace App\Form;


use App\Entity\Ticket;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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


            ->add('firstName', TextType::class)

            ->add('lastName', TextType::class)

            ->add('country', CountryType::class)
            ->add('birthday',BirthdayType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd'
            ])

            ->add('rate',CheckboxType::class, ['required'=>false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ticket::class,
        ]);
    }

}