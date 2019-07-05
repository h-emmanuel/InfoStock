<?php

namespace App\DataFixtures;

use Faker;
use Faker\Factory;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;



class AppFixtures extends Fixture
{
    private $encoder;

public function __construct(UserPasswordEncoderInterface $encoder)
{
    $this->encoder = $encoder;
}
 
 
    public function load(ObjectManager $manager)
    {
       
       
       $faker = Faker\Factory::create("fr_FR");
        
        $roles = array(
            'ROLE_ADMIN'
        );
        $user = new User();
        $user->setEmail('admin@admin');
        $password = $this->encoder->encodePassword($user, 'admin');
        $user->setPassword($password)
            ->setRoles($roles)
            ->setNom('Admin')
        ;
        $manager->persist($user);
        $manager->flush();
   
    }
}
