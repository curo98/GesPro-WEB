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
            'name' => $this->faker->unique()->randomElement(['Enviado', 'Por recibir', 'Recibida', 'Por validar', 'Validada', 'Por aprobar', 'Aprobada', 'Desaprobada', 'Cancelada']),
            'description' => $this->generateDescription(),
        ];
    }

    private function generateDescription(): string
    {
        $status = $this->faker->randomElement(['Enviado', 'Por recibir', 'Recibida', 'Por validar', 'Validada', 'Por aprobar', 'Aprobada', 'Desaprobada', 'Cancelada']);

        switch ($status) {
            case 'Enviado':
                return 'La solicitud ha sido enviada y está pendiente de revisión.';
            case 'Por recibir':
                return 'La solicitud está en camino y se espera su recepción.';
            case 'Recibida':
                return 'La solicitud ha sido recibida correctamente.';
            case 'Por validar':
                return 'La solicitud está pendiente de validación.';
            case 'Validada':
                return 'La solicitud ha sido validada.';
            case 'Por aprobar':
                return 'La solicitud está pendiente de aprobación.';
            case 'Aprobada':
                return 'La solicitud ha sido aprobada y procesada.';
            case 'Desaprobada':
                return 'La solicitud ha sido desaprobada y no será procesada.';
            case 'Cancelada':
                return 'La solicitud ha sido cancelada antes de su procesamiento.';
            default:
                return 'Descripción no especificada para este estado.';
        }
    }
}
