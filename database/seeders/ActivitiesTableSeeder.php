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
        // Insertar actividades en la base de datos
        Activity::insert($activities);

        // Actividades
        $dest = [
            ['name' => 'Piura'],
            ['name' => 'Loreto'],
            ['name' => 'La Libertad'],
            ['name' => 'Áncash'],
            ['name' => 'Ica'],
            ['name' => 'Tumbes'],
            ['name' => 'Arequipa'],
            ['name' => 'Cusco'],
            ['name' => 'Puno'],
        ];


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

        // Deportes Extremos
        $buses = [
            ['name' => 'Sullana Express'], // piura 90  - loreto 90 - tumbes 150
            ['name' => 'ITTSABUS'],  // piura 85 - loreto 120
            ['name' => 'Terramovil Peru'], // piura 90 - loreto 90
            ['name' => 'Transportes Dora'], //piura 80 - loreto 80
            ['name' => 'Turismo Tacna Internacional'],//piura 110
            ['name' => 'Seysan'], // la libertad 70
            ['name' => 'Transportes Julio Cesar'], // ancash 58.5
            ['name' => 'Flor Movil'], // ancash 47.5
            ['name' => 'Perubus'], // ica 50
            ['name' => 'Jaksa'], // ica 32.4
            ['name' => 'Paredes Estrella VIP'], // ica 80
            ['name' => 'Danielito Tours'], // ica 60
            ['name' => 'Expreso Santa Clara'], // ica 40
            ['name' => 'Danielito Tours'], // ica 60
            ['name' => 'Turismo Tacna Internacional'], // Tumbes 130 - Arequipa 120
            ['name' => 'Turismo y Transportes Costa Mar'], // Tumbes 150
            ['name' => 'Transportes Argo'], // Tumbes 150
            ['name' => 'Andoriña Tours'], // Arequipa 80
            ['name' => 'Guardianes Del Cosmos'], // Arequipa 100
            ['name' => 'Wari Palomino'], // Arequipa 80
            ['name' => 'Transportes Reyna'], // Arequipa 90
            ['name' => 'Waybus'], // Arequipa 110
            ['name' => 'Abba Bus'], // Arequipa 90
            ['name' => 'Paredes Estrella VIP'], // Cusco 100
            ['name' => 'Turismo Molina'], // Cusco 110
            ['name' => 'Transportes Imperial Cusco'], // Cusco 90
            ['name' => 'Guardianes Del Cosmos'], // Puno 140
        ];

        // Insertar deportes extremos en la base de datos
        Bus::insert($buses);

        // Asignar tarifas a destinos y buses
        $tarifas = [
            // Piura
            ['bus_id' => 1, 'price' => 90.00, 'destination_id' => 1], // Sullana Express
            ['bus_id' => 2, 'price' => 85.00, 'destination_id' => 1], // ITTSABUS
            ['bus_id' => 3, 'price' => 90.00, 'destination_id' => 1], // Terramovil Peru
            ['bus_id' => 4, 'price' => 80.00, 'destination_id' => 1], // Transportes Dora
            ['bus_id' => 5, 'price' => 110.00, 'destination_id' => 1], // Turismo Tacna Internacional

            // Loreto
            ['bus_id' => 1, 'price' => 90.00, 'destination_id' => 2], // Sullana Express
            ['bus_id' => 2, 'price' => 120.00, 'destination_id' => 2], // ITTSABUS
            ['bus_id' => 3, 'price' => 90.00, 'destination_id' => 2], // Terramovil Peru
            ['bus_id' => 4, 'price' => 80.00, 'destination_id' => 2], // Transportes Dora

            // La Libertad
            ['bus_id' => 6, 'price' => 70.00, 'destination_id' => 3], // Seysan

            // Áncash
            ['bus_id' => 7, 'price' => 58.50, 'destination_id' => 4], // Transportes Julio Cesar
            ['bus_id' => 8, 'price' => 47.50, 'destination_id' => 4], // Flor Movil
            ['bus_id' => 15, 'price' => 100.00, 'destination_id' => 4], // Paredes Estrella VIP

            // Ica
            ['bus_id' => 9, 'price' => 50.00, 'destination_id' => 5], // Perubus
            ['bus_id' => 10, 'price' => 32.40, 'destination_id' => 5], // Jaksa
            ['bus_id' => 11, 'price' => 80.00, 'destination_id' => 5], // Paredes Estrella VIP
            ['bus_id' => 12, 'price' => 60.00, 'destination_id' => 5], // Danielito Tours
            ['bus_id' => 13, 'price' => 40.00, 'destination_id' => 5], // Expreso Santa Clara
            ['bus_id' => 14, 'price' => 60.00, 'destination_id' => 5], // Danielito Tours

            // Tumbes
            ['bus_id' => 15, 'price' => 130.00, 'destination_id' => 6], // Turismo Tacna Internacional
            ['bus_id' => 16, 'price' => 150.00, 'destination_id' => 6], // Turismo y Transportes Costa Mar
            ['bus_id' => 17, 'price' => 150.00, 'destination_id' => 6], // Transportes Argo

            // Arequipa
            ['bus_id' => 18, 'price' => 80.00, 'destination_id' => 7], // Andoriña Tours
            ['bus_id' => 19, 'price' => 100.00, 'destination_id' => 7], // Guardianes Del Cosmos
            ['bus_id' => 20, 'price' => 80.00, 'destination_id' => 7], // Wari Palomino
            ['bus_id' => 21, 'price' => 90.00, 'destination_id' => 7], // Transportes Reyna
            ['bus_id' => 22, 'price' => 110.00, 'destination_id' => 7], // Waybus
            ['bus_id' => 23, 'price' => 90.00, 'destination_id' => 7], // Abba Bus

            // Cusco
            ['bus_id' => 24, 'price' => 100.00, 'destination_id' => 8], // Paredes Estrella VIP
            ['bus_id' => 25, 'price' => 110.00, 'destination_id' => 8], // Turismo Molina
            ['bus_id' => 26, 'price' => 90.00, 'destination_id' => 8], // Transportes Imperial Cusco

            // Puno
            ['bus_id' => 27, 'price' => 140.00, 'destination_id' => 9], // Guardianes Del Cosmos
        ];

        foreach ($tarifas as $tarifa) {
            Fare::create($tarifa);
        }
    }
}
