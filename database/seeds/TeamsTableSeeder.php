<?php

use App\Team;
use Illuminate\Database\Seeder;

class TeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i < 11; $i++) {
            Team::create([
              'school_id' => rand(1, 10),
              'owner_id' => 2,
              'name' => "Team $i",
            ]);
        }
    }
}
