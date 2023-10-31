<?php

namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    protected $model = \App\Models\Role::class;

    public function definition()
    {
        return [
            'name' => $this->faker->unique()->randomElement(['compras', 'contabilidad', 'proveedor', 'invitado']),
            'description' => $this->faker->sentence(),
        ];
    }
}
