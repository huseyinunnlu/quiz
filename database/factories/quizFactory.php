<?php

namespace Database\Factories;

use App\Models\quiz;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class quizFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = quiz::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence(rand(3,7));

        return [
            'title'=>$title,
            'slug'=>Str::slug($title),  
            'desc'=>$this->faker->text(200),
        ];
    }
}
