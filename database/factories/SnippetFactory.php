<?php

namespace Database\Factories;

use App\Models\Snippet;
use Illuminate\Database\Eloquent\Factories\Factory;

class SnippetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Snippet::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'         => $this->faker->sentence(3),
            'description'   => $this->faker->paragraph(5),
            'html'          => $this->faker->randomHtml(),
            'is_private'    => random_int(0, 1),
            'user_id'       => \App\Models\User::all()->random()->id,
        ];
    }
}
