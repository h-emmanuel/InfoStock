<?php

namespace App\Form\Produit;

use App\Entity\Produit;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PercentType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       
        $builder->add('description', CKEditorType::class, array(
            'config' => array(
                'uiColor' => '#ffffff',)));
       
        $builder
            ->add('libelle')
            ->add('prix',MoneyType::class,[
                'currency'=>'EUR'
            ])
            ->add('solde',CheckboxType::class,[
                'required'=>false,
                'label'=>'Cochez la case si vous voulez que votre produit soit en solde.'

            ]) 
            ->add('valeursolde',PercentType::class,array(
                'label'=>'Pourcentage du solde ',
                'data'=> 1.0
            ))       
            ->add('imageFile', VichImageType::class, [
                'required' => false,
                'label'=>'Choisissez une image pour votre Produit',
                'allow_delete' => true,
                'download_label' => 'Télécharger',
                'download_uri' => true,
                'image_uri' => true,
            ])

            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
