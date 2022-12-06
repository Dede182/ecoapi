<?php

namespace Database\Seeders;

use App\Models\TownShip;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TownShipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $townShip = ['Ygn','Mdy','Npy','SHN','MGW'];
        foreach($townShip as $town){
            TownShip::factory()->create([
                'name' => $town
            ]);
        };
    }
}
