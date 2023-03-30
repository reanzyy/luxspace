<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 200) as $index)  {
            DB::table('products')->insert([
                'name' => $faker->city,
                'slug' => $faker->unique()->slug,
                'price' => $faker->numberBetween($min = 500, $max = 8000),
                'description'=> $faker->paragraph($nb =8)
                // 'details' => $faker->paragraph($nb =2),
            ]);
        }
    }
}
