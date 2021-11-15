<?php

namespace App\Controller;

use App\Entity\ImagesBig;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
    #[Route('/', name: 'home_page')]
    public function index(): Response
    {
        $imageBigRepository = $this->getDoctrine()->getRepository(ImagesBig::class);
       // $allImagesBig = $imageBigRepository->findBy(['viewCount' => 'ASC']);
        //Подскажите почему при использовании findBy(['viewCount' => 'ASC'])
        //удаляются картинки отличные от ноля, вместо сортировки по убыванию.
        $allImagesBig = $imageBigRepository->findAll();

        return $this->render('home_page/index.html.twig', [
            'title' => 'Домашнее задание 3 урока',
            'allImagesBig' => $allImagesBig,
        ]);
    }
}
