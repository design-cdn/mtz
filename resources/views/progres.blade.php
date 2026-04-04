@extends('layouts.app')

@section('title', __('meta.progress.title'))
@section('description', __('meta.progress.description'))

@php $activeRoute = 'progres'; @endphp

@section('content')

<div style="padding-top:var(--nav-h);">

  {{-- ═══ INTRO ═══ --}}
  <section class="mtz-section mtz-section-surface mtz-border-top">
    <div class="mtz-container">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-20">
        <div class="lg:col-span-5" data-animate="fade-up">
          <span class="mtz-label">{{ $building['name'] }} · {{ $building['location'] }}</span>
          <h1 class="mtz-h1">Progres<br/>Șantier</h1>
          <hr class="mtz-divider"/>
        </div>
        <div class="lg:col-span-6 lg:col-start-7 flex flex-col justify-end gap-6" data-animate="fade-up">
          <p class="mtz-body-lg">Actualizăm această pagină lunar cu poze reale de pe șantier, ca să poți urmări evoluția lucrărilor pas cu pas — indiferent dacă ești viitor proprietar sau vrei să te asiguri că totul merge conform planului.</p>
          <p class="mtz-body-lg">Nu promitem randări. Promitem transparență.</p>
        </div>
      </div>
    </div>
  </section>

  {{-- ═══ ACTUALIZĂRI ═══ --}}
  @foreach($updates as $i => $update)
    <section class="mtz-section {{ $i % 2 === 0 ? 'mtz-section-bg' : 'mtz-section-surface' }} overflow-hidden mtz-border-top">
      <div class="mtz-container">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-20">

          {{-- Sidebar sticky --}}
          <div class="lg:col-span-3 lg:sticky lg:top-32 self-start" data-animate="fade-up">
            <span class="mtz-label-secondary" style="display:block;margin-bottom:1rem;">{{ __('progres.update_label') }}</span>
            <h2 class="mtz-h2" style="font-size:var(--text-5xl);">
              {{ $update['month'] }}<br/>{{ $update['year'] }}
            </h2>
            <div style="margin-top:1.5rem;padding-top:1.5rem;border-top:1px solid var(--color-outline-variant);">
              <p class="mtz-body-sm">{{ $update['description'] }}</p>
            </div>
          </div>

          {{-- Galerie cu lightbox --}}
          <div
            class="lg:col-span-9"
            x-data='mtzLightbox(@json($update["images"]))'
            @keydown.escape.window="open = false"
            @keydown.arrow-left.window="open && go(-1)"
            @keydown.arrow-right.window="open && go(1)"
          >
            @if(isset($update['images'][0]))
              <div
                class="mtz-img-wrap mtz-img-wrap--clickable"
                style="height:32rem;"
                @click="openAt(0)"
                role="button"
                tabindex="0"
                @keydown.enter="openAt(0)"
                aria-label="{{ __('progres.open_gallery') }}"
              >
                <img
                  class="mtz-img"
                  src="{{ $update['images'][0]['src'] }}"
                  alt="{{ $update['images'][0]['alt'] }}"
                  loading="lazy"
                />
                <div class="mtz-img-overlay">
                  <span class="material-symbols-outlined mtz-img-overlay__icon">open_in_full</span>
                  <span class="mtz-caption" style="color:rgba(249,248,246,0.75);">
                    {{ __('progres.view_gallery') }} &middot; {{ count($update['images']) }} {{ __('progres.photos') }}
                  </span>
                </div>
                <div class="mtz-img-badge">
                  <span class="material-symbols-outlined">photo_library</span>
                  {{ count($update['images']) }} {{ __('progres.photos') }}
                </div>
              </div>
            @endif

            {{-- Lightbox --}}
            <template x-teleport="body">
              <div
                class="mtz-lightbox"
                x-show="open"
                x-transition.opacity.duration.300ms
                style="display:none;"
                @touchstart.passive="onTouchStart($event)"
                @touchend.passive="onTouchEnd($event)"
              >
                <div class="mtz-lightbox__bg" @click="open = false"></div>

                <button class="mtz-lb__close" @click="open = false" aria-label="{{ __('progres.close') }}">
                  <span class="material-symbols-outlined">close</span>
                </button>

                <div class="mtz-lb__counter">
                  <span x-text="index + 1"></span>&thinsp;/&thinsp;{{ count($update['images']) }}
                </div>

                <div class="mtz-lb__inner">
                  <img class="mtz-lb__img" :src="images[index].src" :alt="images[index].alt" />
                </div>

                @if(count($update['images']) > 1)
                  <button class="mtz-lb__nav mtz-lb__nav--prev" @click="go(-1)" aria-label="{{ __('progres.prev') }}">
                    <span class="material-symbols-outlined">arrow_back</span>
                  </button>
                  <button class="mtz-lb__nav mtz-lb__nav--next" @click="go(1)" aria-label="{{ __('progres.next') }}">
                    <span class="material-symbols-outlined">arrow_forward</span>
                  </button>
                @endif
              </div>
            </template>

          </div>
        </div>
      </div>
    </section>
  @endforeach

  {{-- ═══ CTA VIZITĂ ═══ --}}
  <section class="mtz-section mtz-section-dark">
    <div class="max-w-4xl mx-auto text-center" style="padding:0 var(--container-px);">
      <span class="mtz-label-dark" style="letter-spacing:var(--ls-label-xl);">Vrei să vezi cu ochii tăi?</span>
      <h2 class="mtz-h2-dark" style="margin-bottom:var(--space-xl);" data-animate="fade-up">
        Organizăm vizite<br/>pe șantier.
      </h2>
      <p class="mtz-body-dark" style="max-width:36rem;margin:0 auto var(--space-xl);">
        Dacă vrei să vezi stadiul lucrărilor în persoană, sună-ne sau scrie-ne pe WhatsApp și stabilim o oră convenabilă. Durează 30 de minute și îți răspundem la orice întrebare pe loc.
      </p>
      <div class="flex flex-col sm:flex-row justify-center gap-4" data-animate="fade-up">
        <a
          href="https://wa.me/{{ $building['whatsapp'] }}?text={{ urlencode('Bună ziua, aș vrea să programez o vizită pe șantierul MTZ Nord Residence.') }}"
          class="mtz-btn mtz-btn-cta"
          target="_blank"
          rel="noopener noreferrer"
        >
          <x-icon-whatsapp class="w-4 h-4"/>
          Programează vizita
        </a>
        <a href="tel:{{ $building['phone'] }}" class="mtz-btn mtz-btn-outline-light">
          <span class="material-symbols-outlined mtz-icon-sm">call</span>
          {{ $building['phone'] }}
        </a>
      </div>
    </div>
  </section>

</div>

@endsection
