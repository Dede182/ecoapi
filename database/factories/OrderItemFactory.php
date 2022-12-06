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
        $product = Product::inRandomOrder()->first();
        $amount =fake()->numberBetween($min = 1, $max = 10);
        return [
           'product_id' =>$product,
           'order_id' => Order::inRandomOrder()->first(),
           'amount' => $amount,
           'cost' => $product->price * $amount,
        ];
    }
}
