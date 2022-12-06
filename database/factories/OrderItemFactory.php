<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
           'product_id' => Product::inRandomOrder()->first(),
           'order_id' => Order::inRandomOrder()->first(),
           'quantity' => fake()->numberBetween($min = 1, $max = 10)
        ];
    }
}
