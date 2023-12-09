<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ux\Activity;

class ActivitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        // Array con datos de actividades
        $activities = [
            ['name' => 'Viajes de aventura', 'description' => 'Explora destinos emocionantes y realiza actividades de aventura.'],
            ['name' => 'Deportes extremos', 'description' => 'Practica deportes extremos como paracaidismo, rafting, etc.'],
            ['name' => 'Festivales de música', 'description' => 'Disfruta de la música en festivales y eventos culturales.'],
            ['name' => 'Festividades tradicionales', 'description' => 'Participa en festividades y celebraciones tradicionales del lugar.'],
            ['name' => 'Naturaleza', 'description' => 'Explora entornos naturales y parques nacionales.'],
            ['name' => 'Playa', 'description' => 'Relájate y disfruta del sol en hermosas playas.'],
        ];

        // Insertar actividades en la base de datos
        Activity::insert($activities);
    }
}
