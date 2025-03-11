<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $products = [
            [
                'name' => 'Premium Smartphone',
                'price' => 899.99,
                'description' => 'High-end smartphone with advanced features and excellent camera quality.'
            ],
            [
                'name' => 'Wireless Headphones',
                'price' => 149.99,
                'description' => 'Noise-cancelling headphones with exceptional sound quality and comfort.'
            ],
            [
                'name' => 'Smart Watch',
                'price' => 299.99,
                'description' => 'Feature-rich smartwatch with health tracking and smartphone notifications.'
            ]
        ];

        foreach ($products as $productData) {
            $product = new Product();
            $product->setName($productData['name']);
            $product->setPrice($productData['price']);
            $product->setDescription($productData['description']);
            
            $manager->persist($product);
        }

        $manager->flush();
    }
}