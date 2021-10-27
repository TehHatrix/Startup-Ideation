<?php

namespace Database\Seeders;

use App\Models\Problem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProblemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $canvasIDs = DB::table('LeanCanvas')->pluck('canvas_ID')->toArray();

        for($i=0; $i<10; $i++){
            Problem::create([
                'canvas_ID' => $faker->randomElement($canvasIDs),
                'topic' => $faker->sentence($nbwords = 1, $variableNbWords = false),
                'description' => $faker->sentence($nbwords = 4, $variableNbWords = true),
                'publisher' => $faker->sentence($nbwords=2,$variableNbWords=true),
            ]);
        }
    }
}
