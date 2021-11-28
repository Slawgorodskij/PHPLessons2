<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'product')]
    public function index(): Response
    {
        $productRepository = $this->getDoctrine()->getRepository(Product::class);
        $products = $productRepository->findAll();
        return $this->render('product/index.html.twig', [
            'title'=>'Магазин',
            'AllProducts' => $products,
        ]);
    }
}
