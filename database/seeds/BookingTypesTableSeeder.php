<?php

use App\BookingType;
use Illuminate\Database\Seeder;

class BookingTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $names = ['Single practical', 'Class theory (team)', 'Open slot (Practical)', 'Maneuvre course', 'Slippery course', 'Theory test', 'Driving test'];

        foreach($names as $name)
        {
            BookingType::create([
              'name' => $name,
            ]);
        }
    }
}
