<?php

    namespace App\Form;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    use Symfony\Component\Form\Extension\Core\Type\EmailType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
    use Symfony\Component\Form\Extension\Core\Type\TextareaType;
    use Symfony\Component\Validator\Constraints\Email;

    class ContactType extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $builder
                ->add('Pseudo', TextType::class)
                ->add('Message', TextareaType::class)
                ->add('Email', EmailType::class, [
                    'constraints' => [
                        new Email()
                    ]
                ])
                ->add('rgpd', CheckboxType::class, [
                    'label' => "En soumettant ce formulaire, j'accepte que les informations saisies puissent être exploitées dans le cadre du support et de la relation commerciale qui peut en découler.",
                    'required' => true
                ])
            ;
        }

        public function configureOptions(OptionsResolver $resolver)
        {
            $resolver->setDefaults(array(
                'error_building' => true
            ));
        }
    }