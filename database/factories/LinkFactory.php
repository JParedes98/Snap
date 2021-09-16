<?php

namespace Database\Factories;

use App\Models\Link;
use Illuminate\Database\Eloquent\Factories\Factory;

class LinkFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Link::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'             => $this->faker->sentence(3),
            'url'               => $this->faker->url(),
            'open_in_new_tab'   => random_int(0, 1),
            'is_private'        => random_int(0, 1),
            'user_id'           => \App\Models\User::all()->random()->id,
        ];
    }
}
