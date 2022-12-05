<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Category;
use App\Models\Type;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name,
            'price' => fake()->randomFloat($nbMaxDecimals = 2, $min = 2, $max = 3000),
            'quantity' => fake()->numberBetween($min = 0, $max = 200),
            'description' => fake()->text($maxNbChars = 600) ,
            'status' => fake()->randomElement(['publish','draft']),
            'user_id' => User::where('role','admin')->first(),
            'category_id' => Category::inRandomOrder()->first(),
            'type_id' => Type::inRandomOrder()->first(),
        ];
    }
}
