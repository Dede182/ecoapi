<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'description' => fake()->text($maxNbChars = 300) ,
            'rating' => fake()->numberBetween($min = 1, $max = 5),
            'user_id' => User::inRandomOrder()->first(),
            'product_id'=> Product::inRandomOrder()->first(),
        ];
    }
}
