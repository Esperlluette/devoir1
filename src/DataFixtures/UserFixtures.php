<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture 
{
    private $faker;
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->faker=Factory::create("fr_FR");
        $this->passwordHasher= $passwordHasher;
    }

    public function load(ObjectManager $manager):void
    {
        for($i=0;$i<10;$i++){
            $user = new User();
            $user->setNom($this->faker->lastName())
            ->setRole('ROLE_ADMIN')
            ->setEmail(strtolower(strtolower($user->getNom()).'@'.$this->faker->freeEmailDomain()))
            ->setPassword($this->passwordHasher->hashPassword($user, strtolower($user->getNom())));
            $manager->persist($user);
        }
        $manager->flush();
    }
    
}
