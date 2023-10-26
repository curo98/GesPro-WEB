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
        return [
            'id_user' => User::inRandomOrder()->first()->id,
            'id_type_payment' => TypePayment::inRandomOrder()->first()->id,
            'id_method_payment' => MethodPayment::inRandomOrder()->first()->id,
        ];
    }
}
