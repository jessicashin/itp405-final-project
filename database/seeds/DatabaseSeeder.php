<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "Jessica Shin",
            'username' => "admin",
            'password' => bcrypt('laravel'),
            'admin' => 1
        ]);
    }
}
