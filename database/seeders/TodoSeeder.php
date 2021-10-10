<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::get()->each(function ($user) {
            \App\Models\Todo::factory(100)->create(['user_id' => $user->id]);
        });
    }
}
