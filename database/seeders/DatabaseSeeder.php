<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(100)->create();
        \App\Models\File::factory(100)->create();
        \App\Models\Link::factory(100)->create();
        \App\Models\Snippet::factory(100)->create();
    }
}
