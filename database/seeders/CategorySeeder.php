<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Lighting','Decoration','Basic','Vases','Home Decor'];
        foreach($categories as $category){
            Category::factory()->create([
                'title' => $category,
                // "user_id"=> User::inRandomOrder()->first()->id
            ]);
        }
    }
}
