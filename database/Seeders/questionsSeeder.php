<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class questionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\Questions::factory(100)->create();
    }
}
