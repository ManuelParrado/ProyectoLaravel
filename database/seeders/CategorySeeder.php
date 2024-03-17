<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Groceries', 'description' => 'Expenses related to the purchase of groceries.', 'color' => '#4CAF50'],
            ['name' => 'Transportation', 'description' => 'Expenses related to public transportation or vehicle maintenance.', 'color' => '#FF9800'],
            ['name' => 'Entertainment', 'description' => 'Expenses allocated for recreational and leisure activities.', 'color' => '#9C27B0'],
            ['name' => 'Health', 'description' => 'Expenses related to medical care and health products.', 'color' => '#2196F3'],
            ['name' => 'Education', 'description' => 'Expenses related to education, courses, or books.', 'color' => '#FFC107'],
            ['name' => 'Home', 'description' => 'Expenses related to home maintenance and improvements.', 'color' => '#E91E63'],
            ['name' => 'Technology', 'description' => 'Expenses on electronic devices and technological services.', 'color' => '#607D8B'],
            ['name' => 'Travel', 'description' => 'Expenses associated with trips and vacations.', 'color' => '#FF5722'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
