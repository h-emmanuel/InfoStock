<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Recherche\RechercheUtilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RechercheUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RechercheUtilisateur::class,
            'method'     => 'get' ,
            'csrf_protection'=> false
        ]);
    }
    public function getBlockPrefix()
    {
        return '';
    }
}
