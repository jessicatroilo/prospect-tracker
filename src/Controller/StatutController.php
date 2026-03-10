<?php
namespace App\Controller;

use App\Entity\Statuts;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class StatutController extends AbstractController
{
    #[Route('/statuts', name: 'create_statut')]
    public function createStatut(EntityManagerInterface $entityManager): Response
    {
        $statut = new Statuts();
        $statut->setPrincipal('Identifié');

        // tell Doctrine you want to (eventually) save the Statuts (no queries yet)
        $entityManager->persist($statut);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new statut with id '.$statut->getId());
    }
}
