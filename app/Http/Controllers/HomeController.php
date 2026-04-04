<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $building   = config('apartments.building');
        $floors     = config('apartments.floors');
        $apartments = collect(config('apartments.apartments'));
        $poi        = config('apartments.poi');

        // Grupare apartamente pe etaje pentru selectorul Alpine.js
        $floorData = collect($floors)->map(function ($floor, $num) use ($apartments) {
            $floorApts = $apartments
                ->where('floor', $num)
                ->values()
                ->map(fn ($a) => [
                    'id'          => $a['id'],
                    'slug'        => $a['slug'],
                    'label'       => $a['label'],
                    'floor'       => $a['floor'],
                    'rooms'       => $a['rooms'],
                    'area'        => $a['area'],
                    'orientation' => $a['orientation'],
                    'status'      => $a['status'],
                    'url'         => route('apartament.show', $a['slug']),
                ]);

            return [
                'number'     => $num,
                'label'      => $floor['label'],
                'apartments' => $floorApts,
            ];
        })->values();

        // Statistici globale pentru secțiunea cifre cheie
        $stats = [
            'floors'     => config('apartments.building.floors_total'),
            'rooms_range' => '1–4',
            'quality'    => '100%',
            'year'       => config('apartments.building.year'),
        ];

        return view('home', compact('building', 'floorData', 'poi', 'stats'));
    }
}
