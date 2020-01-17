<?php

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
        // $this->call(UsersTableSeeder::class);
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'admin' => true,
        ]);
        DB::table('users')->insert([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => bcrypt('password'),
        ]);
        DB::table('type_votes')->insert([
            'name' => 'radio',
        ]);
        DB::table('type_votes')->insert([
            'name' => 'checkbox',
        ]);
        DB::table('votes')->insert([
            'question' => 'Какое время года вы любите больше?',
            'answer_options' => '[
                {"name": "Зима", "number_voters": 3}, 
                {"name": "Весна", "number_voters": 1}, 
                {"name": "Лето", "number_voters": 2}, 
                {"name": "Осень", "number_voters": 0}
            ]',
            'all_voters' => 6,
            'active' => 1,
            'type_vote_id' => 1,
        ]);
    }
}
