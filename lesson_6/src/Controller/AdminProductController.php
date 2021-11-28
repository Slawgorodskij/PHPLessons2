<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminProductController extends AbstractController
{
    #[Route('/admin/product', name: 'admin_product')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $product = new Product();
        $formProduct = $this->createForm(ProductType::class, $product);

        $formProduct->handleRequest($request);

        if($formProduct->isSubmitted() && $formProduct->isValid()){
            $entityManager->persist($product);
            $entityManager->flush();
        }


            return $this->render('admin_product/index.html.twig', [
            'formProduct' => $formProduct->createView(),
        ]);
    }
}
