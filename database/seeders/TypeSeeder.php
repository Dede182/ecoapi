<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = ['Chair','Fancy','Anaon','Mega'];
        foreach($types as $type){
            Type::factory()->create([
                'title' => $type,

            ]);
        }
    }
}
