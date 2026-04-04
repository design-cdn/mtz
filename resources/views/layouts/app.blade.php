<!DOCTYPE html>
<html lang="ro">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta name="csrf-token" content="{{ csrf_token() }}"/>

  <title>@yield('title', __('meta.home.title'))</title>
  <meta name="description" content="@yield('description', __('meta.home.description'))"/>

  {{-- Fonturi --}}
  <link rel="preconnect" href="https://fonts.googleapis.com"/>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=optional" rel="stylesheet"/>

  {{-- CSS via Vite --}}
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  {{-- GSAP + ScrollTrigger --}}
  <script src="https://cdn.jsdelivr.net/npm/gsap@3/dist/gsap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/gsap@3/dist/ScrollTrigger.min.js"></script>

  {{-- Alpine.js v3 --}}
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3/dist/cdn.min.js"></script>

  {{-- Leaflet.js — hartă interactivă --}}
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin=""/>
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>

  @stack('head')
</head>
<body>

  {{-- ═══ NAV ═══ --}}
  <x-nav :active-route="$activeRoute ?? 'home'"/>

  {{-- ═══ MENIU MOBIL OVERLAY ═══ --}}
  {{--
    Direct pe body — scapă complet de orice stacking context.
    $store.nav este definit în app.js și shared între nav și overlay.
  --}}
  <div
    id="mobile-menu-overlay"
    class="mtz-nav__mobile"
    :class="{ 'mtz-nav__mobile--open': $store.nav.open }"
    aria-modal="true"
    role="dialog"
    x-data
  >

    {{-- Header: logo centrat + buton X --}}
    <div class="mtz-nav__mobile-header">
      <a href="{{ route('home') }}" class="mtz-nav__mobile-logo" @click="$store.nav.close()">
        {{ __('footer.logo') }}
      </a>
      <button
        class="mtz-nav__mobile-close"
        @click="$store.nav.close()"
        aria-label="Închide meniu"
      >✕</button>
    </div>

    {{-- Iteme meniu --}}
    <nav class="mtz-nav__mobile-items" aria-label="{{ __('nav.mobile_label') }}">

      <a href="{{ route('home') }}"
         class="mtz-nav__mobile-item"
         @click="$store.nav.close()">
        <span class="mtz-nav__mobile-num">01</span>
        <span class="mtz-nav__mobile-label">{{ __('nav.home') }}</span>
        <span class="mtz-nav__mobile-arrow" aria-hidden="true">↗</span>
      </a>

      <a href="{{ route('home') }}#apartamente"
         class="mtz-nav__mobile-item"
         @click="$store.nav.close()">
        <span class="mtz-nav__mobile-num">02</span>
        <span class="mtz-nav__mobile-label">{{ __('nav.apartments') }}</span>
        <span class="mtz-nav__mobile-arrow" aria-hidden="true">↗</span>
      </a>

      <a href="{{ route('home') }}#proiect"
         class="mtz-nav__mobile-item"
         @click="$store.nav.close()">
        <span class="mtz-nav__mobile-num">03</span>
        <span class="mtz-nav__mobile-label">{{ __('nav.project') }}</span>
        <span class="mtz-nav__mobile-arrow" aria-hidden="true">↗</span>
      </a>

      <a href="{{ route('home') }}#localizare"
         class="mtz-nav__mobile-item"
         @click="$store.nav.close()">
        <span class="mtz-nav__mobile-num">04</span>
        <span class="mtz-nav__mobile-label">{{ __('nav.location') }}</span>
        <span class="mtz-nav__mobile-arrow" aria-hidden="true">↗</span>
      </a>

      <a href="{{ route('progres.index') }}"
         class="mtz-nav__mobile-item"
         @click="$store.nav.close()">
        <span class="mtz-nav__mobile-num">05</span>
        <span class="mtz-nav__mobile-label">{{ __('nav.progress') }}</span>
        <span class="mtz-nav__mobile-arrow" aria-hidden="true">↗</span>
      </a>

      <a href="{{ route('contact.index') }}"
         class="mtz-nav__mobile-item"
         @click="$store.nav.close()">
        <span class="mtz-nav__mobile-num">06</span>
        <span class="mtz-nav__mobile-label">{{ __('nav.contact') }}</span>
        <span class="mtz-nav__mobile-arrow" aria-hidden="true">↗</span>
      </a>

    </nav>

    {{-- Footer: social + CTA --}}
    <div class="mtz-nav__mobile-footer">
      <div class="mtz-nav__mobile-social">
        <a href="#" class="mtz-nav__mobile-social-link" rel="noopener noreferrer">{{ __('footer.instagram') }}</a>
        <a href="#" class="mtz-nav__mobile-social-link" rel="noopener noreferrer">{{ __('footer.facebook') }}</a>
      </div>
      <button
        class="mtz-btn-nav"
        @click="$store.nav.close(); $dispatch('open-modal')"
      >{{ __('nav.cta') }}</button>
    </div>

  </div>

  {{-- ═══ MAIN ═══ --}}
  <main>
    @yield('content')
  </main>

  {{-- ═══ FOOTER ═══ --}}
  <x-footer/>

  {{-- ═══ STICKY WHATSAPP ═══ --}}
  <x-whatsapp-sticky :phone="config('apartments.building.whatsapp')"/>

  {{-- ═══ MODAL OFERTĂ ═══ --}}
  <x-oferta-modal/>

  @stack('scripts')
</body>
</html>

