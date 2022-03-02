<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $newUser = new User();
        $newUser->name = 'admin';
        $newUser->email = 'admin@admin';
        
        //password
        $string = '12345678';
        $newUser->password = Hash::make($string);
        $newUser->save();

        for ($i=0; $i < 5; $i++) {
            $newUser = new User();
            $newUser->name = $faker->name();
            $newUser->email = $faker->email();
            $string = '12345678';
            $newUser->password = Hash::make($string);
            $newUser->save();
        }
    }
}
