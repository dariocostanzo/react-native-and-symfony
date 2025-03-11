<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'api_')]
class ProductController extends AbstractController
{
    #[Route('/products', name: 'products_index', methods: ['GET'])]
    public function index(ProductRepository $productRepository): JsonResponse
    {
        $products = $productRepository->findAll();
        
        // Disable deprecation notices for this response
        error_reporting(E_ALL & ~E_DEPRECATED);
        
        // Add proper headers for CORS and JSON content type
        return $this->json(
            ['products' => $products],
            Response::HTTP_OK,
            [
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => 'GET, POST, OPTIONS',
                'Access-Control-Allow-Headers' => 'Content-Type, Authorization'
            ]
        );
    }

    #[Route('/products/{id}', name: 'products_show', methods: ['GET'])]
    public function show(Product $product): JsonResponse
    {
        // Disable deprecation notices for this response
        error_reporting(E_ALL & ~E_DEPRECATED);
        
        return $this->json(
            ['product' => $product],
            Response::HTTP_OK,
            [
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => 'GET, POST, OPTIONS',
                'Access-Control-Allow-Headers' => 'Content-Type, Authorization'
            ]
        );
    }
    
    #[Route('/products', name: 'products_options', methods: ['OPTIONS'])]
    public function options(): Response
    {
        return new Response('', Response::HTTP_OK, [
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Methods' => 'GET, POST, OPTIONS',
            'Access-Control-Allow-Headers' => 'Content-Type, Authorization'
        ]);
    }
}