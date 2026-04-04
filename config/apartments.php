<?php

/*
|--------------------------------------------------------------------------
| Configurare apartamente — MTZ Nord Residence
|--------------------------------------------------------------------------
| Phase 1: date hardcodate. Structura este identică cu ce va returna
| API-ul / DB-ul în Phase 2. La migrarea spre DB, înlocuiești doar
| sursa de date din controller — Blade-ul rămâne intact.
|
| Status posibile: 'available' | 'sold' | 'rented'
| Price: null = "La cerere"
|
*/

return [

    /*
    |----------------------------------------------------------------------
    | Metadate imobil
    |----------------------------------------------------------------------
    */
    'building' => [
        'name'          => 'MTZ Nord Residence',
        'floors_total'  => 5,
        'location'      => 'Mangalia, județul Constanța',
        'year'          => 2026,
        'whatsapp'      => '40700000000',
        'phone'         => '+40 700 000 000',
        'email'         => 'contact@mtznordresidence.ro',
        'address'       => 'Mangalia, județul Constanța',
    ],

    /*
    |----------------------------------------------------------------------
    | Dotări standard incluse în toate apartamentele
    |----------------------------------------------------------------------
    */
    'amenities' => [
        'ac'         => ['icon' => 'ac_unit',        'label' => 'Aer condiționat'],
        'heating'    => ['icon' => 'heat_pump',      'label' => 'Încălzire centralizată'],
        'pvc'        => ['icon' => 'door_sliding',   'label' => 'Tâmplărie PVC triplu strat'],
        'intercom'   => ['icon' => 'videocam',       'label' => 'Videointerfon'],
        'elevator'   => ['icon' => 'elevator',       'label' => 'Lift'],
        'parking'    => ['icon' => 'local_parking',  'label' => 'Parcare inclusă'],
    ],

    /*
    |----------------------------------------------------------------------
    | Apartamente — array complet
    | Câmpuri pregătite pentru Phase 2 (floor_plan_shape, facade_shape)
    |----------------------------------------------------------------------
    */
    'apartments' => [

        // ── ETAJ 1 ──
        [
            'id'               => 1,
            'slug'             => 'ap-1a-etaj-1',
            'label'            => '1A',
            'floor'            => 1,
            'rooms'            => 1,
            'area'             => 42,
            'orientation'      => 'Sud',
            'status'           => 'available',
            'price'            => null,
            'balcony_area'     => 8,
            'amenities'        => ['ac', 'heating', 'pvc', 'intercom', 'elevator', 'parking'],
            'description'      => 'Garsonieră cu living generos, bucătărie deschisă și balcon orientat spre sud. Predare la cheie.',
            'floor_plan_shape' => null, // SVG path — Phase 2
            'facade_shape'     => null, // SVG zone — Phase 2
            'images'           => [],
        ],
        [
            'id'               => 2,
            'slug'             => 'ap-1b-etaj-1',
            'label'            => '1B',
            'floor'            => 1,
            'rooms'            => 2,
            'area'             => 58,
            'orientation'      => 'Sud-Est',
            'status'           => 'sold',
            'price'            => null,
            'balcony_area'     => 12,
            'amenities'        => ['ac', 'heating', 'pvc', 'intercom', 'elevator', 'parking'],
            'description'      => 'Apartament cu 2 camere, orientare sud-est, balcon de 12 mp. Vândut.',
            'floor_plan_shape' => null,
            'facade_shape'     => null,
            'images'           => [],
        ],
        [
            'id'               => 3,
            'slug'             => 'ap-1c-etaj-1',
            'label'            => '1C',
            'floor'            => 1,
            'rooms'            => 3,
            'area'             => 78,
            'orientation'      => 'Nord-Est',
            'status'           => 'available',
            'price'            => null,
            'balcony_area'     => 14,
            'amenities'        => ['ac', 'heating', 'pvc', 'intercom', 'elevator', 'parking'],
            'description'      => 'Apartament cu 3 camere, orientare nord-est, spații generoase. Vedere la ocean.',
            'floor_plan_shape' => null,
            'facade_shape'     => null,
            'images'           => [],
        ],
        [
            'id'               => 4,
            'slug'             => 'ap-1d-etaj-1',
            'label'            => '1D',
            'floor'            => 1,
            'rooms'            => 4,
            'area'             => 105,
            'orientation'      => 'Vest',
            'status'           => 'rented',
            'price'            => null,
            'balcony_area'     => 18,
            'amenities'        => ['ac', 'heating', 'pvc', 'intercom', 'elevator', 'parking'],
            'description'      => 'Apartament cu 4 camere, living dublu, orientare vest. Închiriat.',
            'floor_plan_shape' => null,
            'facade_shape'     => null,
            'images'           => [],
        ],

        // ── ETAJ 2 ──
        [
            'id'               => 5,
            'slug'             => 'ap-2a-etaj-2',
            'label'            => '2A',
            'floor'            => 2,
            'rooms'            => 1,
            'area'             => 42,
            'orientation'      => 'Sud',
            'status'           => 'available',
            'price'            => null,
            'balcony_area'     => 8,
            'amenities'        => ['ac', 'heating', 'pvc', 'intercom', 'elevator', 'parking'],
            'description'      => 'Garsonieră la etaj 2, orientare sud, luminoasă și funcțională.',
            'floor_plan_shape' => null,
            'facade_shape'     => null,
            'images'           => [],
        ],
        [
            'id'               => 6,
            'slug'             => 'ap-2b-etaj-2',
            'label'            => '2B',
            'floor'            => 2,
            'rooms'            => 2,
            'area'             => 58,
            'orientation'      => 'Sud-Est',
            'status'           => 'available',
            'price'            => null,
            'balcony_area'     => 12,
            'amenities'        => ['ac', 'heating', 'pvc', 'intercom', 'elevator', 'parking'],
            'description'      => 'Apartament 2 camere la etaj 2, orientare sud-est.',
            'floor_plan_shape' => null,
            'facade_shape'     => null,
            'images'           => [],
        ],
        [
            'id'               => 7,
            'slug'             => 'ap-2c-etaj-2',
            'label'            => '2C',
            'floor'            => 2,
            'rooms'            => 3,
            'area'             => 78,
            'orientation'      => 'Nord-Est',
            'status'           => 'sold',
            'price'            => null,
            'balcony_area'     => 14,
            'amenities'        => ['ac', 'heating', 'pvc', 'intercom', 'elevator', 'parking'],
            'description'      => 'Apartament 3 camere la etaj 2. Vândut.',
            'floor_plan_shape' => null,
            'facade_shape'     => null,
            'images'           => [],
        ],
        [
            'id'               => 8,
            'slug'             => 'ap-2d-etaj-2',
            'label'            => '2D',
            'floor'            => 2,
            'rooms'            => 4,
            'area'             => 105,
            'orientation'      => 'Vest',
            'status'           => 'available',
            'price'            => null,
            'balcony_area'     => 18,
            'amenities'        => ['ac', 'heating', 'pvc', 'intercom', 'elevator', 'parking'],
            'description'      => 'Apartament 4 camere la etaj 2, living dublu.',
            'floor_plan_shape' => null,
            'facade_shape'     => null,
            'images'           => [],
        ],

        // ── ETAJ 3 ──
        [
            'id'               => 9,
            'slug'             => 'ap-3a-etaj-3',
            'label'            => '3A',
            'floor'            => 3,
            'rooms'            => 1,
            'area'             => 42,
            'orientation'      => 'Sud',
            'status'           => 'available',
            'price'            => null,
            'balcony_area'     => 8,
            'amenities'        => ['ac', 'heating', 'pvc', 'intercom', 'elevator', 'parking'],
            'description'      => 'Garsonieră la etaj 3, confort ridicat, vedere parțial mare.',
            'floor_plan_shape' => null,
            'facade_shape'     => null,
            'images'           => [],
        ],
        [
            'id'               => 10,
            'slug'             => 'ap-3b-etaj-3',
            'label'            => '3B',
            'floor'            => 3,
            'rooms'            => 2,
            'area'             => 58,
            'orientation'      => 'Sud-Est',
            'status'           => 'rented',
            'price'            => null,
            'balcony_area'     => 12,
            'amenities'        => ['ac', 'heating', 'pvc', 'intercom', 'elevator', 'parking'],
            'description'      => 'Apartament 2 camere etaj 3, orientare sud-est. Închiriat.',
            'floor_plan_shape' => null,
            'facade_shape'     => null,
            'images'           => [],
        ],
        [
            'id'               => 11,
            'slug'             => 'ap-3c-etaj-3',
            'label'            => '3C',
            'floor'            => 3,
            'rooms'            => 3,
            'area'             => 78,
            'orientation'      => 'Nord-Est',
            'status'           => 'available',
            'price'            => null,
            'balcony_area'     => 14,
            'amenities'        => ['ac', 'heating', 'pvc', 'intercom', 'elevator', 'parking'],
            'description'      => 'Apartament 3 camere la etaj 3.',
            'floor_plan_shape' => null,
            'facade_shape'     => null,
            'images'           => [],
        ],
        [
            'id'               => 12,
            'slug'             => 'ap-3d-etaj-3',
            'label'            => '3D',
            'floor'            => 3,
            'rooms'            => 4,
            'area'             => 105,
            'orientation'      => 'Vest',
            'status'           => 'available',
            'price'            => null,
            'balcony_area'     => 18,
            'amenities'        => ['ac', 'heating', 'pvc', 'intercom', 'elevator', 'parking'],
            'description'      => 'Apartament 4 camere la etaj 3.',
            'floor_plan_shape' => null,
            'facade_shape'     => null,
            'images'           => [],
        ],

        // ── ETAJ 4 ──
        [
            'id'               => 13,
            'slug'             => 'ap-4a-etaj-4',
            'label'            => '4A',
            'floor'            => 4,
            'rooms'            => 1,
            'area'             => 42,
            'orientation'      => 'Sud',
            'status'           => 'available',
            'price'            => null,
            'balcony_area'     => 8,
            'amenities'        => ['ac', 'heating', 'pvc', 'intercom', 'elevator', 'parking'],
            'description'      => 'Garsonieră la etaj 4, vedere panoramică parțială.',
            'floor_plan_shape' => null,
            'facade_shape'     => null,
            'images'           => [],
        ],
        [
            'id'               => 14,
            'slug'             => 'ap-4b-etaj-4',
            'label'            => '4B',
            'floor'            => 4,
            'rooms'            => 2,
            'area'             => 58,
            'orientation'      => 'Sud-Est',
            'status'           => 'available',
            'price'            => null,
            'balcony_area'     => 12,
            'amenities'        => ['ac', 'heating', 'pvc', 'intercom', 'elevator', 'parking'],
            'description'      => 'Apartament 2 camere la etaj 4.',
            'floor_plan_shape' => null,
            'facade_shape'     => null,
            'images'           => [],
        ],
        [
            'id'               => 15,
            'slug'             => 'ap-4c-etaj-4',
            'label'            => '4C',
            'floor'            => 4,
            'rooms'            => 3,
            'area'             => 78,
            'orientation'      => 'Nord-Est',
            'status'           => 'sold',
            'price'            => null,
            'balcony_area'     => 14,
            'amenities'        => ['ac', 'heating', 'pvc', 'intercom', 'elevator', 'parking'],
            'description'      => 'Apartament 3 camere la etaj 4. Vândut.',
            'floor_plan_shape' => null,
            'facade_shape'     => null,
            'images'           => [],
        ],
        [
            'id'               => 16,
            'slug'             => 'ap-4d-etaj-4',
            'label'            => '4D',
            'floor'            => 4,
            'rooms'            => 4,
            'area'             => 105,
            'orientation'      => 'Vest',
            'status'           => 'available',
            'price'            => null,
            'balcony_area'     => 18,
            'amenities'        => ['ac', 'heating', 'pvc', 'intercom', 'elevator', 'parking'],
            'description'      => 'Apartament 4 camere la etaj 4, la cel mai înalt strat până la penthouse.',
            'floor_plan_shape' => null,
            'facade_shape'     => null,
            'images'           => [],
        ],

        // ── ETAJ 5 (Penthouse) — 2 apartamente mari ──
        [
            'id'               => 17,
            'slug'             => 'penthouse-5a',
            'label'            => '5A',
            'floor'            => 5,
            'rooms'            => 3,
            'area'             => 110,
            'orientation'      => 'Sud + Vest',
            'status'           => 'available',
            'price'            => null,
            'balcony_area'     => 30,
            'amenities'        => ['ac', 'heating', 'pvc', 'intercom', 'elevator', 'parking'],
            'description'      => 'Penthouse cu 3 camere la ultimul etaj. Terasă de 30 mp, vedere panoramică spre mare.',
            'floor_plan_shape' => null,
            'facade_shape'     => null,
            'images'           => [],
        ],
        [
            'id'               => 18,
            'slug'             => 'penthouse-5b',
            'label'            => '5B',
            'floor'            => 5,
            'rooms'            => 4,
            'area'             => 145,
            'orientation'      => 'Est + Nord',
            'status'           => 'available',
            'price'            => null,
            'balcony_area'     => 40,
            'amenities'        => ['ac', 'heating', 'pvc', 'intercom', 'elevator', 'parking'],
            'description'      => 'Penthouse cu 4 camere, terasa dublă de 40 mp. Cel mai exclusivist apartament din ansamblu.',
            'floor_plan_shape' => null,
            'facade_shape'     => null,
            'images'           => [],
        ],
    ],

    /*
    |----------------------------------------------------------------------
    | Organizare pe etaje — folosit de selectorul interactiv
    |----------------------------------------------------------------------
    */
    'floors' => [
        1 => ['label' => 'Etaj 1', 'apartments_count' => 4],
        2 => ['label' => 'Etaj 2', 'apartments_count' => 4],
        3 => ['label' => 'Etaj 3', 'apartments_count' => 4],
        4 => ['label' => 'Etaj 4', 'apartments_count' => 4],
        5 => ['label' => 'Etaj 5', 'apartments_count' => 2],
    ],

    /*
    |----------------------------------------------------------------------
    | Puncte de interes localizare
    |----------------------------------------------------------------------
    */
    'poi' => [
        ['icon' => 'beach_access',   'label' => 'Plaja Mangalia',   'distance' => '10 min'],
        ['icon' => 'restaurant',     'label' => 'Centrul vechi',    'distance' => '15 min'],
        ['icon' => 'directions_car', 'label' => 'Constanța',        'distance' => '45 min'],
        ['icon' => 'local_hospital', 'label' => 'Spital Municipal', 'distance' => '5 min'],
        ['icon' => 'shopping_cart',  'label' => 'Lidl · Kaufland',  'distance' => '5 min'],
        ['icon' => 'pool',           'label' => 'Saturn · Venus',   'distance' => '8 min'],
    ],

];
