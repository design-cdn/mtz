@extends('layouts.app')

@section('title', __('meta.apartment.title', [
    'rooms' => $apartment['rooms'],
    'floor' => $apartment['floor'],
]))
@section('description', __('meta.apartment.description', [
    'rooms'       => $apartment['rooms'],
    'area'        => $apartment['area'],
    'floor'       => $apartment['floor'],
    'orientation' => $apartment['orientation'],
]))

@php
  $activeRoute = 'apartments';
@endphp

@section('content')

<div style="padding-top:var(--nav-h);">

  {{-- Breadcrumb --}}
  <div class="mtz-container" style="padding-top:2.5rem;padding-bottom:0.5rem;">
    <nav aria-label="Breadcrumb" class="flex items-center gap-3">
      <a href="{{ route('home') }}" class="mtz-caption" style="color:var(--color-text-primary);opacity:0.4;text-decoration:none;">Acasă</a>
      <span class="mtz-caption" style="opacity:0.3;">·</span>
      <a href="{{ route('home') }}#apartamente" class="mtz-caption" style="color:var(--color-text-primary);opacity:0.4;text-decoration:none;">Apartamente</a>
      <span class="mtz-caption" style="opacity:0.3;">·</span>
      <span class="mtz-caption" style="opacity:0.7;">Ap. {{ $apartment['label'] }} · Etaj {{ $apartment['floor'] }}</span>
    </nav>
  </div>

  {{-- ═══ HERO APARTAMENT ═══ --}}
  <section class="mtz-container" style="padding-top:2rem;padding-bottom:8rem;">

    {{-- Badge + titlu --}}
    <div style="margin-bottom:4rem;">
      <div class="flex items-center gap-4" style="margin-bottom:1rem;">
        <span class="mtz-badge">
          <span class="mtz-badge__dot" style="background-color:var(--color-status-{{ $apartment['status'] }});"></span>
          {{ __('hero.status.' . $apartment['status']) }}
        </span>
        <span class="mtz-caption">{{ $building['name'] }} · {{ $building['location'] }}</span>
      </div>
      <h1 class="mtz-h1">
        Apartament {{ $apartment['rooms'] }} {{ $apartment['rooms'] === 1 ? 'cameră' : 'camere' }}<br/>
        Etaj {{ $apartment['floor'] }} · Orientare {{ $apartment['orientation'] }}
      </h1>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-start">

      {{-- Stânga: imagini + plan 2D --}}
      <div class="lg:col-span-8">
        <div class="mtz-img-wrap" style="margin-bottom:1rem;max-height:520px;overflow:hidden;">
          <img
            class="mtz-img"
            src="{{ asset('images/hero.jpg') }}"
            alt="MTZ Nord Residence — Ap. {{ $apartment['label'] }}"
            loading="lazy"
            style="max-height:520px;"
          />
        </div>

        {{-- Plan 2D placeholder — Phase 2: SVG/PDF al apartamentului --}}
        <div class="mtz-placeholder" style="min-height:18rem;">
          <span class="material-symbols-outlined mtz-icon-3xl" style="color:var(--color-secondary);margin-bottom:1rem;">architecture</span>
          <span class="mtz-label" style="margin-bottom:0.5rem;">Plan 2D</span>
          <p class="mtz-body-sm" style="max-width:18rem;text-align:center;">Planul vectorial al apartamentului va fi disponibil după finalizarea documentației tehnice.</p>
        </div>
      </div>

      {{-- Dreapta: date + CTA --}}
      <div class="lg:col-span-4 flex flex-col gap-10">

        {{-- Date principale --}}
        <div class="flex flex-col gap-6" style="padding-bottom:2rem;border-bottom:1px solid var(--color-outline-variant);">
          <div>
            <span class="mtz-label">Configurație</span>
            <p class="mtz-stat" style="font-size:var(--text-3xl);">{{ $apartment['rooms'] }} {{ $apartment['rooms'] === 1 ? 'cameră' : 'camere' }}</p>
          </div>
          <div>
            <span class="mtz-label">Suprafață utilă</span>
            <p class="mtz-stat" style="font-size:var(--text-3xl);">{{ $apartment['area'] }} m²</p>
          </div>
          <div>
            <span class="mtz-label">Etaj</span>
            <p class="mtz-stat" style="font-size:var(--text-3xl);">{{ $apartment['floor'] }} din {{ $building['floors_total'] }}</p>
          </div>
          <div>
            <span class="mtz-label">Preț</span>
            <p class="mtz-stat" style="font-size:var(--text-3xl);">{{ $apartment['price'] ?? 'La cerere' }}</p>
          </div>
        </div>

        {{-- Detalii secundare --}}
        <div class="flex flex-col gap-4" style="padding-bottom:2rem;border-bottom:1px solid var(--color-outline-variant);">
          <div class="mtz-detail-row">
            <span class="mtz-caption">Orientare</span>
            <span class="mtz-body-sm" style="color:var(--color-text-primary);">{{ $apartment['orientation'] }}</span>
          </div>
          @if($apartment['balcony_area'])
            <div class="mtz-detail-row">
              <span class="mtz-caption">Balcon</span>
              <span class="mtz-body-sm" style="color:var(--color-text-primary);">Da · {{ $apartment['balcony_area'] }} m²</span>
            </div>
          @endif
          <div class="mtz-detail-row">
            <span class="mtz-caption">Loc parcare</span>
            <span class="mtz-body-sm" style="color:var(--color-text-primary);">Inclus</span>
          </div>
          <div class="mtz-detail-row">
            <span class="mtz-caption">Predare</span>
            <span class="mtz-body-sm" style="color:var(--color-text-primary);">{{ $building['year'] }}</span>
          </div>
          <div class="mtz-detail-row">
            <span class="mtz-caption">Finisaje</span>
            <span class="mtz-body-sm" style="color:var(--color-text-primary);">La cheie</span>
          </div>
        </div>

        {{-- CTA --}}
        <button
          class="mtz-btn mtz-btn-primary"
          style="width:100%;padding:1.25rem 2rem;"
          @click.prevent="$dispatch('open-modal')"
          x-data
        >
          Cere ofertă pentru acest apartament
        </button>
        <a
          href="https://wa.me/{{ $building['whatsapp'] }}?text={{ urlencode('Bună ziua, sunt interesat de Apartamentul ' . $apartment['label'] . ' Etaj ' . $apartment['floor'] . ' din MTZ Nord Residence.') }}"
          class="mtz-btn mtz-btn-outline"
          style="width:100%;padding:1.25rem 2rem;"
          target="_blank"
          rel="noopener noreferrer"
        >
          <x-icon-whatsapp class="w-4 h-4"/>
          Întreabă pe WhatsApp
        </a>

      </div>
    </div>
  </section>

  {{-- ═══ DESCRIERE ═══ --}}
  <section class="mtz-section mtz-section-surface mtz-border-top">
    <div class="mtz-container">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-20">
        <div class="lg:col-span-5" data-animate="fade-up">
          <span class="mtz-label">Despre apartament</span>
          <h2 class="mtz-h2">Spațios, luminos, gata de locuit.</h2>
          <hr class="mtz-divider"/>
        </div>
        <div class="lg:col-span-6 lg:col-start-7 flex flex-col gap-6" data-animate="fade-up">
          <p class="mtz-body-lg">{{ $apartment['description'] }}</p>
          <p class="mtz-body-lg">Predarea se face la cheie: pardoseală, tâmplărie, instalații și aer condiționat incluse. Nu mai trebuie să te gândești la renovare — intri direct cu mobila.</p>
        </div>
      </div>
    </div>
  </section>

  {{-- ═══ DOTĂRI ═══ --}}
  <section class="mtz-section mtz-section-bg">
    <div class="mtz-container">
      <div style="margin-bottom:4rem;" data-animate="fade-up">
        <span class="mtz-label">Ce include apartamentul</span>
        <h2 class="mtz-h2">Dotări și finisaje.</h2>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-16 gap-y-16">
        @foreach($aptAmenities as $amenity)
          <div class="flex flex-col gap-4" data-animate="fade-up">
            <span class="material-symbols-outlined mtz-icon-xl" style="color:var(--color-secondary);">{{ $amenity['icon'] }}</span>
            <h3 class="mtz-h3">{{ $amenity['label'] }}</h3>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  {{-- ═══ FORMULAR OFERTĂ ═══ --}}
  <section id="oferta" class="mtz-section-dark">
    <div class="mtz-container" style="padding-top:var(--space-2xl);padding-bottom:var(--space-lg);border-bottom:1px solid rgba(255,255,255,0.08);">
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
        <div>
          <span class="mtz-label-dark">Apartament</span>
          <p class="mtz-body-dark" style="font-size:var(--text-base);">
            {{ $apartment['rooms'] }} {{ $apartment['rooms'] === 1 ? 'cameră' : 'camere' }} · Etaj {{ $apartment['floor'] }} · {{ $apartment['area'] }} m²<br/>
            {{ $building['name'] }}, {{ $building['location'] }}
          </p>
        </div>
        <div>
          <span class="mtz-label-dark">Contact direct</span>
          <p class="mtz-body-dark" style="font-size:var(--text-base);">{{ $building['phone'] }}</p>
          <p class="mtz-body-dark" style="font-size:var(--text-base);">{{ $building['email'] }}</p>
        </div>
        <div>
          <span class="mtz-label-dark">Program</span>
          <p class="mtz-body-dark" style="font-size:var(--text-base);">Lun–Vin: 9:00–18:00<br/>Sâmbătă: 10:00–14:00</p>
        </div>
      </div>
    </div>

    <div class="mtz-container" style="padding-top:var(--space-2xl);padding-bottom:var(--space-2xl);">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 lg:gap-24">
        <div class="lg:col-span-4" data-animate="fade-up">
          <span class="mtz-label-dark">{{ __('contact.apt_section_label') }}</span>
          <h2 class="mtz-h2-dark" style="margin-bottom:var(--space-md);">{{ __('contact.apt_section_title') }}</h2>
          <p class="mtz-body-dark">{{ __('contact.apt_section_body') }}</p>
          <a
            href="https://wa.me/{{ $building['whatsapp'] }}?text={{ urlencode('Bună ziua, sunt interesat de Apartamentul ' . $apartment['label'] . ' Etaj ' . $apartment['floor'] . ' din MTZ Nord Residence.') }}"
            class="mtz-btn-wa"
            target="_blank"
            rel="noopener noreferrer"
            style="color:var(--color-secondary);margin-top:var(--space-lg);display:inline-flex;gap:0.5rem;"
          >
            <x-icon-whatsapp class="w-4 h-4"/>
            {{ __('contact.whatsapp_link') }}
          </a>
        </div>
        <div class="lg:col-span-8" data-animate="fade-up">
          <x-contact-form :apartment="$apartment"/>
        </div>
      </div>
    </div>
  </section>

</div>

@endsection
