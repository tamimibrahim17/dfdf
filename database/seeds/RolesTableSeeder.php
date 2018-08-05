<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'superadmin',
            'display_name' => 'Super Admin',
            'description' => 'Description goes here',
        ])->attachPermission([1, 2, 3, 4, 5, 6, 7]);

        Role::create([
            'name' => 'admin',
            'display_name' => 'Admin',
            'description' => 'Description goes here',
        ])->attachPermission([1, 2, 8, 9, 10, 11, 12, 13, 14, 18, 19, 20, 21, 22, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 51, 52]);

        Role::create([
            'name' => 'teacher',
            'display_name' => 'Teacher',
            'description' => 'Description goes here',
        ])->attachPermission([1, 2, 13, 14, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 34, 35, 39, 40, 51, 52, 55,]);

        Role::create([
            'name' => 'student',
            'display_name' => 'Student',
            'description' => 'Description goes here',
        ])->attachPermission([1, 2, 25, 28, 53, 54,]);
    }
}
