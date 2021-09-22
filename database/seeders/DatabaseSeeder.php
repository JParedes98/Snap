<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->manualDBSeed();

        \App\Models\User::factory(100)->create();
        \App\Models\File::factory(100)->create();
        \App\Models\Link::factory(100)->create();
        \App\Models\Snippet::factory(100)->create();
    }


    private function manualDBSeed() {
        \App\Models\User::create([
            'name'              => 'Admin User',
            'email'             => 'admin@admin.com',
            'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'remember_token'    => Str::random(10),
        ]);
    }
}
