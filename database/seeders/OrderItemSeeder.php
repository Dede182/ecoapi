<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Database\Factories\OrderItemFactory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = Product::inRandomOrder()->first();
        $amount =fake()->numberBetween($min = 1, $max = 10);
        $orders = Order::all();

        foreach($orders as $order){
            OrderItem::factory()->create([
                'product_id' =>$product,
                'order_id' => $order->id,
                'amount' => $amount,
                'cost' => $product->price * $amount,
            ]);
        }

    }
}
