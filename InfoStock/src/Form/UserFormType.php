<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UserFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('roles', ChoiceType::class, array(
                'attr'  =>  array('class' => 'form-control',
                'style' => 'margin:5px 0;'),
                'choices' => 
                array
                (
                       'ROLE_ADMIN' => array
            (
                'Yes' => 'ROLE_ADMIN',
            ),
                 'ROLE_USER' => array
            (
                'Yes' => 'ROLE_USER',
            ))))
            // , ChoiceType::class, [
            //     'choices' => [
            //     'user' => 'ROLE_USER',
            //     'administrateur' => 'ROLE_ADMIN'
            //     ]
            // ])

            ->add('password')
            ->add('nom')
            ->add('adresse')
            ->add('localite')
            ->add('compte')
            ->add('cat')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
