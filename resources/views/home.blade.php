@extends('layouts.app')

@section('title', __('meta.home.title'))
@section('description', __('meta.home.description'))

@section('content')

  {{-- ═══════════════════════════════════════════════
       HERO — full viewport cu selector etaje Alpine.js
  ════════════════════════════════════════════════════ --}}
  <section
    class="mtz-hero"
    x-data="floorSelector({{ $floorData->toJson() }})"
    id="hero"
  >
    {{-- Background image --}}
    <img
      src="{{ asset('images/hero.jpg') }}"
      alt="MTZ Nord Residence — vedere exterioară"
      class="mtz-hero__bg"
      id="hero-bg"
      fetchpriority="high"
    />
    <div class="mtz-hero__overlay"></div>

    {{-- Headline --}}
    <div class="mtz-hero__headline" x-show="view === 'facade'" x-transition:leave="transition duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
      <span class="mtz-hero__location">{{ __('hero.location') }}</span>
      <h1 class="mtz-hero__title">
        {{ __('hero.title_line1') }}<br/>
        <em>{{ __('hero.title_line2') }}</em>
      </h1>
    </div>

    {{-- Selector de etaje --}}
    <div class="mtz-selector">

      {{-- VEDERE FAȚADĂ --}}
      <div
        x-ref="facade"
        x-show="view === 'facade'"
        x-transition:enter="transition ease-out duration-400"
        x-transition:enter-start="opacity-0 translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-250"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-2"
        style="display:none; width:100%;"
      >
        <p class="mtz-selector__label">{{ __('hero.select_floor') }}</p>
        <div class="mtz-selector__facade">
          <div class="mtz-selector__floors">
            <template x-for="floor in floorsReversed" :key="floor.number">
              <button
                type="button"
                class="mtz-selector__floor"
                :class="{ 'mtz-selector__floor--active': selectedFloor === floor.number }"
                @click="selectFloor(floor.number)"
                :aria-label="`Selectează etajul ${floor.number}`"
              >
                <span class="mtz-selector__floor-label" x-text="floor.label"></span>
                <span class="mtz-selector__floor-count" x-text="`${floor.apartments.length} ap.`"></span>
              </button>
            </template>
          </div>
        </div>
      </div>

      {{-- PLAN ETAJ --}}
      <div
        x-ref="plan"
        x-show="view === 'plan'"
        x-transition:enter="transition ease-out duration-400"
        x-transition:enter-start="opacity-0 translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        style="display:none; width:100%;"
      >
        <div class="mtz-selector__plan">

          {{-- Header plan --}}
          <div class="mtz-selector__plan-header">
            <button type="button" class="mtz-selector__back" @click="goBack()">
              <span class="material-symbols-outlined mtz-icon-base">arrow_back</span>
              {{ __('hero.back') }}
            </button>
            <span class="mtz-selector__plan-title" x-text="`{{ __('hero.plan_title', ['number' => '']) }}` + selectedFloor"></span>
          </div>

          {{-- Grid apartamente --}}
          <div
            class="mtz-plan-grid"
            :style="`grid-template-columns: repeat(${currentFloorApartments.length}, 1fr);`"
          >
            <template x-for="apt in currentFloorApartments" :key="apt.id">
              <a
                :href="apt.url"
                class="mtz-plan-apt"
                :class="`mtz-plan-apt--${apt.status}`"
                @mousemove="showTooltip($event, apt)"
                @mouseleave="hideTooltip()"
                :aria-label="`Apartament ${apt.label} — ${getStatusLabel(apt.status)}`"
              >
                <span class="mtz-plan-apt__label" x-text="apt.label"></span>
                <span class="mtz-plan-apt__rooms" x-text="`${apt.rooms} cam · ${apt.area} m²`"></span>
              </a>
            </template>
          </div>

        </div>
      </div>

    </div>

    {{-- Tooltip apartament --}}
    <div
      id="apt-tooltip"
      class="mtz-apt-tooltip"
      x-show="tooltip.visible"
      x-transition:enter="transition duration-100"
      x-transition:enter-start="opacity-0"
      x-transition:enter-end="opacity-100"
      :style="`left:${tooltip.x}px; top:${tooltip.y}px;`"
      style="display:none;"
    >
      <span class="mtz-apt-tooltip__label" x-text="tooltip.label"></span>
      <div class="mtz-apt-tooltip__row">
        <span class="mtz-apt-tooltip__key">Camere</span>
        <span class="mtz-apt-tooltip__val" x-text="tooltip.rooms + ' cam'"></span>
      </div>
      <div class="mtz-apt-tooltip__row">
        <span class="mtz-apt-tooltip__key">Suprafață</span>
        <span class="mtz-apt-tooltip__val" x-text="tooltip.area + ' m²'"></span>
      </div>
      <div class="mtz-apt-tooltip__row">
        <span class="mtz-apt-tooltip__key">Orientare</span>
        <span class="mtz-apt-tooltip__val" x-text="tooltip.orientation"></span>
      </div>
      <div class="mtz-apt-tooltip__row" style="margin-top:4px;">
        <span class="mtz-apt-tooltip__key">Status</span>
        <span class="mtz-apt-tooltip__val" x-text="getStatusLabel(tooltip.status)"></span>
      </div>
    </div>

    {{-- Scroll indicator --}}
    <div class="mtz-hero__scroll" x-show="view === 'facade'" @click="document.getElementById('proiect').scrollIntoView({behavior:'smooth'})">
      <div class="mtz-hero__scroll-line">
        <div class="mtz-scroll-line"></div>
      </div>
      <span class="mtz-hero__scroll-text">{{ __('hero.scroll') }}</span>
    </div>

  </section>

  {{-- ═══════════════════════════════════════════════
       DESPRE PROIECT
  ════════════════════════════════════════════════════ --}}
  <section id="proiect" class="mtz-section mtz-section-surface">
    <div class="mtz-container">
      <div class="grid grid-cols-1 md:grid-cols-12 gap-16 lg:gap-24">
        <div class="md:col-span-5" data-animate="fade-up">
          <span class="mtz-label">{{ __('nav.project') }}</span>
          <h2 class="mtz-h2">Un loc în care să te întorci cu drag.</h2>
          <hr class="mtz-divider"/>
        </div>
        <div class="md:col-span-5 md:col-start-7 flex flex-col gap-6" data-animate="fade-up">
          <p class="mtz-body-lg">MTZ Nord Residence este un ansamblu rezidențial nou construit în Mangalia, la câțiva pași de mare. Cinci etaje, apartamente cu una până la patru camere, materiale de calitate și spații gândite să fie cu adevărat locuibile — nu doar frumoase în randări.</p>
          <p class="mtz-body-lg">Mangalia rămâne una dintre puținele zone de pe litoral unde liniștea nu e un lux. Fără aglomerație de sezon, fără zgomot. Un loc în care poți veni în weekend, în vacanță sau să te stabilești definitiv.</p>
        </div>
      </div>
    </div>
  </section>

  {{-- ═══════════════════════════════════════════════
       CIFRE CHEIE
  ════════════════════════════════════════════════════ --}}
  <section class="mtz-section-sm mtz-section-bg mtz-border-y">
    <div class="mtz-container">
      <div class="mb-16" data-animate="fade-up">
        <span class="mtz-label">Proiect în cifre</span>
        <h2 class="mtz-h2">Date definitorii</h2>
      </div>
      <div class="grid grid-cols-2 lg:grid-cols-4 gap-12 md:gap-24">
        <div class="flex flex-col items-center md:items-start text-center md:text-left" data-animate="fade-up">
          <span class="mtz-stat" data-counter="{{ $stats['floors'] }}">{{ $stats['floors'] }}</span>
          <span class="mtz-label" style="margin-top:1rem;margin-bottom:0;">Etaje</span>
        </div>
        <div class="flex flex-col items-center md:items-start text-center md:text-left" data-animate="fade-up">
          <span class="mtz-stat">{{ $stats['rooms_range'] }}</span>
          <span class="mtz-label" style="margin-top:1rem;margin-bottom:0;">Camere disponibile</span>
        </div>
        <div class="flex flex-col items-center md:items-start text-center md:text-left" data-animate="fade-up">
          <span class="mtz-stat">{{ $stats['quality'] }}</span>
          <span class="mtz-label" style="margin-top:1rem;margin-bottom:0;">Materiale de calitate</span>
        </div>
        <div class="flex flex-col items-center md:items-start text-center md:text-left" data-animate="fade-up">
          <span class="mtz-stat">{{ $stats['year'] }}</span>
          <span class="mtz-label" style="margin-top:1rem;margin-bottom:0;">An finalizare</span>
        </div>
      </div>
    </div>
  </section>

  {{-- ═══════════════════════════════════════════════
       GALERIE
  ════════════════════════════════════════════════════ --}}
  <section id="galerie" class="mtz-section-sm mtz-section-surface overflow-hidden">
    <div class="mtz-container">
      <div class="flex items-end justify-between mb-16 lg:mb-20" data-animate="fade-up">
        <div>
          <span class="mtz-label">Galerie</span>
          <h2 class="mtz-h2">Randări proiect</h2>
        </div>
        <a class="group flex items-center gap-3 pb-1 border-b border-[var(--color-outline-variant)] hover:border-[var(--color-primary)] transition-colors" href="#">
          <span class="mtz-caption" style="letter-spacing:0.1em;color:var(--color-text-primary);">VEZI TOATE</span>
          <span class="material-symbols-outlined mtz-icon-base" style="color:var(--color-text-primary);">arrow_forward</span>
        </a>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-start">
        <div class="md:col-span-7 relative" data-animate="fade-up">
          <div class="mtz-img-wrap aspect-[4/5]">
            <img
              class="mtz-img"
              src="{{ asset('images/hero.jpg') }}"
              alt="MTZ Nord Residence — vedere exterioară"
              loading="lazy"
            />
          </div>
          <div class="mtz-gallery-caption hidden md:block">
            <p class="mtz-label-secondary" style="margin-bottom:0.5rem;">Exterior · Vedere nocturnă</p>
            <p class="mtz-body-sm">Fațada MTZ Nord Residence — cinci etaje cu balcoane generoase, tâmplărie modernă și vegetație integrată în arhitectura clădirii.</p>
          </div>
        </div>
        <div class="md:col-span-4 md:col-start-9 mt-0 md:mt-24" data-animate="fade-up">
          <div class="mtz-img-wrap aspect-[3/4] mb-6">
            <img
              class="mtz-img"
              src="{{ asset('images/hero.jpg') }}"
              alt="MTZ Nord Residence — interior"
              loading="lazy"
            />
          </div>
          <h4 class="mtz-h4">Finisaje care contează</h4>
          <p class="mtz-body-sm">Pardoseală, dulap integrat, iluminat indirect — detalii care fac diferența dintre un apartament și un acasă.</p>
        </div>
      </div>
    </div>
  </section>

  {{-- ═══════════════════════════════════════════════
       CE PRIMEȘTI (HIGHLIGHTS)
  ════════════════════════════════════════════════════ --}}
  <section id="apartamente" class="mtz-section mtz-section-surface mtz-border-top">
    <div class="mtz-container">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 lg:gap-24">
        <div class="lg:col-span-4" data-animate="fade-up">
          <div class="mb-12">
            <span class="mtz-label">De ce MTZ Nord</span>
            <h2 class="mtz-h2">Ce primești când cumperi aici.</h2>
            <hr class="mtz-divider"/>
          </div>
          <div class="mtz-img-wrap aspect-[4/5] shadow-xl">
            <img
              class="mtz-img"
              src="{{ asset('images/hero.jpg') }}"
              alt="MTZ Nord Residence — interior"
              loading="lazy"
            />
          </div>
        </div>
        <div class="lg:col-span-7 lg:col-start-6">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12">
            @php
              $features = [
                ['num' => '01', 'title' => 'Materiale de calitate',     'body' => 'Pardoseală, tâmplărie și finisaje selectate pentru durată, nu doar pentru randări. Ce vezi în proiect e ce primești la predare.'],
                ['num' => '02', 'title' => 'Spații verzi amenajate',    'body' => 'Vegetație integrată în fațadă și curte amenajată la sol — nu doar spații libere lăsate în beton.'],
                ['num' => '03', 'title' => 'Instalații moderne',        'body' => 'Sistem de climatizare, instalații electrice și sanitare dimensionate corect — nu la limita normativului.'],
                ['num' => '04', 'title' => 'Construcție sustenabilă',   'body' => 'Izolație termică superioară și materiale cu impact redus — costuri mai mici la întreținere pe termen lung.'],
                ['num' => '05', 'title' => 'Parcare inclusă',           'body' => 'Loc de parcare dedicat pentru fiecare apartament, în curtea ansamblului. Fără bătăi de cap la final de zi.'],
                ['num' => '06', 'title' => 'Număr mic de apartamente',  'body' => 'Un bloc, un număr limitat de unități. Știi cine îți sunt vecinii, nu ești unul din sute.'],
              ];
            @endphp
            @foreach($features as $f)
              <div class="py-10 border-b border-[var(--color-outline-variant)]/30" data-animate="fade-up">
                <div class="flex items-start gap-6">
                  <span class="mtz-feature-num">{{ $f['num'] }}</span>
                  <div>
                    <h3 class="mtz-h3">{{ $f['title'] }}</h3>
                    <p class="mtz-body">{{ $f['body'] }}</p>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </section>

  <x-location-map />




  {{-- ═══════════════════════════════════════════════
       CTA WHATSAPP
  ════════════════════════════════════════════════════ --}}
  <section class="mtz-section mtz-section-dark">
    <div class="max-w-4xl mx-auto text-center" style="padding:0 var(--container-px);">
      <span class="mtz-label-dark" style="letter-spacing:var(--ls-label-xl);">Vorbim?</span>
      <h2 class="mtz-h2-dark" style="margin-bottom:var(--space-xl);" data-animate="fade-up">
        Ai întrebări despre<br/>un apartament?
      </h2>
      <p class="mtz-body-dark" style="text-transform:uppercase;letter-spacing:0.08em;font-size:var(--text-xs);margin-bottom:var(--space-xl);">
        Scrie-ne pe WhatsApp — răspundem în câteva ore, nu zile
      </p>
      <div class="flex justify-center" data-animate="fade-up">
        <a
          class="mtz-btn mtz-btn-cta"
          href="https://wa.me/{{ $building['whatsapp'] }}"
          target="_blank"
          rel="noopener noreferrer"
        >
          <x-icon-whatsapp class="w-5 h-5"/>
          Discută pe WhatsApp
        </a>
      </div>
    </div>
  </section>

  <x-contact-section />


@endsection

@push('scripts')
<script>
function floorSelector(floors) {
  return {
    floors,
    view: 'facade',
    selectedFloor: null,
    tooltip: { visible: false, x: 0, y: 0, label: '', rooms: 0, area: 0, orientation: '', status: '' },

    // Etajele în ordine descrescătoare pentru display (5 → 1)
    get floorsReversed() {
      return [...this.floors].reverse();
    },

    get currentFloorApartments() {
      if (!this.selectedFloor) return [];
      const fl = this.floors.find(f => f.number === this.selectedFloor);
      return fl ? fl.apartments : [];
    },

    selectFloor(floorNumber) {
      this.selectedFloor = floorNumber;
      // Tranziție: ascunde fațada, arată planul
      gsap.to(this.$refs.facade, {
        opacity: 0,
        y: -8,
        duration: 0.25,
        ease: 'power2.in',
        onComplete: () => {
          this.view = 'plan';
          gsap.fromTo(this.$refs.plan,
            { opacity: 0, y: 8 },
            { opacity: 1, y: 0, duration: 0.35, ease: 'power2.out' }
          );
        }
      });
    },

    goBack() {
      gsap.to(this.$refs.plan, {
        opacity: 0,
        y: 8,
        duration: 0.2,
        ease: 'power2.in',
        onComplete: () => {
          this.view = 'facade';
          this.selectedFloor = null;
          gsap.fromTo(this.$refs.facade,
            { opacity: 0, y: -8 },
            { opacity: 1, y: 0, duration: 0.3, ease: 'power2.out' }
          );
        }
      });
    },

    getStatusLabel(status) {
      const labels = {
        available: '{{ __("hero.status.available") }}',
        sold:      '{{ __("hero.status.sold") }}',
        rented:    '{{ __("hero.status.rented") }}',
      };
      return labels[status] ?? status;
    },

    showTooltip(event, apt) {
      this.tooltip = {
        visible: true,
        x: event.clientX,
        y: event.clientY,
        label: `Ap. ${apt.label}`,
        rooms: apt.rooms,
        area: apt.area,
        orientation: apt.orientation,
        status: apt.status,
      };
    },

    hideTooltip() {
      this.tooltip.visible = false;
    },
  };
}
</script>


@endpush
