<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 20) as $index) {
            DB::table('posts')->insert([
                'title' => $faker->sentence(1),
                'description' => $faker->sentence(2),
                'user_id' => 1,
                'created_at' => now(),
            ]);
        }
    }
}
