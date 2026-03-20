<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class UserFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(private UserPasswordHasherInterface $hasher )
    {

    }

    /**
     * Méthode pour créer des fixtures dans la BDD -
     * ici création d'un utilisateur avec mot de passe hashé
     */
    public function load(ObjectManager $manager) : void
    {
        //créer un nouvel utilisateur et hashe le mot de passe
        $user = new User();
        $user->setFirstname('Jessica');
        $user->setLastname('Dupont');
        $user->setEmail('test@fakemail.com');
        $user->setUsername('jessica');
        $user->setPassword (
            $this->hasher->hashPassword($user, 'monmotdepasse')
        );

        //sauvegarder et envoyer en BDD
        $manager->persist($user);
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ProspectFixtures::class,
        ];
    }
}

