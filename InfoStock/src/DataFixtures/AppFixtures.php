<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Produit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;



class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
       
       
       $faker = Faker\Factory::create("fr_FR");
        
       for($i=0; $i < 100 ; $i++){
            $produits = new Produit();
            $produits->setLibelle($faker->name)
                    ->setPrix($faker->randomDigit)
                    ->setDescription($faker->word)
                    ->setValeursolde($faker->randomDigit)
                    ->setImageName('yolo')
                    
                         ;



            $manager->persist($produits);
        }
        $manager->flush();
       
    }
}
