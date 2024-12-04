<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        \DB::table('users')->insert([
            'id' => 1,
            'name' => mt_rand(), 
            'email' => mt_rand().'@email.com', 
            'password' => Hash::make('password') 
        ]);

        
    }
}
