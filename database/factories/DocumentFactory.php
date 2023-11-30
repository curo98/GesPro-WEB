<?php

namespace Database\Factories;
use App\Models\Supplier;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Document>
 */
class DocumentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // $existingSupplier = Supplier::factory()->create();

        // return [
        //     'file' => $this->faker->word, // Genera un nombre de archivo ficticio
        //     'id_supplier' => $existingSupplier->id, // Obtiene el ID del proveedor existente
        // ];
    }
}
