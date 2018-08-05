<?php

use App\Booking;
use Illuminate\Database\Seeder;

class BookingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 11; $i++) {
            Booking::create([
              'school_id' => rand(1, 10),
              'owner_id' => 2,
              'booking_type_id' => rand(1, 7),
              'name' => "Booking $i",
              'date' => '21/04/2018',
              'start' => '12:00',
              'end' => '14:00',
              'city' => 'Valby',
              'postal' => '2500',
              'street' => "Test street $i",
              'description' => "Test indhold $i",
            ]);
        }
    }
}
