<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

            $faker = fake();

            // Determine how many users you want to create.
            // $users = $faker->numberBetween(1, 10);
            $users = 30;

            for ($i = 0; $i < $users; $i++) {
               DB::table('users')->insert([
                   'firstName' => $faker->firstName,
                   'lastName' => $faker->lastName,
                   'email' => $faker->unique()->safeEmail,
                   'mobile' => $faker->phoneNumber,
                   'password' => Hash::make('password'),
                   'otp' => $faker->numberBetween(1000, 9999),
                   'created_at' => now(),
                   'updated_at' => now()
               ]);
            }

        }
    }

