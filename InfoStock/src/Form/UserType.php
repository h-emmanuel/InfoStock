<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $roles = array(
            "User" => "ROLE_USER",
            "Admin" => "ROLE_ADMIN",
        );
        $builder
            ->add('email')
            ->add('roles', ChoiceType::class, array(
                'choices' => $roles,
                'multiple' => true,
                'expanded' => true,
                'mapped' => true,
                'label' => 'Roles à attribuer aux utilisateurs',
                'translation_domain' => 'messages'
            ))
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
