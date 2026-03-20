<?php
namespace App\Controller;

use App\Entity\Statuts;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\StatutsRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

class StatutController extends AbstractController
{
    #[Route('/api/statuts', name: 'create_statut', methods: 'POST')]
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

    #[Route('/api/liste-des-statuts', name: 'statut_list', methods: 'GET')]
    public function listProspect(StatutsRepository $statutsRepository): JsonResponse
    {
        $statut = $statutsRepository->findAll();

        return $this->json($statut, 200, [], ['groups'=>['prospect:read']]);

    }
}
