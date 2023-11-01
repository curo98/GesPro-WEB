<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StateRequest>
 */
class StateRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->randomElement(['Enviado', 'Por recibir', 'Recibido', 'Por validar', 'Validado', 'Por aprobar', 'Aprobado', 'En correccion', 'Corregida', 'Rechazada', 'Cancelada']),
            'description' => $this->faker->sentence(),
        ];
    }
}
