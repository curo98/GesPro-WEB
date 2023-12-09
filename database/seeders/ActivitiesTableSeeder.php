<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ux\Activity;
use App\Models\ux\TouristSpot;
use App\Models\ux\Destination;

class ActivitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        // Actividades
        $activities = [
            ['name' => 'Viajes de aventura', 'description' => 'Explora destinos emocionantes y realiza actividades de aventura.'],
            ['name' => 'Deportes extremos', 'description' => 'Practica deportes extremos como paracaidismo, rafting, etc.'],
            ['name' => 'Festivales de música', 'description' => 'Disfruta de la música en festivales y eventos culturales.'],
            ['name' => 'Festividades tradicionales', 'description' => 'Participa en festividades y celebraciones tradicionales del lugar.'],
            ['name' => 'Naturaleza', 'description' => 'Explora entornos naturales y parques nacionales.'],
            ['name' => 'Playa', 'description' => 'Relájate y disfruta del sol en hermosas playas.'],
        ];

        // Actividades
        $dest = [
            ['name' => 'Piura'],
            ['name' => 'Loreto'],
            ['name' => 'La Libertad'],
            ['name' => 'Áncash'],
            ['name' => 'Ica'],
            ['name' => 'Tumbes'],
            ['name' => 'Lima'],
            ['name' => 'Arequipa'],
            ['name' => 'Cusco'],
            ['name' => 'Puno'],
        ];

        // Insertar actividades en la base de datos
        Activity::insert($activities);
        Destination::insert($dest);

        // Deportes Extremos
        $extremeSports = [
            ['name' => 'Surf', 'description' => 'Surfea las olas en la playa Punta Sal, Piura.', 'uri' => '/sites/surf_puntasal.jpeg', 'destination_id' => '1', 'exact_location' => 'Punta Sal'],
            ['name' => 'Espeleología', 'description' => 'Explora cuevas en la Reserva Nacional de Pacaya Samiria, Loreto.', 'uri' => '/sites/espeleologia_loreto.jpeg', 'destination_id' => '2', 'exact_location' => 'Reserva Nacional de Pacaya Samiria'],
            ['name' => 'Paracaidismo', 'description' => 'Salto en paracaídas en el Aeródromo de Pisco, Ica.', 'uri' => '/sites/paracaidismo_ica.jpeg', 'destination_id' => '5', 'exact_location' => 'Aeródromo de Pisco'],
            ['name' => 'Sandboarding', 'description' => 'Deslízate por las dunas de Chachalacas, La Libertad.', 'uri' => '/sites/sanboarding_libertad.jpeg', 'destination_id' => '3', 'exact_location' => 'Chachalacas'],
            ['name' => 'Ciclismo de Montaña', 'description' => 'Recorre los circuitos de montaña en Huaraz, Áncash.', 'uri' => '/sites/ciclismo_ancash.jpeg', 'destination_id' => '4', 'exact_location' => 'Huaraz'],
            ['name' => 'Parapente', 'description' => 'Vuela sobre la Reserva Nacional de Paracas, Ica.', 'uri' => '/sites/vuela_paracas.jpeg', 'destination_id' => '5', 'exact_location' => 'Reserva Nacional de Paracas'],
            ['name' => 'Kitesurfing', 'description' => 'Practica kitesurf en la playa Zorritos, Tumbes.', 'uri' => '/sites/kitesurf_tumbes.jpeg', 'destination_id' => '6', 'exact_location' => 'Zorritos'],
            ['name' => 'Escalada en Roca', 'description' => 'Escalada en las rocas de Santa Eulalia, Lima.', 'uri' => '/sites/escalada_lima.jpeg', 'destination_id' => '7', 'exact_location' => 'Santa Eulalia'],
            ['name' => 'Buceo', 'description' => 'Exploración submarina en la Reserva Nacional de Paracas, Ica.', 'uri' => '/sites/buceo_paracas.jpeg', 'destination_id' => '5', 'exact_location' => 'Reserva Nacional de Paracas'],
            ['name' => 'Canotaje en Aguas Bravas', 'description' => 'Descenso en aguas bravas del río Cotahuasi, Arequipa.', 'uri' => '/sites/canotaje_cotahuasi.jpeg', 'destination_id' => '8', 'exact_location' => 'Cotahuasi'],
            ['name' => 'Paracaidismo', 'description' => 'Experimenta la emoción de saltar en paracaídas en Cusco.', 'uri' => '/sites/paracaidismo_cusco.jpeg', 'destination_id' => '9', 'exact_location' => 'Cusco'],
            ['name' => 'Rafting', 'description' => 'Desciende aguas rápidas en el río Chili, Arequipa.', 'uri' => '/sites/rafting_arequipa.jpeg', 'destination_id' => '8', 'exact_location' => 'Río Chili'],
            ['name' => 'Parapente', 'description' => 'Vuela sobre el Valle Sagrado en Puno.', 'uri' => '/sites/parapente_puno.jpeg', 'destination_id' => '10', 'exact_location' => 'Valle Sagrado'],
            ['name' => 'Bungee Jumping', 'description' => 'Salto al vacío desde el Puente Colgante Q\'eswachaka, Áncash.', 'uri' => '/sites/salto_ancash.jpeg', 'destination_id' => '4', 'exact_location' => 'Puente Colgante Q\'eswachaka'],
            ['name' => 'Sandboarding', 'description' => 'Practica sandboarding en las dunas de Huacachina, Ica.', 'uri' => '/sites/sandboarding_ica.jpeg', 'destination_id' => '5', 'exact_location' => 'Huacachina'],
            ['name' => 'Canopy', 'description' => 'Deslízate por la selva amazónica en Loreto.', 'uri' => '/sites/canopy_loreto.jpeg', 'destination_id' => '2', 'exact_location' => 'Selva Amazónica'],
            ['name' => 'Escalada en Roca', 'description' => 'Escalada en las rocas de Huanchaco, La Libertad.', 'uri' => '/sites/escalada_libertad.jpeg', 'destination_id' => '3', 'exact_location' => 'Huanchaco'],
            ['name' => 'Parapente', 'description' => 'Vuela sobre las Líneas de Nazca, Ica.', 'uri' => '/sites/vuela_nazca.jpeg', 'destination_id' => '5', 'exact_location' => 'Líneas de Nazca'],
            ['name' => 'Kitesurfing', 'description' => 'Practica kitesurfing en la playa de Máncora, Piura.', 'uri' => '/sites/kitesurf_mancora.jpeg', 'destination_id' => '1', 'exact_location' => 'Máncora'],
            ['name' => 'Canotaje', 'description' => 'Desciende el río Urubamba en Cusco.', 'uri' => '/sites/canotaje_cusco.jpeg', 'destination_id' => '9', 'exact_location' => 'Río Urubamba'],
        ];

        // Insertar deportes extremos en la base de datos
        TouristSpot::insert($extremeSports);
    }
}
