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
         $this->call(PermissionsTableSeeder::class);
         $this->call(RolesTableSeeder::class);
         $this->call(UsersTableSeeder::class);
         $this->call(SchoolsTableSeeder::class);
         $this->call(CategoriesTableSeeder::class);
         $this->call(BookingTypesTableSeeder::class);
         $this->call(BookingsTableSeeder::class);
         $this->call(TeamsTableSeeder::class);
    }
}
