<?php

namespace App\DataFixtures;

use App\Entity\Prospect;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Statuts;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class ProspectFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager): void
    {
        $firstNames = ['Emma', 'Lucas', 'Sophie','Léa', 'Hugo', 'Chloé', 'Nathan', 'Manon', 'Enzo', 'Camille'];
        $lastNames = ['Dubois', 'Martin', 'Bernard', 'Lefevre', 'Moreau', 'Girard', 'Garcia', 'Roux', 'Leroy', 'Mercier'];
        $entreprises = ['Studio Pixel', 'TechNova', 'Green Consulting', 'Innovatech', 'EcoSolutions', 'DigitalWave', 'SmartTech', 'FutureVision', 'NextGen', 'GlobalTech'];

        $statutsRepository = $manager->getRepository(Statuts::class);
        $statuts = $statutsRepository->findAll();

        for ($prospectNumber = 0; $prospectNumber < 15; $prospectNumber++) {

        $prospect = new Prospect();

        $firstName = $firstNames[array_rand($firstNames)];
        $lastName = $lastNames[array_rand($lastNames)];
        $entreprise = $entreprises[array_rand($entreprises)]; 

        $prospect->setFirstname($firstName);
        $prospect->setLastname($lastName);
        $prospect->setEntreprise($entreprise);
        $prospect->setEmail(strtolower($firstName).$prospectNumber.'@mail.com');

        $randowStatuts = $statuts[array_rand($statuts)];

        $prospect->setStatuts($randowStatuts);


        $manager->persist($prospect);
    }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            StatutsFixtures::class,
        ];
    }
}
