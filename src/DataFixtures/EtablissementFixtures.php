<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Etablissement;

class EtablissementFixtures extends fixture 
{
    private $faker;

    public function __construct()
    {
        $this->faker=Factory::create("fr_FR");
    }

    public function load(ObjectManager $manager):void
    {
        for ($i=0; $i < 5; $i++) { 
            $etablissement = new Etablissement();
            $etablissement->setNom($this->faker->lastName().$this->faker->firstName())
                          ->setType('Scolaire');
            $this->addReference('etablissement'.$i, $etablissement);
            $manager->persist($etablissement);
        }
        $manager->flush();
    }
}

