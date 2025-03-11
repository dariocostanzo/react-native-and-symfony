<?php

namespace App\Service;

use App\Entity\Product;
use App\Repository\ProductRepository;

class ProductService
{
    private $productRepository;
    
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    
    public function getAllProducts()
    {
        return $this->productRepository->findAll();
    }
    
    public function getProductById(int $id)
    {
        return $this->productRepository->find($id);
    }
    
    public function createProduct(string $name, string $description, float $price): Product
    {
        $product = new Product();
        $product->setName($name);
        $product->setDescription($description);
        $product->setPrice($price);
        
        $this->productRepository->save($product, true);
        
        return $product;
    }
    
    public function updateProduct(Product $product): Product
    {
        $this->productRepository->save($product, true);
        
        return $product;
    }
    
    public function deleteProduct(Product $product): void
    {
        $this->productRepository->remove($product, true);
    }
}