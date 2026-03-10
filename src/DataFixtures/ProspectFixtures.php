<?php

namespace App\DataFixtures;

use App\Entity\Prospect;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProspectFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $firstNames = ['Emma', 'Lucas', 'Sophie','Léa', 'Hugo', 'Chloé', 'Nathan', 'Manon', 'Enzo', 'Camille'];
        $lastNames = ['Dubois', 'Martin', 'Bernard', 'Lefevre', 'Moreau', 'Girard', 'Garcia', 'Roux', 'Leroy', 'Mercier'];
        $entreprises = ['Studio Pixel', 'TechNova', 'Green Consulting', 'Innovatech', 'EcoSolutions', 'DigitalWave', 'SmartTech', 'FutureVision', 'NextGen', 'GlobalTech'];

        for ($prospectNumber = 0; $prospectNumber < 15; $prospectNumber++) {

        $prospect = new Prospect();

        $firstName = $firstNames[array_rand($firstNames)];
        $lastName = $lastNames[array_rand($lastNames)];
        $entreprise = $entreprises[array_rand($entreprises)]; 

        $prospect->setFirstname($firstName);
        $prospect->setLastname($lastName);
        $prospect->setEntreprise($entreprise);
        $prospect->setEmail(strtolower($firstName).$prospectNumber.'@mail.com');

        $manager->persist($prospect);
    }

        $manager->flush();
    }
}
