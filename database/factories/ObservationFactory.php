<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Observation>
 */
class ObservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->title, // Genera un nombre de archivo ficticio
            'id_user' => \App\Models\User::inRandomOrder()->first()->id,
            'content' => $this->faker->word, // Obtiene el ID del proveedor existente
        ];
    }
}
