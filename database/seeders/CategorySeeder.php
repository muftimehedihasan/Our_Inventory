<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = fake();
        $categories = $faker->numberBetween(1, 30);
        for ($i = 0; $i < $categories; $i++) {
            DB::table('categories')->insert([
                'name' => $faker->word,
                'user_id' => $faker->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30]),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
