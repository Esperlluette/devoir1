<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Professeur;
use App\Entity\Etablissement;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ProfesseurFixtures extends Fixture implements DependentFixtureInterface
{
    private $faker;

    public function __construct(){
        $this->faker=Factory::create("fr_FR");
    }

    public function load(ObjectManager $manager):void {

        $etablissments = [];
        for ($i=0; $i < 5 ; $i++) { 
            $etablissments[$i]= ($this->getReference('etablissement'.$i));
        }
       
        foreach ($etablissments as  $etablissment) {        
            for ($i=0; $i < mt_rand(10, 50); $i++) { 
                $professeur = new Professeur();
                $professeur->setNom($this->faker->lastName())
                        ->setPrenom($this->faker->firstName())
                        ->setRue($this->faker->sentence(2))
                        ->setVille($this->faker->city())
                        ->setCodePostal(mt_rand(10000, 99999))
                        ->setEtablissement($etablissment);
                        $manager->persist($professeur);
            }
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            EtablissementFixtures::class,
        ];
    }
}
