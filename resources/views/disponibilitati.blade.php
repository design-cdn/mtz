@extends('layouts.app')

@section('title', __('meta.apartments.title'))
@section('description', __('meta.apartments.description'))

@php
  $activeRoute = 'apartments';

  $statusMeta = [
    'available' => ['label' => 'Disponibil',           'class' => 'is-available'],
    'reserved'  => ['label' => 'Rezervat',             'class' => 'is-reserved'],
    'sold'      => ['label' => 'Vândut',               'class' => 'is-sold'],
    'remodel'   => ['label' => 'În recompartimentare', 'class' => 'is-remodel'],
  ];

  $counts = [
    'all'       => $apartments->count(),
    'available' => $apartments->where('status', 'available')->count(),
    'reserved'  => $apartments->where('status', 'reserved')->count(),
    'sold'      => $apartments->where('status', 'sold')->count(),
  ];
@endphp

@section('content')

<div style="padding-top:var(--nav-h);">

  {{-- ═══ INTRO ═══ --}}
  <section class="mtz-section mtz-section-surface mtz-border-top">
    <div class="mtz-container">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-20">
        <div class="lg:col-span-5" data-animate="fade-up">
          <span class="mtz-label">{{ $building['name'] }} · {{ $building['location'] }}</span>
          <h1 class="mtz-h1">Disponibilități</h1>
          <hr class="mtz-divider"/>
        </div>
        <div class="lg:col-span-6 lg:col-start-7 flex flex-col justify-end gap-6" data-animate="fade-up">
          <p class="mtz-body-lg">Toate apartamentele din ansamblu, într-un singur loc — etaj, suprafață, număr de camere și disponibilitate. Apasă pe orice apartament pentru plan și detalii complete.</p>
        </div>
      </div>

      {{-- Selecție etaj — aceleași butoane ca în hero, pe toată lățimea containerului --}}
      <div class="mtz-floor-bar" data-animate="fade-up">
        @foreach($floorNav as $f)
          @if($f['pending'])
            <span class="mtz-floor-bar__item is-pending">
              <span class="mtz-floor-bar__label">{{ $f['label'] }}</span>
              <span class="mtz-floor-bar__count">în curs de repartajare</span>
            </span>
          @else
            <a href="{{ $f['url'] }}" class="mtz-floor-bar__item">
              <span class="mtz-floor-bar__label">{{ $f['label'] }}</span>
              <span class="mtz-floor-bar__count">{{ $f['count'] }} ap.</span>
            </a>
          @endif
        @endforeach
      </div>
    </div>
  </section>

  {{-- ═══ TABEL DISPONIBILITĂȚI ═══ --}}
  <section class="mtz-section mtz-section-bg mtz-border-top">
    <div class="mtz-container" x-data="{ f: 'all', counts: @js($counts) }" data-animate="fade-up">

      {{-- Filtre status (dublează drept sumar cu numărători) --}}
      <div class="mtz-avail-filters" role="tablist" aria-label="Filtrează după status">
        <button type="button" class="mtz-avail-chip" :class="{ 'is-active': f === 'all' }" @click="f = 'all'">
          Toate <span class="mtz-avail-chip__count">{{ $counts['all'] }}</span>
        </button>
        <button type="button" class="mtz-avail-chip" :class="{ 'is-active': f === 'available' }" @click="f = 'available'">
          Disponibile <span class="mtz-avail-chip__count">{{ $counts['available'] }}</span>
        </button>
        <button type="button" class="mtz-avail-chip" :class="{ 'is-active': f === 'reserved' }" @click="f = 'reserved'">
          Rezervate <span class="mtz-avail-chip__count">{{ $counts['reserved'] }}</span>
        </button>
        <button type="button" class="mtz-avail-chip" :class="{ 'is-active': f === 'sold' }" @click="f = 'sold'">
          Vândute <span class="mtz-avail-chip__count">{{ $counts['sold'] }}</span>
        </button>
      </div>

      <table class="mtz-avail-table">
        <thead>
          <tr>
            <th>Etaj</th>
            <th>Apartament</th>
            <th>Suprafață</th>
            <th>Camere</th>
            <th>Status</th>
            <th><span class="sr-only">Detalii</span></th>
          </tr>
        </thead>
        <tbody>
          @foreach($apartments as $a)
            @php $meta = $statusMeta[$a['status']] ?? $statusMeta['available']; @endphp
            <tr x-show="f === 'all' || f === '{{ $a['status'] }}'">
              <td data-label="Etaj" class="cell-floor">{{ $a['floor_label'] }}</td>
              <td data-label="Apartament" class="cell-apt">Ap. {{ $a['label'] }}</td>
              <td data-label="Suprafață" class="cell-muted">{{ $a['area'] ? $a['area'] . ' m²' : '—' }}</td>
              <td data-label="Camere">{{ $a['rooms'] }} {{ $a['rooms'] === 1 ? 'cameră' : 'camere' }}</td>
              <td data-label="Status">
                <span class="mtz-avail-badge {{ $meta['class'] }}">
                  <span class="mtz-avail-badge__dot"></span>{{ $meta['label'] }}
                </span>
              </td>
              <td>
                @if($a['status'] !== 'remodel')
                  <a href="{{ $a['url'] }}" class="mtz-avail-link" aria-label="Vezi detalii Ap. {{ $a['label'] }}">
                    Vezi <span class="material-symbols-outlined">arrow_forward</span>
                  </a>
                @else
                  <span class="cell-muted">—</span>
                @endif
              </td>
            </tr>
          @endforeach

          {{-- Etaje în curs de repartajare (fără apartamente încă) --}}
          @foreach($pendingFloors as $pf)
            <tr class="mtz-avail-row--pending" x-show="f === 'all'">
              <td data-label="Etaj" class="cell-floor">{{ $pf['label'] }}</td>
              <td data-label="Status" colspan="5">
                <span class="mtz-avail-badge is-pending">
                  <span class="mtz-avail-badge__dot"></span>În curs de repartajare
                </span>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>

      {{-- Niciun rezultat pentru filtrul selectat --}}
      <p class="mtz-avail-empty"
         x-show="f !== 'all' && counts[f] === 0"
         x-cloak>
        Niciun apartament în această categorie momentan.
      </p>

    </div>
  </section>

</div>

@endsection
