<?php

namespace Database\Seeders;

use App\Models\CustomerProblem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerProblemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $csIDs = DB::table('customer_segments')->pluck('cs_ID')->toArray();
        $problemIDs = DB::table('problems')->pluck('problem_ID')->toArray();

        for($i=0; $i<10; $i++){
            CustomerProblem::create([
                'cs_ID' => $faker->randomElement($csIDs),
                'problem_ID' => $faker->randomElement($problemIDs)
            ]);
        }
        //
    }
}
