<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

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
                'name' => 'admin',
                'description' => 'Usuario con todos los permisos',
            ]);
        \App\Models\User::factory(2)->create();
        \App\Models\User::create([
                'name' => 'Alexis',
                'email' => 'admin@admin.com',
                'password' => bcrypt('123'),
                'id_role' => 5,
            ]);
        $comprasRole = \App\Models\Role::where('name', 'compras')->first();
        $contabilidadRole = \App\Models\Role::where('name', 'contabilidad')->first();
        \App\Models\User::create([
            'name' => 'Compras',
            'email' => 'compras@example.com',
            'password' => bcrypt('1234'),
            'id_role' => $comprasRole->id,
        ]);

        \App\Models\User::create([
            'name' => 'Contador',
            'email' => 'contabilidad@example.com',
            'password' => bcrypt('1234'),
            'id_role' => $contabilidadRole->id,
        ]);


        //\App\Models\Supplier::factory(5)->create();
        \App\Models\StateRequest::factory(9)->create();
        \App\Models\TypePayment::factory(2)->create();
        \App\Models\MethodPayment::factory(2)->create();
        \App\Models\Document::factory(10)->create();
        \App\Models\Question::factory(6)->create();
        \App\Models\Observation::factory(5)->create();

        \App\Models\Policy::create([
                'title' => 'Politica de proveedores',
                'content' => 'Document - policy suppliers',
            ]);

        \App\Models\Policy::create([
                'title' => 'Politica de proteccion de datos',
                'content' => 'Document - policy data protection',
            ]);


       // Crear 10 registros de SupplierRequest
        $supplierRequests = \App\Models\SupplierRequest::factory(5)->create();

        $supplierRequests->each(function ($supplierRequest) {
            // Asignar preguntas aleatorias
            $questions = \App\Models\Question::inRandomOrder()->limit(5)->get();
            $supplierRequest->questions()->attach($questions, ['response' => rand(0, 1)]);

            // Asignar documentos aleatorios
            $documents = \App\Models\Document::inRandomOrder()->limit(3)->get();
            $supplierRequest->documents()->attach($documents);

            // Asignar políticas aleatorias
            $policies = \App\Models\Policy::inRandomOrder()->get();
            $supplierRequest->policies()->attach($policies, ['accepted' => (bool) rand(0, 1)]);

            // Asignar observaciones aleatorias
            $observations = \App\Models\Observation::inRandomOrder()->limit(2)->get();
            $supplierRequest->observations()->attach($observations);

            // Asignar transiciones de estados aleatorias
            $enviadoState = \App\Models\StateRequest::where('name', 'Enviado')->first();
            $transitions = \App\Models\StateRequest::inRandomOrder()->limit(2)->get();
            $reviewers = \App\Models\User::inRandomOrder()->limit(2)->get();

            $fromState = null;

            foreach ($transitions as $key => $transition) {
                $reviewer = $reviewers[$key];

                $transitionData = [
                    'from_state_id' => 1,
                    'to_state_id' => $transition->id,
                    'id_supplier_request' => $supplierRequest->id,
                    'id_reviewer' => $reviewer->id,
                ];

                $supplierRequest->stateTransitions()->attach($transition, $transitionData);

                // Actualizar el estado de origen para la próxima transición
                $fromState = $transition;
            }
        });

        \App\Models\User::factory()
            ->count(2)
            ->create([
                'id_role' => 2,
                'password' => bcrypt('1234'),
        ]);


        DB::statement("INSERT INTO `countries` (`id`, `name`) VALUES
        (1, 'Australia'),
        (2, 'Austria'),
        (3, 'Azerbaiyán'),
        (4, 'Anguilla'),
        (5, 'Argentina'),
        (6, 'Armenia'),
        (7, 'Bielorrusia'),
        (8, 'Belice'),
        (9, 'Bélgica'),
        (10, 'Bermudas'),
        (11, 'Bulgaria'),
        (12, 'Brasil'),
        (13, 'Reino Unido'),
        (14, 'Hungría'),
        (15, 'Vietnam'),
        (16, 'Haiti'),
        (17, 'Guadalupe'),
        (18, 'Alemania'),
        (19, 'Países Bajos, Holanda'),
        (20, 'Grecia'),
        (21, 'Georgia'),
        (22, 'Dinamarca'),
        (23, 'Egipto'),
        (24, 'Israel'),
        (25, 'India'),
        (26, 'Irán'),
        (27, 'Irlanda'),
        (28, 'España'),
        (29, 'Italia'),
        (30, 'Kazajstán'),
        (31, 'Camerún'),
        (32, 'Canadá'),
        (33, 'Chipre'),
        (34, 'Kirguistán'),
        (35, 'China'),
        (36, 'Costa Rica'),
        (37, 'Kuwait'),
        (38, 'Letonia'),
        (39, 'Libia'),
        (40, 'Lituania'),
        (41, 'Luxemburgo'),
        (42, 'México'),
        (43, 'Moldavia'),
        (44, 'Mónaco'),
        (45, 'Nueva Zelanda'),
        (46, 'Noruega'),
        (47, 'Polonia'),
        (48, 'Portugal'),
        (49, 'Reunión'),
        (50, 'Rusia'),
        (51, 'El Salvador'),
        (52, 'Eslovaquia'),
        (53, 'Eslovenia'),
        (54, 'Surinam'),
        (55, 'Estados Unidos'),
        (56, 'Tadjikistan'),
        (57, 'Turkmenistan'),
        (58, 'Islas Turcas y Caicos'),
        (59, 'Turquía'),
        (60, 'Uganda'),
        (61, 'Uzbekistán'),
        (62, 'Ucrania'),
        (63, 'Finlandia'),
        (64, 'Francia'),
        (65, 'República Checa'),
        (66, 'Suiza'),
        (67, 'Suecia'),
        (68, 'Estonia'),
        (69, 'Corea del Sur'),
        (70, 'Japón'),
        (71, 'Croacia'),
        (72, 'Rumanía'),
        (73, 'Hong Kong'),
        (74, 'Indonesia'),
        (75, 'Jordania'),
        (76, 'Malasia'),
        (77, 'Singapur'),
        (78, 'Taiwan'),
        (79, 'Bosnia y Herzegovina'),
        (80, 'Bahamas'),
        (81, 'Chile'),
        (82, 'Colombia'),
        (83, 'Islandia'),
        (84, 'Corea del Norte'),
        (85, 'Macedonia'),
        (86, 'Malta'),
        (87, 'Pakistán'),
        (88, 'Papúa-Nueva Guinea'),
        (89, 'Perú'),
        (90, 'Filipinas'),
        (91, 'Arabia Saudita'),
        (92, 'Tailandia'),
        (93, 'Emiratos árabes Unidos'),
        (94, 'Groenlandia'),
        (95, 'Venezuela'),
        (96, 'Zimbabwe'),
        (97, 'Kenia'),
        (98, 'Algeria'),
        (99, 'Líbano'),
        (100, 'Botsuana'),
        (101, 'Tanzania'),
        (102, 'Namibia'),
        (103, 'Ecuador'),
        (104, 'Marruecos'),
        (105, 'Ghana'),
        (106, 'Siria'),
        (107, 'Nepal'),
        (108, 'Mauritania'),
        (109, 'Seychelles'),
        (110, 'Paraguay'),
        (111, 'Uruguay'),
        (112, 'Congo (Brazzaville)'),
        (113, 'Cuba'),
        (114, 'Albania'),
        (115, 'Nigeria'),
        (116, 'Zambia'),
        (117, 'Mozambique'),
        (119, 'Angola'),
        (120, 'Sri Lanka'),
        (121, 'Etiopía'),
        (122, 'Túnez'),
        (123, 'Bolivia'),
        (124, 'Panamá'),
        (125, 'Malawi'),
        (126, 'Liechtenstein'),
        (127, 'Bahrein'),
        (128, 'Barbados'),
        (130, 'Chad'),
        (131, 'Man, Isla de'),
        (132, 'Jamaica'),
        (133, 'Malí'),
        (134, 'Madagascar'),
        (135, 'Senegal'),
        (136, 'Togo'),
        (137, 'Honduras'),
        (138, 'República Dominicana'),
        (139, 'Mongolia'),
        (140, 'Irak'),
        (141, 'Sudáfrica'),
        (142, 'Aruba'),
        (143, 'Gibraltar'),
        (144, 'Afganistán'),
        (145, 'Andorra'),
        (147, 'Antigua y Barbuda'),
        (149, 'Bangladesh'),
        (151, 'Benín'),
        (152, 'Bután'),
        (154, 'Islas Virgenes Británicas'),
        (155, 'Brunéi'),
        (156, 'Burkina Faso'),
        (157, 'Burundi'),
        (158, 'Camboya'),
        (159, 'Cabo Verde'),
        (164, 'Comores'),
        (165, 'Congo (Kinshasa)'),
        (166, 'Cook, Islas'),
        (168, 'Costa de Marfil'),
        (169, 'Djibouti, Yibuti'),
        (171, 'Timor Oriental'),
        (172, 'Guinea Ecuatorial'),
        (173, 'Eritrea'),
        (175, 'Feroe, Islas'),
        (176, 'Fiyi'),
        (178, 'Polinesia Francesa'),
        (180, 'Gabón'),
        (181, 'Gambia'),
        (184, 'Granada'),
        (185, 'Guatemala'),
        (186, 'Guernsey'),
        (187, 'Guinea'),
        (188, 'Guinea-Bissau'),
        (189, 'Guyana'),
        (193, 'Jersey'),
        (195, 'Kiribati'),
        (196, 'Laos'),
        (197, 'Lesotho'),
        (198, 'Liberia'),
        (200, 'Maldivas'),
        (201, 'Martinica'),
        (202, 'Mauricio'),
        (205, 'Myanmar'),
        (206, 'Nauru'),
        (207, 'Antillas Holandesas'),
        (208, 'Nueva Caledonia'),
        (209, 'Nicaragua'),
        (210, 'Níger'),
        (212, 'Norfolk Island'),
        (213, 'Omán'),
        (215, 'Isla Pitcairn'),
        (216, 'Qatar'),
        (217, 'Ruanda'),
        (218, 'Santa Elena'),
        (219, 'San Cristobal y Nevis'),
        (220, 'Santa Lucía'),
        (221, 'San Pedro y Miquelón'),
        (222, 'San Vincente y Granadinas'),
        (223, 'Samoa'),
        (224, 'San Marino'),
        (225, 'San Tomé y Príncipe'),
        (226, 'Serbia y Montenegro'),
        (227, 'Sierra Leona'),
        (228, 'Islas Salomón'),
        (229, 'Somalia'),
        (232, 'Sudán'),
        (234, 'Swazilandia'),
        (235, 'Tokelau'),
        (236, 'Tonga'),
        (237, 'Trinidad y Tobago'),
        (239, 'Tuvalu'),
        (240, 'Vanuatu'),
        (241, 'Wallis y Futuna'),
        (242, 'Sáhara Occidental'),
        (243, 'Yemen'),
        (246, 'Puerto Rico');
        ");
    }
}
