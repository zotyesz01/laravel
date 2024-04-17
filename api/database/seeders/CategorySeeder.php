<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public int $categoryNumber = 10;

    public function run(): void
    {
        $categories = $this->createCategories();

        foreach ($categories as $category) {
            Category::create($category);
        }
    }

    private function createCategories(): array
    {
        $categories = [];

        for ($i = 1; $i <= $this->categoryNumber; $i++) {
            $categories[] =
                [
                    'name' => 'Kategória ' . $i,
                    'description' => $i . '. kategória leírása.',
                ];
        }

        return $categories;
    }
}
