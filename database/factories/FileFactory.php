<?php

namespace Database\Factories;

use App\Models\File;
use Illuminate\Database\Eloquent\Factories\Factory;

class FileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = File::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'     => $this->faker->sentence(3),
            'name'      => $this->faker->sentence(3),
            'location'  => $this->faker->sentence(2),
            'size'      => random_int(0, 25) * 1000,
            'mime'      => 'application/pdf',
            'is_private'=> random_int(0, 1),
            'user_id'   => \App\Models\User::all()->random()->id,
        ];
    }
}
