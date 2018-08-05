<?php

use App\School;
use Illuminate\Database\Seeder;

class SchoolsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i < 11; $i++) {
            School::create([
                'name' => "Test Køreskole $i",
                'address' => "Testvej $i",
            ]);
        }
    }
}
