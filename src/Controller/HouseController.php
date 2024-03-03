<?php

namespace App\Controller;

use App\Entity\House;
use App\Entity\Character;
use App\Repository\HouseRepository;
use App\Repository\CharacterRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HouseController extends AbstractController
{
    /**
     * route vers les maisons
     */
    #[Route('/house', name: 'house')]
    public function index(HouseRepository $houseRepository): Response
    {
        $houses = $houseRepository->findAll();

        return $this->render('house/index.html.twig', [
            'houses' => $houses,
        ]);
    }

    /**
     * route vers les personnage appartenant a une maison 
     */
    #[Route('/house/show/{id<\d+>}', name: 'house_show')]
    public function show(HouseRepository $houseRepository, CharacterRepository $characterRepository , int $id): Response
    {
        
        $house = $houseRepository->find($id);
    
        return $this->render('house/show.html.twig', [
            'house' => $house
        ]);
    }
}
