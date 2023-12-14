<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;
use App\Models\Practice\Person;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Person::factory(10)->create();

        //PROJECT UX
        //$this->call(ActivitiesTableSeeder::class);

        //END PROJECT UX

        // Eliminar contenido de las carpetas app y public en storage
        File::deleteDirectory(storage_path('app'));
        // Eliminar el enlace simbólico en la carpeta public
        File::delete(public_path('storage'));

        // Volver a generar el enlace simbólico
        Artisan::call('storage:link');
        // \App\Models\User::factory(10)->create();

        // \App\Models\Role::factory(4)->create();
        \App\Models\Role::create([
            'name' => 'compras',
            'description' => 'Usuario del departamento de compras, encargado(a) de recibir y validar las solicitudes generadas por los proveedores.',
        ]);

        \App\Models\Role::create([
            'name' => 'contabilidad',
            'description' => 'Usuario del departamento de contabilidad, encargado(a) de aprobar o rechazar las solicitudes generadas por los proveedores.',
        ]);

        \App\Models\Role::create([
            'name' => 'proveedor',
            'description' => 'Usuario proveedor, representa a un proveedor registrado en la aplicación con acceso a las solicitudes que este genere, así como visualizar el seguimiento de sus solicitudes.',
        ]);

        \App\Models\Role::create([
            'name' => 'invitado',
            'description' => 'Usuario con permisos muy limitados. Este tipo de rol ha sido considerado para nuevas funcionalidades a futuro.',
        ]);

        \App\Models\Role::create([
            'name' => 'admin',
            'description' => 'Usuario con todos los permisos.',
        ]);
        // \App\Models\User::factory(2)->create();
        \App\Models\User::create([
                'name' => 'Joseph Castillo',
                'email' => 'admin@admin.com',
                'password' => bcrypt('1234'),
                'id_role' => 5,
            ]);
        $comprasRole = \App\Models\Role::where('name', 'compras')->first();
        $contabilidadRole = \App\Models\Role::where('name', 'contabilidad')->first();
        \App\Models\User::create([
            'name' => 'Yannina Chavez',
            'email' => 'compras@example.com',
            'password' => bcrypt('1234'),
            'id_role' => $comprasRole->id,
        ]);

        \App\Models\User::create([
            'name' => 'Arturo Salas',
            'email' => 'contabilidad@example.com',
            'password' => bcrypt('1234'),
            'id_role' => $contabilidadRole->id,
        ]);


        //\App\Models\Supplier::factory(5)->create();
        \App\Models\StateRequest::factory(9)->create();
        // \App\Models\TypePayment::factory(2)->create();
        \App\Models\TypePayment::create([
            'name' => 'Factura a 30 dias',
            'description' => 'Factura con un plazo de pago de 30 días. El pago debe realizarse dentro de los 30 días a partir de la fecha de emisión.'
        ]);
        \App\Models\TypePayment::create([
            'name' => 'Factura a 60 dias',
            'description' => 'Factura con un plazo de pago extendido de 60 días. El pago debe realizarse dentro de los 60 días a partir de la fecha de emisión.'
        ]);
        \App\Models\TypePayment::create([
            'name' => 'Factura a 90 dias',
            'description' => 'Factura con un plazo de pago extendido de 90 días. El pago debe realizarse dentro de los 90 días a partir de la fecha de emisión.'
        ]);
        // \App\Models\MethodPayment::factory(2)->create();
        \App\Models\MethodPayment::create([
            'name' => 'Transferencia Bancaria',
            'description' => 'Método de pago que implica la transferencia electrónica de fondos desde la cuenta del pagador a la cuenta del beneficiario. La transferencia bancaria se realiza a través de servicios bancarios en línea o en la sucursal bancaria.'
        ]);
        \App\Models\MethodPayment::create([
            'name' => 'Letras',
            'description' => 'Método de pago que involucra la emisión y aceptación de letras de cambio entre las partes comerciales. Una letra de cambio es un instrumento financiero que establece el compromiso de un pagador de realizar un pago específico en una fecha futura determinada a un beneficiario.'
        ]);
        // \App\Models\Document::factory(10)->create();
        // Array de preguntas
        $questions = [
            'Cuenta con vinculación familiar y/o amical con algún trabajador de Iberoplast?',
            'Cuenta con RUC activo y condición de habido?',
            'Cuenta con representantes legales actualizados en el RUC?',
            'Cuenta con un programa de Gestión de Seguridad en el marco de las certificaciones OEA, BASC y/o ISO 28000?',
            'Cumple con las declaraciones anuales de Impuesto a la Renta de tercera categoría?',
            'Está al día con los pagos y aportes tributarios a la SUNAT?',
            'Carece de pérdidas durante los tres (3) años consecutivos en los últimos cuatro (4) años calendario?',
            'Está libre de procedimiento concursal de restauración patrimonial, quiebra o liquidación?',
            'Cuenta con política de prevención de fraude fiscal y/o lavado de activos?',
            'Cuenta con una política de calidad?',
            'Cuenta con una política de inocuidad?',
            'La empresa cuenta con un programa de auditoría interna de calidad o inocuidad?',
            'Cuentan con Código de Ética y conducta?',
            'Cuenta con políticas del cuidado del medio ambiente?',
            'Cuenta dentro de su organigrama con alguna persona expuesta políticamente (PEP)?'
        ];

        // Crear preguntas en la base de datos
        foreach ($questions as $question) {
            \App\Models\Question::create(['question' => $question]);
        }

        // \App\Models\Observation::factory(5)->create();

        \App\Models\Policy::create([
            'title' => 'Política de Proveedores'
        ]);

        \App\Models\Policy::create([
            'title' => 'Política de Protección de Datos'
        ]);

       // Crear 10 registros de SupplierRequest
        // $supplierRequests = \App\Models\SupplierRequest::factory(50)->create();

        // $supplierRequests->each(function ($supplierRequest) {
        //     // Asignar preguntas aleatorias
        //     $questions = \App\Models\Question::inRandomOrder()->limit(5)->get();
        //     $supplierRequest->questions()->attach($questions, ['response' => rand(0, 1)]);

        //     // Asignar documentos aleatorios
        //     $documents = \App\Models\Document::inRandomOrder()->limit(3)->get();
        //     $supplierRequest->documents()->attach($documents);

        //     // Asignar políticas aleatorias
        //     $policies = \App\Models\Policy::inRandomOrder()->get();
        //     $supplierRequest->policies()->attach($policies, ['accepted' => (bool) rand(0, 1)]);

        //     // Asignar observaciones aleatorias
        //     $observations = \App\Models\Observation::inRandomOrder()->limit(2)->get();
        //     $supplierRequest->observations()->attach($observations);

        //     // Asignar transiciones de estados aleatorias
        //     $enviadoState = \App\Models\StateRequest::where('name', 'Enviado')->first();
        //     $transitions = \App\Models\StateRequest::inRandomOrder()->limit(2)->get();
        //     $reviewers = \App\Models\User::inRandomOrder()->limit(2)->get();

        //     $fromState = null;

        //     foreach ($transitions as $key => $transition) {
        //         $reviewer = $reviewers[$key];

        //         $transitionData = [
        //             'from_state_id' => 1,
        //             'to_state_id' => $transition->id,
        //             'id_supplier_request' => $supplierRequest->id,
        //             'id_reviewer' => $reviewer->id,
        //         ];

        //         $supplierRequest->stateTransitions()->attach($transition, $transitionData);

        //         // Actualizar el estado de origen para la próxima transición
        //         $fromState = $transition;
        //     }
        // });

        // \App\Models\User::factory()
        //     ->count(2)
        //     ->create([
        //         'id_role' => 2,
        //         'password' => bcrypt('1234'),
        // ]);


        DB::statement("INSERT INTO `countries` (`id`, `name`, `iso_alpha2`, `flag`) VALUES
(1, 'Afghanistan', 'AF', '/flags/AF.png'),
(2, 'Albania', 'AL', '/flags/AL.png'),
(3, 'Algeria', 'DZ', '/flags/DZ.png'),
(4, 'American Samoa', 'AS', '/flags/AS.png'),
(5, 'Andorra', 'AD', '/flags/AD.png'),
(6, 'Angola', 'AO',  '/flags/AO.png'),
(7, 'Anguilla', 'AI', '/flags/AI.png'),
(8, 'Antarctica', 'AQ', '/flags/AQ.png'),
(9, 'Antigua and Barbuda', 'AG', '/flags/AG.png'),
(10, 'Argentina', 'AR', '/flags/AR.png'),
(11, 'Armenia', 'AM', '/flags/AM.png'),
(12, 'Aruba', 'AW', '/flags/AW.png'),
(13, 'Australia', 'AU','/flags/AU.png'),
(14, 'Austria', 'AT', '/flags/AT.png'),
(15, 'Azerbaijan', 'AZ', '/flags/AZ.png'),
(16, 'Bahamas', 'BS','/flags/BS.png'),
(17, 'Bahrain', 'BH','/flags/BH.png'),
(18, 'Bangladesh', 'BD', '/flags/BD.png'),
(19, 'Barbados', 'BB', '/flags/BB.png'),
(20, 'Belarus', 'BY','/flags/BY.png'),
(21, 'Belgium', 'BE', '/flags/BE.png'),
(22, 'Belize', 'BZ','/flags/BZ.png'),
(23, 'Benin', 'BJ','/flags/BJ.png'),
(24, 'Bermuda', 'BM','/flags/BM.png'),
(25, 'Bhutan', 'BT', '/flags/BT.png'),
(26, 'Bolivia', 'BO','/flags/BO.png'),
(27, 'Bosnia and Herzegovina', 'BA', '/flags/BA.png'),
(28, 'Botswana', 'BW', '/flags/BW.png'),
(29, 'Bouvet Island', 'BV','/flags/BV.png'),
(30, 'Brazil', 'BR','/flags/BR.png'),
(31, 'British Indian Ocean Territory', 'IO','/flags/IO.png'),
(32, 'British Virgin Islands', 'VG', '/flags/VG.png'),
(33, 'Brunei', 'BN', '/flags/BN.png'),
(34, 'Bulgaria', 'BG', '/flags/BG.png'),
(35, 'Burkina Faso', 'BF', '/flags/BF.png'),
(36, 'Burundi', 'BI', '/flags/BI.png'),
(37, 'Cambodia', 'KH', '/flags/KH.png'),
(38, 'Cameroon', 'CM', '/flags/CM.png'),
(39, 'Canada', 'CA', '/flags/CA.png'),
(40, 'Cape Verde', 'CV', '/flags/CV.png'),
(41, 'Cayman Islands', 'KY', '/flags/KY.png'),
(42, 'Central African Republic', 'CF', '/flags/CF.png'),
(43, 'Chad', 'TD', '/flags/TD.png'),
(44, 'Chile', 'CL', '/flags/CL.png'),
(45, 'China', 'CN', '/flags/CN.png'),
(46, 'Christmas Island', 'CX', '/flags/CX.png'),
(47, 'Cocos Islands', 'CC', '/flags/CC.png'),
(48, 'Colombia', 'CO', '/flags/CO.png'),
(49, 'Comoros', 'KM', '/flags/KM.png'),
(50, 'Cook Islands', 'CK','/flags/CK.png'),
(51, 'Costa Rica', 'CR', '/flags/CR.png'),
(52, 'Croatia', 'HR', '/flags/HR.png'),
(53, 'Cuba', 'CU', '/flags/CU.png'),
(54, 'Cyprus', 'CY', '/flags/CY.png'),
(55, 'Czech Republic', 'CZ', '/flags/CZ.png'),
(56, 'Democratic Republic of the Congo', 'CD', '/flags/CD.png'),
(57, 'Denmark', 'DK', '/flags/DK.png'),
(58, 'Djibouti', 'DJ', '/flags/DJ.png'),
(59, 'Dominica', 'DM', '/flags/DM.png'),
(60, 'Dominican Republic', 'DO','/flags/DO.png'),
(61, 'East Timor', 'TL','/flags/TL.png'),
(62, 'Ecuador', 'EC', '/flags/EC.png'),
(63, 'Egypt', 'EG','/flags/EG.png'),
(64, 'El Salvador', 'SV', '/flags/SV.png'),
(65, 'Equatorial Guinea', 'GQ', '/flags/GQ.png'),
(66, 'Eritrea', 'ER', '/flags/ER.png'),
(67, 'Estonia', 'EE', '/flags/EE.png'),
(68, 'Ethiopia', 'ET', '/flags/ET.png'),
(69, 'Falkland Islands', 'FK','/flags/FK.png'),
(70, 'Faroe Islands', 'FO', '/flags/FO.png'),
(71, 'Fiji', 'FJ', '/flags/FJ.png'),
(72, 'Finland', 'FI', '/flags/FI.png'),
(73, 'France', 'FR', '/flags/FR.png'),
(74, 'French Guiana', 'GF','/flags/GF.png'),
(75, 'French Polynesia', 'PF', '/flags/PF.png'),
(76, 'French Southern Territories', 'TF', '/flags/TF.png'),
(77, 'Gabon', 'GA', '/flags/GA.png'),
(78, 'Gambia', 'GM', '/flags/GM.png'),
(79, 'Georgia', 'GE', '/flags/GE.png'),
(80, 'Germany', 'DE', '/flags/DE.png'),
(81, 'Ghana', 'GH', '/flags/GH.png'),
(82, 'Gibraltar', 'GI', '/flags/GI.png'),
(83, 'Greece', 'GR', '/flags/GR.png'),
(84, 'Greenland', 'GL', '/flags/GL.png'),
(85, 'Grenada', 'GD', '/flags/GD.png'),
(86, 'Guadeloupe', 'GP', '/flags/GP.png'),
(87, 'Guam', 'GU', '/flags/GU.png'),
(88, 'Guatemala', 'GT', '/flags/GT.png'),
(89, 'Guinea', 'GN', '/flags/GN.png'),
(90, 'Guinea-Bissau', 'GW', '/flags/GW.png'),
(91, 'Guyana', 'GY', '/flags/GY.png'),
(92, 'Haiti', 'HT', '/flags/HT.png'),
(93, 'Heard Island and McDonald Islands', 'HM', '/flags/HM.png'),
(94, 'Honduras', 'HN', '/flags/HN.png'),
(95, 'Hong Kong', 'HK', '/flags/HK.png'),
(96, 'Hungary', 'HU', '/flags/HU.png'),
(97, 'Iceland', 'IS', '/flags/IS.png'),
(98, 'India', 'IN', '/flags/IN.png'),
(99, 'Indonesia', 'ID', '/flags/ID.png'),
(100, 'Iran', 'IR', '/flags/IR.png'),
(101, 'Iraq', 'IQ', '/flags/IQ.png'),
(102, 'Ireland', 'IE', '/flags/IE.png'),
(103, 'Israel', 'IL', '/flags/IL.png'),
(104, 'Italy', 'IT', '/flags/IT.png'),
(105, 'Ivory Coast', 'CI', '/flags/CI.png'),
(106, 'Jamaica', 'JM', '/flags/JM.png'),
(107, 'Japan', 'JP', '/flags/JP.png'),
(108, 'Jordan', 'JO', '/flags/JO.png'),
(109, 'Kazakhstan', 'KZ', '/flags/KZ.png'),
(110, 'Kenya', 'KE','/flags/KE.png'),
(111, 'Kiribati', 'KI', '/flags/KI.png'),
(112, 'Kuwait', 'KW', '/flags/KW.png'),
(113, 'Kyrgyzstan', 'KG', '/flags/KG.png'),
(114, 'Laos', 'LA', '/flags/LA.png'),
(115, 'Latvia', 'LV', '/flags/LV.png'),
(116, 'Lebanon', 'LB', '/flags/LB.png'),
(117, 'Lesotho', 'LS', '/flags/LS.png'),
(118, 'Liberia', 'LR', '/flags/LR.png'),
(119, 'Libya', 'LY', '/flags/LY.png'),
(120, 'Liechtenstein', 'LI', '/flags/LI.png'),
(121, 'Lithuania', 'LT', '/flags/LT.png'),
(122, 'Luxembourg', 'LU', '/flags/LU.png'),
(123, 'Macao', 'MO', '/flags/MO.png'),
(124, 'Macedonia', 'MK', '/flags/MK.png'),
(125, 'Madagascar', 'MG', '/flags/MG.png'),
(126, 'Malawi', 'MW', '/flags/MW.png'),
(127, 'Malaysia', 'MY', '/flags/MY.png'),
(128, 'Maldives', 'MV', '/flags/MV.png'),
(129, 'Mali', 'ML', '/flags/ML.png'),
(130, 'Malta', 'MT', '/flags/MT.png'),
(131, 'Marshall Islands', 'MH', '/flags/MH.png'),
(132, 'Martinique', 'MQ', '/flags/MQ.png'),
(133, 'Mauritania', 'MR', '/flags/MR.png'),
(134, 'Mauritius', 'MU', '/flags/MU.png'),
(135, 'Mayotte', 'YT', '/flags/YT.png'),
(136, 'Mexico', 'MX', '/flags/MX.png'),
(137, 'Micronesia', 'FM', '/flags/FM.png'),
(138, 'Moldova', 'MD', '/flags/MD.png'),
(139, 'Monaco', 'MC', '/flags/MC.png'),
(140, 'Mongolia', 'MN', '/flags/MN.png'),
(141, 'Montserrat', 'MS', '/flags/MS.png'),
(142, 'Morocco', 'MA', '/flags/MA.png'),
(143, 'Mozambique', 'MZ', '/flags/MZ.png'),
(144, 'Myanmar', 'MM', '/flags/MM.png'),
(145, 'Namibia', 'NA', '/flags/NA.png'),
(146, 'Nauru', 'NR', '/flags/NR.png'),
(147, 'Nepal', 'NP', '/flags/NP.png'),
(148, 'Netherlands', 'NL', '/flags/NL.png'),
(149, 'Netherlands Antilles', 'AN', '/flags/AN.png'),
(150, 'New Caledonia', 'NC', '/flags/NC.png'),
(151, 'New Zealand', 'NZ', '/flags/NZ.png'),
(152, 'Nicaragua', 'NI', '/flags/NI.png'),
(153, 'Niger', 'NE', '/flags/NE.png'),
(154, 'Nigeria', 'NG', '/flags/NG.png'),
(155, 'Niue', 'NU', '/flags/NU.png'),
(156, 'Norfolk Island', 'NF', '/flags/NF.png'),
(157, 'North Korea', 'KP', '/flags/KP.png'),
(158, 'Northern Mariana Islands', 'MP', '/flags/MP.png'),
(159, 'Norway', 'NO', '/flags/NO.png'),
(160, 'Oman', 'OM', '/flags/OM.png'),
(161, 'Pakistan', 'PK', '/flags/PK.png'),
(162, 'Palau', 'PW', '/flags/PW.png'),
(163, 'Palestinian Territory', 'PS', '/flags/PS.png'),
(164, 'Panama', 'PA', '/flags/PA.png'),
(165, 'Papua New Guinea', 'PG', '/flags/PG.png'),
(166, 'Paraguay', 'PY', '/flags/PY.png'),
(167, 'Perú', 'PE', '/flags/PE.png'),
(168, 'Philippines', 'PH', '/flags/PH.png'),
(169, 'Pitcairn', 'PN', '/flags/PN.png'),
(170, 'Poland', 'PL','/flags/PL.png'),
(171, 'Portugal', 'PT', '/flags/PT.png'),
(172, 'Puerto Rico', 'PR', '/flags/PR.png'),
(173, 'Qatar', 'QA', '/flags/QA.png'),
(174, 'Republic of the Congo', 'CG', '/flags/CG.png'),
(175, 'Reunion', 'RE', '/flags/RE.png'),
(176, 'Romania', 'RO', '/flags/RO.png'),
(177, 'Russia', 'RU', '/flags/RU.png'),
(178, 'Rwanda', 'RW', '/flags/RW.png'),
(179, 'Saint Helena', 'SH', '/flags/SH.png'),
(180, 'Saint Kitts and Nevis', 'KN', '/flags/KN.png'),
(181, 'Saint Lucia', 'LC', '/flags/LC.png'),
(182, 'Saint Pierre and Miquelon', 'PM', '/flags/PM.png'),
(183, 'Saint Vincent and the Grenadines', 'VC', '/flags/VC.png'),
(184, 'Samoa', 'WS', '/flags/WS.png'),
(185, 'San Marino', 'SM', '/flags/SM.png'),
(186, 'Sao Tome and Principe', 'ST', '/flags/ST.png'),
(187, 'Saudi Arabia', 'SA', '/flags/SA.png'),
(188, 'Senegal', 'SN', '/flags/SN.png'),
(189, 'Serbia and Montenegro', 'CS', '/flags/CS.png'),
(190, 'Seychelles', 'SC', '/flags/SC.png'),
(191, 'Sierra Leone', 'SL', '/flags/SL.png'),
(192, 'Singapore', 'SG', '/flags/SG.png'),
(193, 'Slovakia', 'SK', '/flags/SK.png'),
(194, 'Slovenia', 'SI', '/flags/SI.png'),
(195, 'Solomon Islands', 'SB', '/flags/SB.png'),
(196, 'Somalia', 'SO', '/flags/SO.png'),
(197, 'South Africa', 'ZA', '/flags/ZA.png'),
(198, 'South Georgia and the South Sandwich Islands', 'GS', '/flags/GS.png'),
(199, 'South Korea', 'KR', '/flags/KR.png'),
(200, 'Spain', 'ES', '/flags/ES.png'),
(201, 'Sri Lanka', 'LK', '/flags/LK.png'),
(202, 'Sudan', 'SD', '/flags/SD.png'),
(203, 'Suriname', 'SR', '/flags/SR.png'),
(204, 'Svalbard and Jan Mayen', 'SJ', '/flags/SJ.png'),
(205, 'Swaziland', 'SZ', '/flags/SZ.png'),
(206, 'Sweden', 'SE', '/flags/SE.png'),
(207, 'Switzerland', 'CH', '/flags/CH.png'),
(208, 'Syria', 'SY', '/flags/SY.png'),
(209, 'Taiwan', 'TW', '/flags/TW.png'),
(210, 'Tajikistan', 'TJ', '/flags/TJ.png'),
(211, 'Tanzania', 'TZ', '/flags/TZ.png'),
(212, 'Thailand', 'TH', '/flags/TH.png'),
(213, 'Togo', 'TG', '/flags/TG.png'),
(214, 'Tokelau', 'TK', '/flags/TK.png'),
(215, 'Tonga', 'TO', '/flags/TO.png'),
(216, 'Trinidad and Tobago', 'TT', '/flags/TT.png'),
(217, 'Tunisia', 'TN', '/flags/TN.png'),
(218, 'Turkey', 'TR', '/flags/TR.png'),
(219, 'Turkmenistan', 'TM','/flags/TM.png'),
(220, 'Turks and Caicos Islands', 'TC', '/flags/TC.png'),
(221, 'Tuvalu', 'TV', '/flags/TV.png'),
(222, 'U.S. Virgin Islands', 'VI', '/flags/VI.png'),
(223, 'Uganda', 'UG', '/flags/UG.png'),
(224, 'Ukraine', 'UA', '/flags/UA.png'),
(225, 'United Arab Emirates', 'AE', '/flags/AE.png'),
(226, 'United Kingdom', 'GB', '/flags/GB.png'),
(227, 'United States', 'US', '/flags/US.png'),
(228, 'United States Minor Outlying Islands', 'UM', '/flags/UM.png'),
(229, 'Uruguay', 'UY', '/flags/UY.png'),
(230, 'Uzbekistan', 'UZ', '/flags/UZ.png'),
(231, 'Vanuatu', 'VU', '/flags/VU.png'),
(232, 'Vatican', 'VA', '/flags/VA.png'),
(233, 'Venezuela', 'VE','/flags/VE.png'),
(234, 'Vietnam', 'VN', '/flags/VN.png'),
(235, 'Wallis and Futuna', 'WF', '/flags/WF.png'),
(236, 'Western Sahara', 'EH', '/flags/EH.png'),
(237, 'Yemen', 'YE', '/flags/YE.png'),
(238, 'Zambia', 'ZM', '/flags/ZM.png'),
(239, 'Zimbabwe', 'ZW', '/flags/ZW.png');
        ");
    }
}
