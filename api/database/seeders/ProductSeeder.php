<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public int $productNumber = 100;

    public int $categoryNumber = 10;

    public function run(): void
    {
        $products = $this->createProducts();

        foreach ($products as $product) {
            Product::create($product);
        }
    }

    private function createProducts(): array
    {
        $products = [];

        for ($i = 1; $i <= $this->productNumber; $i++) {
            $products[] =
                [
                    'name' => 'Termék ' . $i,
                    'net_price' => 100 * $i,
                    'gross_price' => 127 * $i,
                    'description' => $i . '. termék leírása.',
                    'category_id' => rand(1, $this->categoryNumber),
                ];
        }

        return $products;
    }
}
