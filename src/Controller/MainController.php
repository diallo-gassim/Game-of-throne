<?php

namespace App\Controller;

use App\Entity\House;
use App\Repository\CharacterRepository;
use App\Repository\HouseRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{

    /**
     * route qui affiche tout les personnages
     */
    
    #[Route('/', name: 'main_home')]
    public function home(characterRepository $characterRepository): Response
    {
        $characters = $characterRepository->findAll();
         
        return $this->render('main/index.html.twig', [
            'characters' => $characters,
        ]);
    }



    /**
     * route qui affiche un personnage
     */
    #[Route('/show/{id<\d+>}', name: 'character_show')]
    public function show(CharacterRepository $characterRepository,int $id, HouseRepository $houseRepository): Response
    {
        $character = $characterRepository->find($id);
        $house = $characterRepository->findAll();
        
        return $this->render('main/show.html.twig', [
            'info' => $character,
            'house' => $house
            
        ]);
    }
} 