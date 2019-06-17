<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Souscategory;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SouscategorieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('ordre')
            ->add('category',EntityType::class,[
                'class'=> Categorie::class,
                'choice_label'=>'titre'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Souscategory::class,
        ]);
    }
}
