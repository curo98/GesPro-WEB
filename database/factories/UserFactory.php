<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use \App\Models\Role;
use Illuminate\Support\Carbon;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $role = Role::inRandomOrder()->first();

        $randomDayOfWeek = rand(1, 7); // Genera un número aleatorio del 1 al 7 para representar los días de la semana.

        // Crea una fecha utilizando Carbon y establece el día de la semana
        $date = Carbon::now()->startOfWeek()->addDays($randomDayOfWeek - 1); // Resta 1 para ajustar el número al índice de día de Carbon.

        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),

            'id_role' => $role->id,
            'email_verified_at' => now(),
            'password' => bcrypt('123456'), // password
            'remember_token' => Str::random(10),
            'created_at' => $date
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
