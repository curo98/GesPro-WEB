<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\SupplierRequest;
use App\Models\User;
use App\Models\StateRequest;
use App\Models\TypePayment;
use App\Models\MethodPayment;
use App\Models\Document;
use App\Models\Question;
use Illuminate\Support\Carbon;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SupplierRequest>
 */
class SupplierRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // return [
        //     'id_user' => User::inRandomOrder()->first()->id,
        //     'id_type_payment' => TypePayment::inRandomOrder()->first()->id,
        //     'id_method_payment' => MethodPayment::inRandomOrder()->first()->id,
        // ];

        $startDate = Carbon::now()->subYears(3); // Fecha de inicio hace 3 años
        $endDate = Carbon::now(); // Fecha actual

        $date = $this->faker->dateTimeBetween($startDate, $endDate); // Generar fecha aleatoria dentro del rango

        return [
            'id_user' => User::inRandomOrder()->first()->id,
            'id_type_payment' => TypePayment::inRandomOrder()->first()->id,
            'id_method_payment' => MethodPayment::inRandomOrder()->first()->id,
            'created_at' => $date, // Asigna la fecha aleatoria al campo created_at
        ];
    }
}
