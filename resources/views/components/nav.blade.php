@props(['activeRoute' => 'home'])

<nav
  id="mtz-nav"
  class="mtz-nav"
  x-data="{ scrolled: false, overHero: false }"
  x-init="
    const heroEl = document.getElementById('hero');
    overHero = !!heroEl && window.scrollY < (window.innerHeight * 0.85);
    scrolled  = window.scrollY > 20;
    window.addEventListener('scroll', () => {
      scrolled  = window.scrollY > 20;
      overHero  = !!heroEl && window.scrollY < (window.innerHeight * 0.85);
    });
  "
  :class="{
    'mtz-nav--scrolled': scrolled && !$store.nav.open,
    'mtz-nav--hero':    !scrolled && overHero && !$store.nav.open
  }"
>

  {{-- ── BARA PRINCIPALĂ ── --}}
  <div class="mtz-nav__inner">

    {{-- Logo --}}
    <a href="{{ route('home') }}" class="mtz-nav__logo">
      {{ __('footer.logo') }}
    </a>

    {{-- Desktop links — centrate absolut pe viewport --}}
    <div class="mtz-nav__links">
      <a href="{{ route('home') }}"
         class="mtz-nav__link {{ $activeRoute === 'home'    ? 'mtz-nav__link--active' : '' }}"
      >{{ __('nav.home') }}</a>

      <a href="{{ route('home') }}#apartamente" class="mtz-nav__link"
      >{{ __('nav.apartments') }}</a>

      <a href="{{ route('home') }}#proiect" class="mtz-nav__link"
      >{{ __('nav.project') }}</a>

      <a href="{{ route('home') }}#localizare" class="mtz-nav__link"
      >{{ __('nav.location') }}</a>

      <a href="{{ route('progres.index') }}"
         class="mtz-nav__link {{ $activeRoute === 'progres' ? 'mtz-nav__link--active' : '' }}"
      >{{ __('nav.progress') }}</a>

      <a href="{{ route('contact.index') }}"
         class="mtz-nav__link {{ $activeRoute === 'contact' ? 'mtz-nav__link--active' : '' }}"
      >{{ __('nav.contact') }}</a>
    </div>

    {{-- Dreapta: CTA + WA + Hamburger --}}
    <div class="mtz-nav__actions">

      <button
        id="nav-cta-btn"
        class="mtz-btn-nav mtz-nav__cta-desktop"
        @click="$dispatch('open-modal')"
        aria-label="{{ __('nav.cta') }}"
      >{{ __('nav.cta') }}</button>

      <a
        class="mtz-btn-wa mtz-nav__wa-desktop"
        href="https://wa.me/{{ config('apartments.building.whatsapp') }}"
        target="_blank"
        rel="noopener noreferrer"
        aria-label="WhatsApp"
      >
        <x-icon-whatsapp class="w-4 h-4"/>
        <span>{{ __('nav.whatsapp') }}</span>
      </a>

      {{-- Hamburger — vizibil doar pe mobile --}}
      <button
        class="mtz-nav__hamburger"
        @click="$store.nav.toggle()"
        :aria-expanded="$store.nav.open"
        aria-label="Meniu"
      >
        <span class="mtz-nav__hamburger-bar" :class="{ 'mtz-nav__hamburger-line--top-open': $store.nav.open }"></span>
        <span class="mtz-nav__hamburger-bar" :class="{ 'mtz-nav__hamburger-line--mid-open': $store.nav.open }"></span>
        <span class="mtz-nav__hamburger-bar" :class="{ 'mtz-nav__hamburger-line--bot-open': $store.nav.open }"></span>
      </button>

    </div>
  </div>

</nav>
