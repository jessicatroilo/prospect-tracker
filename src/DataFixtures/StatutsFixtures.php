<?php 

namespace App\DataFixtures;

use App\Entity\Statuts;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StatutsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $statuts = [
            'Identifié',
            'Approché',
            'A relancer',
            'Rendez-vous fixé',
            'Proposition envoyée',
            'Signé'
        ];

        foreach ($statuts as $label) {
            $statut = new Statuts();
            $statut->setPrincipal($label);
            $manager->persist($statut);
        }

        $manager->flush();
    }
}