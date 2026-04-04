<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ApartamentController extends Controller
{
    public function show(string $slug): View|RedirectResponse
    {
        $apartments = collect(config('apartments.apartments'));
        $apartment  = $apartments->firstWhere('slug', $slug);

        if (! $apartment) {
            abort(404);
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
