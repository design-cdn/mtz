<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class ProgresController extends Controller
{
    public function index(): View
    {
        $building = config('apartments.building');

        /*
         * Phase 1: date hardcodate de progres.
         * Phase 2: acestea vor veni din DB (model ConstructionUpdate).
         * Structura este pregătită: title, date, description, images[].
         */
        $updates = [
            [
                'month'       => 'Martie',
                'year'        => 2025,
                'description' => 'Structura de rezistență finalizată pe toate etajele. Au început lucrările de compartimentare interioară la etajele 1 și 2.',
                'images'      => [
                    ['src' => asset('images/hero.jpg'), 'alt' => 'MTZ Nord Residence — structură etaj 5, martie 2025'],
                    ['src' => asset('images/hero.jpg'), 'alt' => 'MTZ Nord Residence — compartimentare etaj 1'],
                ],
            ],
            [
                'month'       => 'Februarie',
                'year'        => 2025,
                'description' => 'Turnarea planșeelor la etajele 3, 4 și 5. Primele ferestre montate la parter și etajul 1.',
                'images'      => [
                    ['src' => asset('images/hero.jpg'), 'alt' => 'MTZ Nord Residence — turnare planșeu etaj 3'],
                    ['src' => asset('images/hero.jpg'), 'alt' => 'MTZ Nord Residence — montaj tâmplărie parter'],
                ],
            ],
            [
                'month'       => 'Ianuarie',
                'year'        => 2025,
                'description' => 'Finalizarea infrastructurii și demararea primelor niveluri supraterane. Structura prinde formă.',
                'images'      => [
                    ['src' => asset('images/hero.jpg'), 'alt' => 'MTZ Nord Residence — infrastructură și armare'],
                    ['src' => asset('images/hero.jpg'), 'alt' => 'MTZ Nord Residence — primele niveluri supraterane'],
                ],
            ],
        ];

        return view('progres', compact('building', 'updates'));
    }
}
