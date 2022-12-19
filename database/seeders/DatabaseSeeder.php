<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Type;
use App\Models\Product;
use App\Models\TownShip;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Database\Seeder;

use function PHPSTORM_META\type;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            TownShipSeeder::class,
        ]);
        \App\Models\User::factory(10)->create();
        \App\Models\User::factory()->create([
            'name' => 'hhz',
            'role'=>'admin',
            'email' => 'hhz@gmail.com',
            'address' => "Insein,Somthing",
            'phone' => "092131",
            'pin' => "332",
            'password' => Hash::make('asdffdsa'),
            'town_ship_id' => TownShip::inRandomOrder()->first(),
        ]);
        \App\Models\User::factory()->create([
            'name' => 'example',
            'role'=> 'user',
            'email' => 'example@gmail.com',
            'address' => "Insein,Somthing",
            'phone' => "092131",
            'pin' => "332",
            'password' => Hash::make('asdffdsa'),
            'town_ship_id' => TownShip::inRandomOrder()->first(),
        ]);

        $this->call([

            CategorySeeder::class,
            TypeSeeder::class,
            ProductSeeder::class,
            ReviewSeeder::class,
            CartSeeder::class,
            OrderSeeder::class,
            OrderItemSeeder::class,
            OrderItemSeeder::class,
        ]);

        $file = new FileSystem;
        $file->cleanDirectory('storage/app/public/');

        echo "\e[93mStorage Cleaned \n";
    }
}
