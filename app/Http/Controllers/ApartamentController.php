<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ApartamentController extends Controller
{
    /**
     * Pagina de disponibilități — tabel cu toate apartamentele.
     */
    public function index(): View
    {
        $building = config('apartments.building');

        $apartments = collect(config('apartments.apartments'))
            ->sortBy([['floor', 'asc'], ['id', 'asc']])
            ->map(fn ($a) => [
                'label'       => $a['label'],
                'floor'       => $a['floor'],
                'floor_label' => $a['floor'] === 0 ? 'Parter' : 'Etaj ' . $a['floor'],
                'rooms'       => $a['rooms'],
                'area'        => $a['area'],
                'status'      => $a['status'],
                'url'         => route('apartament.show', $a['slug']),
            ])
            ->values();

        // Etaje fără apartamente încă — afișate ca "în curs de repartajare"
        $pendingFloors = collect(config('apartments.floors'))
            ->reject(fn ($floor) => $floor['enabled'])
            ->map(fn ($floor) => ['label' => $floor['label']])
            ->values();

        // Bară selecție etaj (aceleași butoane ca în hero, ordine crescătoare:
        // parter → ultimul etaj). Linkuri către planul fiecărui nivel.
        $allApartments = collect(config('apartments.apartments'));
        $floorNav = collect(config('apartments.floors'))
            ->map(fn ($floor, $num) => [
                'label'   => $floor['label'],
                'pending' => ! $floor['enabled'],
                'url'     => $floor['enabled'] ? route('etaj.show', $num === 0 ? 'parter' : (string) $num) : null,
                'count'   => $allApartments->where('floor', $num)->count(),
            ])
            ->values();

        return view('disponibilitati', compact('building', 'apartments', 'pendingFloors', 'floorNav'));
    }

    /**
     * Pagina unui etaj — plan interactiv (SVG) cu selecție apartament.
     */
    public function floor(string $floor): View
    {
        $floors = config('apartments.floors');
        $number = $floor === 'parter' ? 0 : (ctype_digit($floor) ? (int) $floor : null);

        if ($number === null || ! isset($floors[$number])) {
            abort(404);
        }

        $floorMeta  = $floors[$number];
        $floorLabel = $floorMeta['label'];
        $pending    = ! $floorMeta['enabled'];
        $building   = config('apartments.building');

        $apartments = collect(config('apartments.apartments'))
            ->where('floor', $number)
            ->sortBy('id')
            ->values()
            ->map(fn ($a, $i) => [
                'slug'     => $a['slug'],
                // ID-ul grupului din SVG. Parter: planul propriu are grupuri ap-1..ap-8
                // = slug. Etajele 1–3 refolosesc același plan (grupuri ap-9..ap-16),
                // deci apartamentele se mapează pe poziție, nu pe slug.
                'svgId'    => $number === 0 ? $a['slug'] : 'ap-' . (9 + $i),
                'label'    => $a['label'],
                'rooms'    => $a['rooms'],
                'area'     => $a['area'],
                'areaText' => $a['area'] ? $a['area'] . ' m²' : 'La cerere',
                'status'   => $a['status'],
                'url'      => route('apartament.show', $a['slug']),
            ]);

        // Plan SVG al nivelului. Parter are plan propriu; etajele 1–3 împart un
        // singur plan-tip (aceeași configurație). Etajele 4–5 nu au încă plan.
        $svgName = $number === 0 ? 'parter' : 'etaj-tip';
        $svgFile = public_path("etaje_svg/{$svgName}.svg");
        $planSvg = is_file($svgFile) ? file_get_contents($svgFile) : null;

        return view('etaj', compact(
            'building', 'floorLabel', 'floorMeta', 'number', 'apartments', 'planSvg', 'pending'
        ));
    }

    public function show(string $slug): View|RedirectResponse
    {
        $apartments = collect(config('apartments.apartments'));
        $apartment  = $apartments->firstWhere('slug', $slug);

        if (! $apartment) {
            abort(404);
        }

        // Apartamentele în recompartimentare nu sunt accesibile — trimite la etaj.
        if ($apartment['status'] === 'remodel') {
            $floorParam = $apartment['floor'] === 0 ? 'parter' : (string) $apartment['floor'];

            return redirect()->route('etaj.show', $floorParam);
        }

        $building = config('apartments.building');
        $amenities = config('apartments.amenities');

        // Filtrare dotările apartamentului
        $aptAmenities = collect($apartment['amenities'])
            ->map(fn ($key) => $amenities[$key] ?? null)
            ->filter()
            ->values();

        // Apartamente similare (același etaj, status disponibil, altă unitate)
        $related = $apartments
            ->where('floor', $apartment['floor'])
            ->where('status', 'available')
            ->where('slug', '!=', $slug)
            ->take(3)
            ->values();

        return view('apartament', compact('apartment', 'building', 'aptAmenities', 'related'));
    }
}
