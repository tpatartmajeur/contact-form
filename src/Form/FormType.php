<?php

namespace App\Form;

use App\Entity\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom',
                'help' => 'Votre nom ou prénom',
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'help' => 'Saisissez votre adresse mail',
                'attr'=> [
                    'placeholer' => 'votreadressemail@quelquechose.com'
                ]
            ])
            ->add('question', TextareaType::class, [
                'label' => 'Question',
                'help' => 'Saisissez votre question',
                'attr'=> [
                    'placeholer' => 'Je n\'arrive pas à accéder à mon profil',
                    'rows' => 5,
                    'cols' => 80,
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Form::class,
        ]);
    }
}
