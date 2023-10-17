<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\Role::factory(4)->create();
        \App\Models\Role::create([
                'name' => 'Administrador',
                'description' => 'Usuario con todos los permisos',
            ]);
        \App\Models\User::factory(10)->create();
        \App\Models\User::create([
                'name' => 'Test User',
                'email' => 'curo@dev.com',
                'password' => bcrypt('76124769'),
                'id_role' => 5,
            ]);
        //\App\Models\Supplier::factory(5)->create();
        \App\Models\StateRequest::factory(3)->create();
        \App\Models\TypePayment::factory(2)->create();
        \App\Models\MethodPayment::factory(2)->create();
        \App\Models\Document::factory(50)->create();
        \App\Models\Question::factory(15)->create();


       // Crear 10 registros de SupplierRequest
        $supplierRequests = \App\Models\SupplierRequest::factory(80)->create();

        // Asignar preguntas y documentos aleatorios a cada SupplierRequest
        $supplierRequests->each(function ($supplierRequest) {
            $questions = \App\Models\Question::inRandomOrder()->limit(5)->get();
            $documents = \App\Models\Document::inRandomOrder()->limit(3)->get();

            // Asignar preguntas
            $supplierRequest->questions()->attach($questions);

            // Asignar documentos
            $supplierRequest->documents()->attach($documents);
        });

    }
}
