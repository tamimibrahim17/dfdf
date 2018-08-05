<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Emil Gaarde',
            'email' => 'gaardee@gmail.com',
            'password' => bcrypt('secret'),
            'school_id' => 1,
            'avatar' => 'https://cdn.pixabay.com/photo/2015/03/04/22/35/head-659652_1280.png',
            'phone' => '',
            'address' => '',
            'zip' => '',
            'city' => '',
            ])->attachRole(1);
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@drivi.dk',
            'password' => bcrypt('secret'),
            'school_id' => 1,
            'phone' => '',
            'address' => '',
            'zip' => '',
            'city' => '',
        ])->attachRole(1);
        User::create([
            'name' => 'School Admin',
            'email' => 'admin@drivi.dk',
            'password' => bcrypt('secret'),
            'school_id' => 1,
            'phone' => '',
            'address' => '',
            'zip' => '',
            'city' => '',
        ])->attachRole(2);
        User::create([
            'name' => 'Teacher',
            'email' => 'teacher@drivi.dk',
            'password' => bcrypt('secret'),
            'school_id' => 1,
            'phone' => '',
            'address' => '',
            'zip' => '',
            'city' => '',
        ])->attachRole(3);
        User::create([
            'name' => 'Student',
            'email' => 'user@drivi.dk',
            'password' => bcrypt('secret'),
            'school_id' => 1,
            'phone' => '',
            'address' => '',
            'zip' => '',
            'city' => '',
        ])->attachRole(4);

        $faker = Faker\Factory::create();
        for ($i = 0; $i <= 10 ; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => bcrypt('secret'),
                'school_id' => rand(1,2),
                'phone' => '',
                'address' => '',
                'zip' => '',
                'city' => '',
            ])->attachRole(4);
        }
    }
}
