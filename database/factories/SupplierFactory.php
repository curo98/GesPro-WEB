<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Lista de países latinoamericanos
        $latinAmericanCountries = ['Perú', 'México', 'Argentina', 'Brasil', 'Colombia', 'Chile', 'Ecuador', 'Venezuela', 'Bolivia', 'Uruguay'];

        // Obtener un usuario con rol "invitado"
        $invitadoUser = \App\Models\User::where('name', 'invitado')->first();

        if (!$invitadoUser) {
            $invitadoUser = \App\Models\User::factory()->create([
                'name' => 'invitado',
                'email' => 'invitado@example.com',
                'id_role' => 1, // Asigna el ID del rol correspondiente
            ]);
        }

        // Genera un país aleatorio: Perú o un país latinoamericano con mayor probabilidad
        $country = $this->faker->randomElement(array_merge([$this->faker->randomElement($latinAmericanCountries)], $latinAmericanCountries));

        return [
            'nacionality' => $country,
            'nic_ruc' => $this->faker->unique()->numerify('##########'), // Ejemplo de número aleatorio de 10 dígitos
            'id_user' => $invitadoUser->id,
            'state' => 'Inactivo',
        ];
    }
}
