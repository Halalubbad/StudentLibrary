<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(1)->create();
        User::create([
            'name' => 'hala',
            'email' => 'hala@email.com',
            'password' => Hash::make('hala'),
            'university_id' => 1,
            'image_src' => 'fsgggsdg',
        ]);
    }
}
