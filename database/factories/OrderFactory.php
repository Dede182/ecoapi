<?php

namespace Database\Factories;

use App\Models\TownShip;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        return [
            'code' => fake()->numerify("#######"),
            'deliveryOption' => fake()->randomElement(['SDO',"FDO"]),
            'payment' => fake()->randomElement(['CDO','Paypal','Amazon']),
            'status' => fake()->randomElement(['Delivered','Pending','Cancelled']),
            'user_id' => Auth::user()->id,
            'town_ship_id' => Auth::user()->town_ship_id,
            'admin_id' => User::where('role','admin')->first()->id,
        ];
    }
}
