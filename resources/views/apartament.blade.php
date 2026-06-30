@extends('layouts.app')

@php
    $floorLabel = $apartment['floor'] === 0 ? 'Parter' : 'Etaj ' . $apartment['floor'];
    $areaText   = $apartment['area'] ? $apartment['area'] . ' m²' : 'La cerere';

    // Slide-urile lightbox-ului: planul 3D + planul 2D vectorial (când e disponibil).
    // Pentru 2D, adaugă 'plan_2d' => 'images/...' la apartamentul din config/apartments.php.
    $slides = [['src' => asset($apartment['image'] ?? 'images/hero.jpg'), 'caption' => 'Plan 3D', 'sheet' => false]];
    if (! empty($apartment['plan_2d'])) {
        $slides[] = ['src' => asset($apartment['plan_2d']), 'caption' => 'Plan 2D', 'sheet' => true];
    }
@endphp

@section('title', __('meta.apartment.title', [
    'rooms' => $apartment['rooms'],
    'floor' => $floorLabel,
]))
@section('description', __('meta.apartment.description', [
    'rooms' => $apartment['rooms'],
    'floor' => $floorLabel,
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
      <a href="{{ route('apartamente.index') }}" class="mtz-caption" style="color:var(--color-text-primary);opacity:0.4;text-decoration:none;">Apartamente</a>
      <span class="mtz-caption" style="opacity:0.3;">·</span>
      <span class="mtz-caption" style="opacity:0.7;">Ap. {{ $apartment['label'] }} · {{ $floorLabel }}</span>
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
      </div>
      <h1 class="mtz-h1">
        Apartament {{ $apartment['rooms'] }} {{ $apartment['rooms'] === 1 ? 'cameră' : 'camere' }}<br/>
        {{ $floorLabel }}
      </h1>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-start">

      {{-- Stânga: plan 3D (click → lightbox cu plan 2D vectorial) --}}
      <div class="lg:col-span-8" x-data="aptGallery(@js($slides))">
        <button
          type="button"
          class="mtz-img-wrap mtz-img-wrap--clickable mtz-apt-figure"
          @click="show(0)"
          aria-label="Mărește planul apartamentului"
        >
          <img
            class="mtz-apt-figure__img"
            src="{{ asset($apartment['image'] ?? 'images/hero.jpg') }}"
            alt="Plan apartament — MTZ Nord Residence, Ap. {{ $apartment['label'] }}"
          />
          <div class="mtz-img-overlay">
            <span class="material-symbols-outlined mtz-img-overlay__icon">zoom_in</span>
          </div>
          <div class="mtz-img-badge">
            <span class="material-symbols-outlined">open_in_full</span>
            Mărește
          </div>
        </button>

        {{-- Lightbox — teleportat pe body ca să scape de stacking context --}}
        <template x-teleport="body">
          <div
            class="mtz-lightbox"
            x-show="open"
            x-cloak
            @keydown.window="onKey($event)"
            role="dialog"
            aria-modal="true"
          >
            <div class="mtz-lightbox__bg" @click="close()"></div>

            <div class="mtz-lb__counter" x-show="multi" x-text="(i + 1) + ' / ' + slides.length"></div>

            <button class="mtz-lb__close" @click="close()" aria-label="Închide">
              <span class="material-symbols-outlined">close</span>
            </button>

            <button class="mtz-lb__nav mtz-lb__nav--prev" x-show="multi" @click="prev()" aria-label="Imaginea anterioară">
              <span class="material-symbols-outlined">chevron_left</span>
            </button>
            <button class="mtz-lb__nav mtz-lb__nav--next" x-show="multi" @click="next()" aria-label="Imaginea următoare">
              <span class="material-symbols-outlined">chevron_right</span>
            </button>

            <div class="mtz-lb__inner" @touchstart.passive="touchStart($event)" @touchend="touchEnd($event)">
              <template x-for="(s, idx) in slides" :key="idx">
                <img class="mtz-lb__img" :class="{ 'mtz-lb__img--sheet': s.sheet }" :src="s.src" :alt="s.caption" x-show="i === idx" draggable="false"/>
              </template>
            </div>
          </div>
        </template>
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
            <p class="mtz-stat" style="font-size:var(--text-3xl);">{{ $areaText }}</p>
          </div>
          <div>
            <span class="mtz-label">Etaj</span>
            <p class="mtz-stat" style="font-size:var(--text-3xl);">{{ $apartment['floor'] === 0 ? 'Parter' : $apartment['floor'] }}</p>
          </div>
          <div>
            <span class="mtz-label">Preț</span>
            <p class="mtz-stat" style="font-size:var(--text-3xl);">{{ $apartment['price'] ?? 'La cerere' }}</p>
          </div>
        </div>

        {{-- Detalii secundare --}}
        <div class="flex flex-col gap-4" style="padding-bottom:2rem;border-bottom:1px solid var(--color-outline-variant);">
          @php
            $hasBalcony = array_key_exists('balcony', $apartment)
                ? $apartment['balcony']
                : ! empty($apartment['balcony_area']);
          @endphp
          <div class="mtz-detail-row">
            <span class="mtz-caption">Balcon</span>
            <span class="mtz-body-sm" style="color:var(--color-text-primary);">{{ $hasBalcony ? 'Da' : 'Nu' }}</span>
          </div>
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
          style="width:100%;padding:1.25rem 2rem;white-space:normal;line-height:1.5;"
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
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
        <div>
          <span class="mtz-label-dark">Contact direct</span>
          <p class="mtz-body-dark" style="font-size:var(--text-3xl);line-height:1.35;color:rgba(249,248,246,0.92);overflow-wrap:anywhere;">{{ $building['phone'] }}</p>
          <p class="mtz-body-dark" style="font-size:var(--text-3xl);line-height:1.35;color:rgba(249,248,246,0.92);overflow-wrap:anywhere;">{{ $building['email'] }}</p>
        </div>
        <div>
          <span class="mtz-label-dark">Program</span>
          <p class="mtz-body-dark" style="font-size:var(--text-3xl);line-height:1.35;color:rgba(249,248,246,0.92);">Lun–Vin: 9:00–18:00<br/>Sâmbătă: 10:00–14:00</p>
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

@push('scripts')
<script>
  function aptGallery(slides) {
    return {
      slides,
      open: false,
      i: 0,
      _touchX: null,

      get multi() { return this.slides.length > 1; },

      show(idx) {
        this.i = idx || 0;
        this.open = true;
        document.documentElement.style.overflow = 'hidden';
      },
      close() {
        this.open = false;
        document.documentElement.style.overflow = '';
      },
      next() { if (this.multi) this.i = (this.i + 1) % this.slides.length; },
      prev() { if (this.multi) this.i = (this.i - 1 + this.slides.length) % this.slides.length; },

      onKey(e) {
        if (!this.open) return;
        if (e.key === 'Escape') this.close();
        else if (e.key === 'ArrowRight') this.next();
        else if (e.key === 'ArrowLeft') this.prev();
      },

      touchStart(e) { this._touchX = e.changedTouches[0].clientX; },
      touchEnd(e) {
        if (this._touchX === null) return;
        const dx = e.changedTouches[0].clientX - this._touchX;
        if (Math.abs(dx) > 40) { dx < 0 ? this.next() : this.prev(); }
        this._touchX = null;
      },
    };
  }
</script>
@endpush
