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
                'description' => 'High-end smartphone with advanced features',
                'price' => 899.99,
            ],
            [
                'name' => 'Wireless Headphones',
                'description' => 'Noise-cancelling headphones with exceptional sound quality',
                'price' => 149.99,
            ],
            [
                'name' => 'Smart Watch',
                'description' => 'Feature-rich smartwatch with health tracking capabilities',
                'price' => 299.99,
            ],
        ];

        foreach ($products as $productData) {
            $product = new Product();
            $product->setName($productData['name']);
            $product->setDescription($productData['description']);
            $product->setPrice($productData['price']);
            $manager->persist($product);
        }

        $manager->flush();
    }
}