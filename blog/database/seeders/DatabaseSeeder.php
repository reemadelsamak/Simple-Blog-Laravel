<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // use WithoutModelEvents;
        // \App\Models\User::factory(10)->create();
        // DB::table('posts')->insert([
        //     'title' => Str::random(10),
        //     'description' => Str::random(100),
        //     // 'password' => Hash::make('password'),
        // ]);

        $this->call([
            PostsSeeder::class,
            // PostSeeder::class,
            // CommentSeeder::class,
        ]);
    }
}
