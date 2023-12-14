<?php

namespace Database\Factories;

use App\Models\Practice\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonFactory extends Factory
{
    /**
     * Define el modelo de fábrica asociado.
     *
     * @var string
     */
    protected $model = Person::class;

    /**
     * Define el estado de la fábrica para un modelo de persona.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'age' => $this->faker->numberBetween(18, 60),
            'gender' => $this->faker->randomElement(['M', 'F']),
            'address' => $this->faker->address,
        ];
    }
}
