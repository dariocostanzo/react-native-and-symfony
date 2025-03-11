<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api', name: 'api_')]
class ProductController extends AbstractController
{
    private ProductRepository $productRepository;
    private SerializerInterface $serializer;
    private EntityManagerInterface $entityManager;

    public function __construct(
        ProductRepository $productRepository, 
        SerializerInterface $serializer,
        EntityManagerInterface $entityManager
    ) {
        $this->productRepository = $productRepository;
        $this->serializer = $serializer;
        $this->entityManager = $entityManager;
    }

    #[Route('/products', name: 'products_index', methods: ['GET'])]
    public function getProducts(): JsonResponse
    {
        try {
            $products = $this->productRepository->findAll();
            
            // Convert products to array of arrays
            $productsArray = [];
            foreach ($products as $product) {
                $productsArray[] = [
                    'id' => $product->getId(),
                    'name' => $product->getName(),
                    'description' => $product->getDescription(),
                    'price' => $product->getPrice(),
                ];
            }
            
            // Add CORS headers
            $response = new JsonResponse(['products' => $productsArray]);
            $response->headers->set('Access-Control-Allow-Origin', '*');
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        } catch (\Exception $e) {
            // Return error as JSON with CORS headers
            $response = new JsonResponse(['error' => $e->getMessage()], 500);
            $response->headers->set('Access-Control-Allow-Origin', '*');
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }
    }

    #[Route('/products/{id}', name: 'products_show', methods: ['GET'])]
    public function getProduct($id): JsonResponse
    {
        try {
            // Try to cast the ID to integer
            $id = (int) $id;
            
            $product = $this->productRepository->find($id);
            if (!$product) {
                $response = new JsonResponse(['error' => 'Product not found'], 404);
                $response->headers->set('Access-Control-Allow-Origin', '*');
                return $response;
            }
            
            // Convert product to array
            $productArray = [
                'id' => $product->getId(),
                'name' => $product->getName(),
                'description' => $product->getDescription(),
                'price' => $product->getPrice(),
            ];
            
            // Add CORS headers
            $response = new JsonResponse(['product' => $productArray]);
            $response->headers->set('Access-Control-Allow-Origin', '*');
            return $response;
        } catch (\Exception $e) {
            $response = new JsonResponse(['error' => $e->getMessage()], 500);
            $response->headers->set('Access-Control-Allow-Origin', '*');
            return $response;
        }
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

    #[Route('/test', name: 'api_test', methods: ['GET'])]
    public function test(): JsonResponse
    {
        $response = new JsonResponse(['status' => 'API is working!']);
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }
}