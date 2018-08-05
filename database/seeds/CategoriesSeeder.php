<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ['AM', 'A1', 'A2', 'A', 'B', 'B+', 'B/E', 'C1', 'C', 'C1/E', 'D1', 'D1/E', 'D/E', 'T/M',];

        for ($i = 0; $i < count($names); $i++) {
            Category::create([
                'name' => $names[$i],
            ]);
        }
    }
}
