<?php

// symfony-backend/src/Controller/ApiController.php
namespace App\Controller;

use App\Entity\Product;
use App\Service\ProductService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/api', name: 'api_')]
class ApiController extends AbstractController
{
    private $productService;
    private $validator;

    public function __construct(ProductService $productService, ValidatorInterface $validator)
    {
        $this->productService = $productService;
        $this->validator = $validator;
    }

    #[Route('/products', name: 'get_products', methods: ['GET'])]
    public function getProducts(): JsonResponse
    {
        $products = $this->productService->getAllProducts();
        
        $data = [];
        foreach ($products as $product) {
            $data[] = [
                'id' => $product->getId(),
                'name' => $product->getName(),
                'description' => $product->getDescription(),
                'price' => $product->getPrice(),
            ];
        }
        
        return $this->json($data);
    }

    #[Route('/products/{id}', name: 'get_product', methods: ['GET'])]
    public function getProduct(int $id): JsonResponse
    {
        $product = $this->productService->getProductById($id);
        
        if (!$product) {
            return $this->json(['error' => 'Product not found'], 404);
        }
        
        return $this->json([
            'id' => $product->getId(),
            'name' => $product->getName(),
            'description' => $product->getDescription(),
            'price' => $product->getPrice(),
        ]);
    }

    #[Route('/products', name: 'create_product', methods: ['POST'])]
    public function createProduct(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        // Validate required fields
        if (!isset($data['name'], $data['description'], $data['price'])) {
            return $this->json(['error' => 'Missing required fields'], 400);
        }

        // Create product
        $product = $this->productService->createProduct(
            $data['name'],
            $data['description'],
            $data['price']
        );

        return $this->json([
            'id' => $product->getId(),
            'name' => $product->getName(),
            'description' => $product->getDescription(),
            'price' => $product->getPrice(),
        ], 201);
    }

    #[Route('/products/{id}', name: 'update_product', methods: ['PUT'])]
    public function updateProduct(Request $request, int $id): JsonResponse
    {
        $product = $this->productService->getProductById($id);

        if (!$product) {
            return $this->json(['error' => 'Product not found'], 404);
        }

        $data = json_decode($request->getContent(), true);

        // Validate required fields
        if (!isset($data['name'], $data['description'], $data['price'])) {
            return $this->json(['error' => 'Missing required fields'], 400);
        }

        // Update product
        $product->setName($data['name']);
        $product->setDescription($data['description']);
        $product->setPrice($data['price']);

        $this->productService->updateProduct($product);

        return $this->json([
            'id' => $product->getId(),
            'name' => $product->getName(),
            'description' => $product->getDescription(),
            'price' => $product->getPrice(),
        ]);
    }

    #[Route('/products/{id}', name: 'delete_product', methods: ['DELETE'])]
    public function deleteProduct(int $id): JsonResponse
    {
        $product = $this->productService->getProductById($id);

        if (!$product) {
            return $this->json(['error' => 'Product not found'], 404);
        }

        $this->productService->deleteProduct($product);

        return $this->json(null, 204);
    }
}
