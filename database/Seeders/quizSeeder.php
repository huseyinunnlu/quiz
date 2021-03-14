<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class quizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\quiz::factory(15)->create();
    }
}
