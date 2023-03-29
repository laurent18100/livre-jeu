<?php

namespace App\Controller;

use App\Repository\PersonnageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\PersonnageType;
use App\Entity\Personnage;
use App\Repository\AventureRepository;


class JouerController extends AbstractController
{

    #[Route('/jouer', name: 'app_jouer')]
    public function index(PersonnageRepository $personnageRepository): Response
    {
        $personnages = $personnageRepository->findAll();
        return $this->render('jouer/index.html.twig', [
            'personnages' => $personnages,
        ]);
    }
    /**#[Route('/jouer/new', name: 'app_jouer_creer')]
    public function NewPersonnage(PersonnageRepository $personnageRepository)
    {
        $personnage = new Personnage();
        $form = $this->createForm(PersonnageType::class, $personnage);
        return $this->render('jouer/new_personnage.html.twig', ['form' => $form, 'personnage' => $personnage]);


       
    }
**/

    #[Route('/jouer/new', name: 'app_jouer_creer')]
    public function NewPersonnage(Request $request, PersonnageRepository $personnageRepository)
    {
        $personnage = new Personnage();
        $form = $this->createForm(PersonnageType::class, $personnage);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $personnageRepository->save($personnage, true);
            return $this->redirectToRoute('app_jouer', [], Response::HTTP_SEE_OTHER);
        }
    
        return $this->render('jouer/new_personnage.html.twig', ['form' => $form->createView(), 'personnage' => $personnage]);
    }
    
#[Route('/jouer/aventures/{idPersonnage}', name: 'app_choix_aventure', methods:['GET'])]
public function afficherAventures($idPersonnage ,PersonnageRepository $personnageRepository,AventureRepository $aventureRepository): Response
{
    $personnage = $personnageRepository->find($idPersonnage);
    $aventures = $aventureRepository->findAll();

    return $this->render('jouer/aventures.html.twig', ['personnage' => $personnage, 'aventures' => $aventures]);
}

 
#[Route('/jouer/aventure/{idPersonnage}/{idAventure}', name: 'app_start_aventure', methods: ['GET'])]
public function demarrerAventure( PersonnageRepository     $personnageRepository,AventureRepository $AventureRepository,PartieRepository $partieRepository,$idPersonnage,$idAventure): Response







}
