<?php
namespace App\Controller;

use App\Entity\Prospect;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\ProspectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;


#[Route('/', name: 'prospect_')]
class ProspectController extends AbstractController
{
    /**
     * Méthode pour afficher la liste de tout les prospects
     */
    #[Route('/liste-des-prospects', name: 'list')]
    public function listProspect(ProspectRepository $prospectRepository): JsonResponse
    {
        $prospect = $prospectRepository->findAll();
        dd($prospect);

        return $this->json($prospect);

    }

    /**
     * Méthode pour créer un nouveau prospect et l'enregistrer dans la base de données
     *  TODO: Ajouter une validation des données avant de les enregistrer
     * TODO: Ajouter une gestion des erreurs pour les cas où l'enregistrement échoue
     * TODO: Ajouter une redirection vers une page de confirmation ou de liste des prospects après l'enregistrement
     * TODO: Ajouter une interface utilisateur pour saisir les données du prospect au lieu de les coder en dur dans la méthode
     * TODO: Ajouter des tests pour cette méthode afin de s'assurer qu'elle fonctionne correctement et gère les cas d'erreur de manière appropriée
     */
    #[Route('/créer-un-nouveau-prospect', name: 'create')]
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


    #[Route('/prospect/{id}', name: 'show')]
    public function showProspect(ProspectRepository $prospectRepository, int $id): Response
    {

        $prospect = $prospectRepository->find($id);
        dd($prospect);

        return $this->json($prospect);

    }

    #[Route('/modifier-un-prospect/{id}', name: 'update')] //TODO:ajout du requirement ID
    public function updateProspect (ProspectRepository $prospectRepository, int $id, EntityManagerInterface $entityManager): Response
    {
        //TODO: Faire le code pour modifier un prospect précis
        //TODO: Gestion d'erreur
        //TODO: Validation des données
        //TODO: lien avec le formulaire


        $prospect = $prospectRepository->find($id);

        if (!$prospect) {
            throw $this->createNotFoundException(
                'Pas de prospect trouvé'.$id
            );
        }

        $prospect->setFirstname('Jane');
        $prospect->setLastname('Love');
        $prospect->setEntreprise('TechNova');
        $prospect->setEmail('john.doe@example.com');

        $entityManager->flush();
        dd($prospect);

        return $this->json($prospect);
    }

    #[Route('/supprimer-un-prospect/{id}', name: 'delete')] //TODO:ajout du requirement ID
    public function deleteProspect (EntityManagerInterface $entityManager, int $id, ProspectRepository $prospectRepository): Response
    {
        //TODO: Gestion d'erreur
        //TODO: Validation des données

        $prospect = $prospectRepository->find($id);

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
