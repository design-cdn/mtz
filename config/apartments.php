<?php

/*
|--------------------------------------------------------------------------
| Configurare apartamente — MTZ Nord Residence
|--------------------------------------------------------------------------
| Date reale după randările primite (parter + etaje 1–3, layout identic pe
| cele 3 etaje → același plan refolosit, 8 apartamente/nivel). Etajele 4–5
| nu au încă planuri ('enabled' => false → marcate "În curând" în selector).
|
| Numerotare continuă: ap. 1–8 parter, 9–16 etaj 1, 17–24 etaj 2,
| 25–32 etaj 3. Se continuă în sus când vin planurile pentru 4–5.
|
| Status posibile: 'available' | 'sold' | 'rented'
|
| ⚠️ PLACEHOLDER de completat manual de către dezvoltator:
|    - 'area'  => 50    →  suprafață utilă în m² (placeholder 50 m²; modifică din dashboard)
|    - 'price' => null  →  preț (acum afișează "La cerere")
|    - 'status'         →  toate 'available' implicit
|    - 'description'    →  text generic; personalizează per apartament
|
| Câmpuri derivate din randări (confirmate):
|    - 'rooms'   => 2  (toate apartamentele sunt de 2 camere)
|    - 'balcony' => true (toate au balcon/terasă)
|    - 'image'   => planul 3D pătrat mapat per apartament
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
        'location'      => 'Medgidia, județul Constanța',
        'year'          => 2026,
        'whatsapp'      => '40700000000',
        'phone'         => '+40 700 000 000',
        'email'         => 'contact@mtznordresidence.ro',
        'address'       => 'Medgidia, județul Constanța',
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
    | Apartamente — numerotare continuă 1..26
    | Toate: 2 camere, balcon, dotări standard, predare la cheie.
    |----------------------------------------------------------------------
    */
    'apartments' => [

        // ── PARTER (ap. 1–8) ──
        ['id' => 1, 'slug' => 'ap-1', 'label' => '1', 'floor' => 0, 'rooms' => 2, 'area' => 50, 'status' => 'available', 'price' => null, 'balcony' => true, 'amenities' => ['ac', 'heating', 'pvc', 'intercom', 'elevator', 'parking'], 'description' => 'Apartament cu 2 camere la parter în MTZ Nord Residence — living open-space luminos, dormitor separat, baie și balcon. Predare la cheie.', 'plan_2d' => 'images/apartamente/parter/1.svg', 'image' => 'images/apartamente/parter/ap-01.jpg'],
        ['id' => 2, 'slug' => 'ap-2', 'label' => '2', 'floor' => 0, 'rooms' => 2, 'area' => 50, 'status' => 'sold', 'price' => null, 'balcony' => true, 'amenities' => ['ac', 'heating', 'pvc', 'intercom', 'elevator', 'parking'], 'description' => 'Apartament cu 2 camere la parter în MTZ Nord Residence — living open-space luminos, dormitor separat, baie și balcon. Predare la cheie.', 'plan_2d' => 'images/apartamente/parter/2.svg', 'image' => 'images/apartamente/parter/ap-02.jpg'],
        ['id' => 3, 'slug' => 'ap-3', 'label' => '3', 'floor' => 0, 'rooms' => 2, 'area' => 50, 'status' => 'reserved', 'price' => null, 'balcony' => true, 'amenities' => ['ac', 'heating', 'pvc', 'intercom', 'elevator', 'parking'], 'description' => 'Apartament cu 2 camere la parter în MTZ Nord Residence — living open-space luminos, dormitor separat, baie și balcon. Predare la cheie.', 'plan_2d' => 'images/apartamente/parter/3.svg', 'image' => 'images/apartamente/parter/ap-03.jpg'],
        ['id' => 4, 'slug' => 'ap-4', 'label' => '4', 'floor' => 0, 'rooms' => 2, 'area' => 50, 'status' => 'available', 'price' => null, 'balcony' => true, 'amenities' => ['ac', 'heating', 'pvc', 'intercom', 'elevator', 'parking'], 'description' => 'Apartament cu 2 camere la parter în MTZ Nord Residence — living open-space luminos, dormitor separat, baie și balcon. Predare la cheie.', 'plan_2d' => 'images/apartamente/parter/4.svg', 'image' => 'images/apartamente/parter/ap-04.jpg'],
        ['id' => 5, 'slug' => 'ap-5', 'label' => '5', 'floor' => 0, 'rooms' => 2, 'area' => 50, 'status' => 'available', 'price' => null, 'balcony' => true, 'amenities' => ['ac', 'heating', 'pvc', 'intercom', 'elevator', 'parking'], 'description' => 'Apartament cu 2 camere la parter în MTZ Nord Residence — living open-space luminos, dormitor separat, baie și balcon. Predare la cheie.', 'plan_2d' => 'images/apartamente/parter/5.svg', 'image' => 'images/apartamente/parter/ap-05.jpg'],
        ['id' => 6, 'slug' => 'ap-6', 'label' => '6', 'floor' => 0, 'rooms' => 2, 'area' => 50, 'status' => 'sold', 'price' => null, 'balcony' => true, 'amenities' => ['ac', 'heating', 'pvc', 'intercom', 'elevator', 'parking'], 'description' => 'Apartament cu 2 camere la parter în MTZ Nord Residence — living open-space luminos, dormitor separat, baie și balcon. Predare la cheie.', 'plan_2d' => 'images/apartamente/parter/6.svg', 'image' => 'images/apartamente/parter/ap-06.jpg'],
        ['id' => 7, 'slug' => 'ap-7', 'label' => '7', 'floor' => 0, 'rooms' => 2, 'area' => 50, 'status' => 'reserved', 'price' => null, 'balcony' => true, 'amenities' => ['ac', 'heating', 'pvc', 'intercom', 'elevator', 'parking'], 'description' => 'Apartament cu 2 camere la parter în MTZ Nord Residence — living open-space luminos, dormitor separat, baie și balcon. Predare la cheie.', 'plan_2d' => 'images/apartamente/parter/7.svg', 'image' => 'images/apartamente/parter/ap-07.jpg'],
        ['id' => 8, 'slug' => 'ap-8', 'label' => '8', 'floor' => 0, 'rooms' => 2, 'area' => 50, 'status' => 'available', 'price' => null, 'balcony' => true, 'amenities' => ['ac', 'heating', 'pvc', 'intercom', 'elevator', 'parking'], 'description' => 'Apartament cu 2 camere la parter în MTZ Nord Residence — living open-space luminos, dormitor separat, baie și balcon. Predare la cheie.', 'plan_2d' => 'images/apartamente/parter/8.svg', 'image' => 'images/apartamente/parter/ap-08.jpg'],

        // ── ETAJ 1 (ap. 9–16) — plan-tip „etaj-tip.svg", grupuri ap-9..ap-16 ──
        // Pozițiile 7–8 de jos (ap-15, ap-16) sunt în curs de recompartimentare
        // de către dezvoltator → status 'remodel': greyed pe plan, neselectabile.
        // Randările etaj-tip (ap-9..ap-14.jpg) acoperă cele 6 apartamente de sus.
        ['id' => 9,  'slug' => 'ap-9',  'label' => '9',  'floor' => 1, 'rooms' => 2, 'area' => 50, 'status' => 'available', 'price' => null, 'balcony' => true, 'amenities' => ['ac', 'heating', 'pvc', 'intercom', 'elevator', 'parking'], 'description' => 'Apartament cu 2 camere la etajul 1 în MTZ Nord Residence — living open-space luminos, dormitor separat, baie și balcon. Predare la cheie.', 'image' => 'images/apartamente/etaj-tip/ap-9.jpg'],
        ['id' => 10, 'slug' => 'ap-10', 'label' => '10', 'floor' => 1, 'rooms' => 2, 'area' => 50, 'status' => 'reserved',  'price' => null, 'balcony' => true, 'amenities' => ['ac', 'heating', 'pvc', 'intercom', 'elevator', 'parking'], 'description' => 'Apartament cu 2 camere la etajul 1 în MTZ Nord Residence — living open-space luminos, dormitor separat, baie și balcon. Predare la cheie.', 'image' => 'images/apartamente/etaj-tip/ap-10.jpg'],
        ['id' => 11, 'slug' => 'ap-11', 'label' => '11', 'floor' => 1, 'rooms' => 2, 'area' => 50, 'status' => 'available', 'price' => null, 'balcony' => true, 'amenities' => ['ac', 'heating', 'pvc', 'intercom', 'elevator', 'parking'], 'description' => 'Apartament cu 2 camere la etajul 1 în MTZ Nord Residence — living open-space luminos, dormitor separat, baie și balcon. Predare la cheie.', 'image' => 'images/apartamente/etaj-tip/ap-11.jpg'],
        ['id' => 12, 'slug' => 'ap-12', 'label' => '12', 'floor' => 1, 'rooms' => 2, 'area' => 50, 'status' => 'available', 'price' => null, 'balcony' => true, 'amenities' => ['ac', 'heating', 'pvc', 'intercom', 'elevator', 'parking'], 'description' => 'Apartament cu 2 camere la etajul 1 în MTZ Nord Residence — living open-space luminos, dormitor separat, baie și balcon. Predare la cheie.', 'image' => 'images/apartamente/etaj-tip/ap-12.jpg'],
        ['id' => 13, 'slug' => 'ap-13', 'label' => '13', 'floor' => 1, 'rooms' => 2, 'area' => 50, 'status' => 'sold',      'price' => null, 'balcony' => true, 'amenities' => ['ac', 'heating', 'pvc', 'intercom', 'elevator', 'parking'], 'description' => 'Apartament cu 2 camere la etajul 1 în MTZ Nord Residence — living open-space luminos, dormitor separat, baie și balcon. Predare la cheie.', 'image' => 'images/apartamente/etaj-tip/ap-13.jpg'],
        ['id' => 14, 'slug' => 'ap-14', 'label' => '14', 'floor' => 1, 'rooms' => 2, 'area' => 50, 'status' => 'available', 'price' => null, 'balcony' => true, 'amenities' => ['ac', 'heating', 'pvc', 'intercom', 'elevator', 'parking'], 'description' => 'Apartament cu 2 camere la etajul 1 în MTZ Nord Residence — living open-space luminos, dormitor separat, baie și balcon. Predare la cheie.', 'image' => 'images/apartamente/etaj-tip/ap-14.jpg'],
        ['id' => 15, 'slug' => 'ap-15', 'label' => '15', 'floor' => 1, 'rooms' => 2, 'area' => null, 'status' => 'remodel',   'price' => null, 'balcony' => true, 'amenities' => ['ac', 'heating', 'pvc', 'intercom', 'elevator', 'parking'], 'description' => 'Apartament în curs de recompartimentare. Detaliile vor fi disponibile în curând.', 'image' => null],
        ['id' => 16, 'slug' => 'ap-16', 'label' => '16', 'floor' => 1, 'rooms' => 2, 'area' => null, 'status' => 'remodel',   'price' => null, 'balcony' => true, 'amenities' => ['ac', 'heating', 'pvc', 'intercom', 'elevator', 'parking'], 'description' => 'Apartament în curs de recompartimentare. Detaliile vor fi disponibile în curând.', 'image' => null],

        // ── ETAJ 2 (ap. 17–24) — același plan-tip (mapare pe poziție) ──
        ['id' => 17, 'slug' => 'ap-17', 'label' => '17', 'floor' => 2, 'rooms' => 2, 'area' => 50, 'status' => 'available', 'price' => null, 'balcony' => true, 'amenities' => ['ac', 'heating', 'pvc', 'intercom', 'elevator', 'parking'], 'description' => 'Apartament cu 2 camere la etajul 2 în MTZ Nord Residence — living open-space luminos, dormitor separat, baie și balcon. Predare la cheie.', 'image' => 'images/apartamente/etaj-tip/ap-9.jpg'],
        ['id' => 18, 'slug' => 'ap-18', 'label' => '18', 'floor' => 2, 'rooms' => 2, 'area' => 50, 'status' => 'sold',      'price' => null, 'balcony' => true, 'amenities' => ['ac', 'heating', 'pvc', 'intercom', 'elevator', 'parking'], 'description' => 'Apartament cu 2 camere la etajul 2 în MTZ Nord Residence — living open-space luminos, dormitor separat, baie și balcon. Predare la cheie.', 'image' => 'images/apartamente/etaj-tip/ap-10.jpg'],
        ['id' => 19, 'slug' => 'ap-19', 'label' => '19', 'floor' => 2, 'rooms' => 2, 'area' => 50, 'status' => 'available', 'price' => null, 'balcony' => true, 'amenities' => ['ac', 'heating', 'pvc', 'intercom', 'elevator', 'parking'], 'description' => 'Apartament cu 2 camere la etajul 2 în MTZ Nord Residence — living open-space luminos, dormitor separat, baie și balcon. Predare la cheie.', 'image' => 'images/apartamente/etaj-tip/ap-11.jpg'],
        ['id' => 20, 'slug' => 'ap-20', 'label' => '20', 'floor' => 2, 'rooms' => 2, 'area' => 50, 'status' => 'available', 'price' => null, 'balcony' => true, 'amenities' => ['ac', 'heating', 'pvc', 'intercom', 'elevator', 'parking'], 'description' => 'Apartament cu 2 camere la etajul 2 în MTZ Nord Residence — living open-space luminos, dormitor separat, baie și balcon. Predare la cheie.', 'image' => 'images/apartamente/etaj-tip/ap-12.jpg'],
        ['id' => 21, 'slug' => 'ap-21', 'label' => '21', 'floor' => 2, 'rooms' => 2, 'area' => 50, 'status' => 'reserved',  'price' => null, 'balcony' => true, 'amenities' => ['ac', 'heating', 'pvc', 'intercom', 'elevator', 'parking'], 'description' => 'Apartament cu 2 camere la etajul 2 în MTZ Nord Residence — living open-space luminos, dormitor separat, baie și balcon. Predare la cheie.', 'image' => 'images/apartamente/etaj-tip/ap-13.jpg'],
        ['id' => 22, 'slug' => 'ap-22', 'label' => '22', 'floor' => 2, 'rooms' => 2, 'area' => 50, 'status' => 'available', 'price' => null, 'balcony' => true, 'amenities' => ['ac', 'heating', 'pvc', 'intercom', 'elevator', 'parking'], 'description' => 'Apartament cu 2 camere la etajul 2 în MTZ Nord Residence — living open-space luminos, dormitor separat, baie și balcon. Predare la cheie.', 'image' => 'images/apartamente/etaj-tip/ap-14.jpg'],
        ['id' => 23, 'slug' => 'ap-23', 'label' => '23', 'floor' => 2, 'rooms' => 2, 'area' => null, 'status' => 'remodel',   'price' => null, 'balcony' => true, 'amenities' => ['ac', 'heating', 'pvc', 'intercom', 'elevator', 'parking'], 'description' => 'Apartament în curs de recompartimentare. Detaliile vor fi disponibile în curând.', 'image' => null],
        ['id' => 24, 'slug' => 'ap-24', 'label' => '24', 'floor' => 2, 'rooms' => 2, 'area' => null, 'status' => 'remodel',   'price' => null, 'balcony' => true, 'amenities' => ['ac', 'heating', 'pvc', 'intercom', 'elevator', 'parking'], 'description' => 'Apartament în curs de recompartimentare. Detaliile vor fi disponibile în curând.', 'image' => null],

        // ── ETAJ 3 (ap. 25–32) — același plan-tip (mapare pe poziție) ──
        ['id' => 25, 'slug' => 'ap-25', 'label' => '25', 'floor' => 3, 'rooms' => 2, 'area' => 50, 'status' => 'available', 'price' => null, 'balcony' => true, 'amenities' => ['ac', 'heating', 'pvc', 'intercom', 'elevator', 'parking'], 'description' => 'Apartament cu 2 camere la etajul 3 în MTZ Nord Residence — living open-space luminos, dormitor separat, baie și balcon. Predare la cheie.', 'image' => 'images/apartamente/etaj-tip/ap-9.jpg'],
        ['id' => 26, 'slug' => 'ap-26', 'label' => '26', 'floor' => 3, 'rooms' => 2, 'area' => 50, 'status' => 'reserved',  'price' => null, 'balcony' => true, 'amenities' => ['ac', 'heating', 'pvc', 'intercom', 'elevator', 'parking'], 'description' => 'Apartament cu 2 camere la etajul 3 în MTZ Nord Residence — living open-space luminos, dormitor separat, baie și balcon. Predare la cheie.', 'image' => 'images/apartamente/etaj-tip/ap-10.jpg'],
        ['id' => 27, 'slug' => 'ap-27', 'label' => '27', 'floor' => 3, 'rooms' => 2, 'area' => 50, 'status' => 'available', 'price' => null, 'balcony' => true, 'amenities' => ['ac', 'heating', 'pvc', 'intercom', 'elevator', 'parking'], 'description' => 'Apartament cu 2 camere la etajul 3 în MTZ Nord Residence — living open-space luminos, dormitor separat, baie și balcon. Predare la cheie.', 'image' => 'images/apartamente/etaj-tip/ap-11.jpg'],
        ['id' => 28, 'slug' => 'ap-28', 'label' => '28', 'floor' => 3, 'rooms' => 2, 'area' => 50, 'status' => 'available', 'price' => null, 'balcony' => true, 'amenities' => ['ac', 'heating', 'pvc', 'intercom', 'elevator', 'parking'], 'description' => 'Apartament cu 2 camere la etajul 3 în MTZ Nord Residence — living open-space luminos, dormitor separat, baie și balcon. Predare la cheie.', 'image' => 'images/apartamente/etaj-tip/ap-12.jpg'],
        ['id' => 29, 'slug' => 'ap-29', 'label' => '29', 'floor' => 3, 'rooms' => 2, 'area' => 50, 'status' => 'sold',      'price' => null, 'balcony' => true, 'amenities' => ['ac', 'heating', 'pvc', 'intercom', 'elevator', 'parking'], 'description' => 'Apartament cu 2 camere la etajul 3 în MTZ Nord Residence — living open-space luminos, dormitor separat, baie și balcon. Predare la cheie.', 'image' => 'images/apartamente/etaj-tip/ap-13.jpg'],
        ['id' => 30, 'slug' => 'ap-30', 'label' => '30', 'floor' => 3, 'rooms' => 2, 'area' => 50, 'status' => 'available', 'price' => null, 'balcony' => true, 'amenities' => ['ac', 'heating', 'pvc', 'intercom', 'elevator', 'parking'], 'description' => 'Apartament cu 2 camere la etajul 3 în MTZ Nord Residence — living open-space luminos, dormitor separat, baie și balcon. Predare la cheie.', 'image' => 'images/apartamente/etaj-tip/ap-14.jpg'],
        ['id' => 31, 'slug' => 'ap-31', 'label' => '31', 'floor' => 3, 'rooms' => 2, 'area' => null, 'status' => 'remodel',   'price' => null, 'balcony' => true, 'amenities' => ['ac', 'heating', 'pvc', 'intercom', 'elevator', 'parking'], 'description' => 'Apartament în curs de recompartimentare. Detaliile vor fi disponibile în curând.', 'image' => null],
        ['id' => 32, 'slug' => 'ap-32', 'label' => '32', 'floor' => 3, 'rooms' => 2, 'area' => null, 'status' => 'remodel',   'price' => null, 'balcony' => true, 'amenities' => ['ac', 'heating', 'pvc', 'intercom', 'elevator', 'parking'], 'description' => 'Apartament în curs de recompartimentare. Detaliile vor fi disponibile în curând.', 'image' => null],
    ],

    /*
    |----------------------------------------------------------------------
    | Organizare pe niveluri — folosit de selectorul interactiv
    | 'enabled' => false  →  nivel afișat dar fără apartamente ("în curs de repartajare")
    |----------------------------------------------------------------------
    */
    'floors' => [
        0 => ['label' => 'Parter',  'enabled' => true],
        1 => ['label' => 'Etaj 1',  'enabled' => true],
        2 => ['label' => 'Etaj 2',  'enabled' => true],
        3 => ['label' => 'Etaj 3',  'enabled' => true],
        4 => ['label' => 'Etaj 4',  'enabled' => false], // în curs de repartajare
        5 => ['label' => 'Etaj 5',  'enabled' => false], // în curs de repartajare
    ],

    /*
    |----------------------------------------------------------------------
    | Puncte de interes localizare
    |----------------------------------------------------------------------
    */
    'poi' => [
        ['icon' => 'directions_car', 'label' => 'Autostrada A2',       'distance' => '5 min'],
        ['icon' => 'train',          'label' => 'Gară Medgidia',      'distance' => '5 min'],
        ['icon' => 'local_hospital', 'label' => 'Spital Municipal',   'distance' => '5 min'],
        ['icon' => 'location_city',  'label' => 'Constanța',          'distance' => '40 min'],
        ['icon' => 'wine_bar',       'label' => 'Podgoria Murfatlar',  'distance' => '20 min'],
        ['icon' => 'beach_access',   'label' => 'Litoral · Mamaia',   'distance' => '50 min'],
    ],

];
