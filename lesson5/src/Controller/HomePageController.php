<?php

namespace App\Controller;

use App\Entity\Images;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
    #[Route('/', name: 'home_page')]
    public function index(): Response
    {

        return $this->render('home_page/index.html.twig', [
            'title'=>'Главная страница',

        ]);
    }
}
