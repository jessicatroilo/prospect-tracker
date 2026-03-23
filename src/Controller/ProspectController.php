<?php
namespace App\Controller;

use App\Entity\Prospect;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\ProspectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\HttpException;


#[Route('/api', name: 'prospect_')]
class ProspectController extends AbstractController
{
    /**
     * Méthode pour afficher la liste de tout les prospects
     */
    #[Route('/liste-des-prospects', name: 'list', methods: 'GET')]
    public function listProspect(ProspectRepository $prospectRepository): JsonResponse
    {
        $prospect = $prospectRepository->findAll();

        return $this->json($prospect, 200, [], ['groups'=>['prospect:read']]);

    }

    /**
     * Méthode pour créer un nouveau prospect et l'enregistrer dans la base de données
     *
     */
    #[Route('/créer-un-nouveau-prospect', name: 'create', methods: 'POST')]
    public function createProspect(EntityManagerInterface $entityManager): Response
    {
        $prospect = new Prospect();
        $prospect->setFirstname('John');
        $prospect->setLastname('Doe');
        $prospect->setEntreprise('TechNova');
        $prospect->setEmail('john.doe@example.com');


        // tell Doctrine you want to (eventually) save the Prospect (no queries yet)
        $entityManager->persist($prospect);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Nouveau prospect enregistré '.$prospect->getFirstName() .$prospect->getLastName() .$prospect->getentreprise());
    }


    #[Route('/prospect/{id}', name: 'show',  methods: 'GET')]
    public function showProspect(ProspectRepository $prospectRepository, int $id): Response
    {

        $prospect = $prospectRepository->find($id);

        if (!$prospect) {
            throw $this->createNotFoundException(
                'Pas de prospect trouvé'.$id
            );
        };

        return $this->json($prospect);

    }

    #[Route('/modifier-un-prospect/{id}', name: 'update', methods: 'PUT')] //TODO:ajout du requirement ID
    public function updateProspect (ProspectRepository $prospectRepository, int $id, EntityManagerInterface $entityManager): Response
    {
        $prospect = $prospectRepository->find($id);

        if (!$prospect) {
            throw $this->createNotFoundException(
                'Pas de prospect trouvé'.$id
            );
        };

        $prospect->setFirstname('Jane');
        $prospect->setLastname('Love');
        $prospect->setEntreprise('TechNova');
        $prospect->setEmail('john.doe@example.com');

        $entityManager->flush();

        return $this->json($prospect);
    }

    #[Route('/supprimer-un-prospect/{id}', name: 'delete', methods: 'DELETE')] //TODO:ajout du requirement ID
    public function deleteProspect (EntityManagerInterface $entityManager, int $id, ProspectRepository $prospectRepository): Response
    {

        $prospect = $prospectRepository->find($id);

        //gestion d'erreurs
        if (!$prospect) {
            throw $this->createNotFoundException(
                'Pas de prospect trouvé'
            );
        };

        $entityManager->remove($prospect);
        $entityManager->flush();

        return new Response('Le prospect a été supprimé '.$prospect->getFirstName() .$prospect->getLastName() .$prospect->getentreprise());
    }
}
