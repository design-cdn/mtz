@extends('layouts.app')

@section('title', __('meta.contact.title'))
@section('description', __('meta.contact.description'))

@php $activeRoute = 'contact'; @endphp

@section('content')

<div style="padding-top:var(--nav-h);">

  {{-- ═══════════════════════════════════════════════
       HERO CONTACT — Editorial layout cu datele de contact
  ════════════════════════════════════════════════════ --}}
  <section class="mtz-section mtz-section-surface mtz-border-top">
    <div class="mtz-container">

      {{-- Titlu principal --}}
      <div class="mb-20 lg:mb-28" data-animate="fade-up">
        <span class="mtz-label">{{ __('contact.page_label') }}</span>
        <h1 class="mtz-h1" style="font-size:var(--text-display);">{{ __('contact.page_title') }}</h1>
      </div>

      {{-- Grid date contact — layout editorial --}}
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-0">

        {{-- Coloana 1: Adresă --}}
        <div
          class="py-12 pr-8 border-b border-[var(--color-outline-variant)] md:border-b-0 md:border-r"
          data-animate="fade-up"
        >
          <span class="material-symbols-outlined mtz-contact-info-icon">location_on</span>
          <span class="mtz-label">{{ __('contact.address_l') }}</span>
          <p class="mtz-body-lg" style="margin-top:0.5rem;">{{ $building['address'] }}</p>
        </div>

        {{-- Coloana 2: Telefon --}}
        <div
          class="py-12 md:px-8 border-b border-[var(--color-outline-variant)] md:border-b-0 lg:border-r"
          data-animate="fade-up"
        >
          <span class="material-symbols-outlined mtz-contact-info-icon">call</span>
          <span class="mtz-label">{{ __('contact.phone_l') }}</span>
          <a
            href="tel:{{ $building['phone'] }}"
            class="mtz-body-lg"
            style="margin-top:0.5rem;display:block;color:var(--color-text-muted);text-decoration:none;transition:color var(--transition-fast);"
            onmouseover="this.style.color='var(--color-text-primary)'"
            onmouseout="this.style.color='var(--color-text-muted)'"
          >{{ $building['phone'] }}</a>
        </div>

        {{-- Coloana 3: Email --}}
        <div
          class="py-12 lg:px-8 border-b border-[var(--color-outline-variant)] md:border-b-0 md:border-r lg:border-r"
          data-animate="fade-up"
        >
          <span class="material-symbols-outlined mtz-contact-info-icon">mail</span>
          <span class="mtz-label">{{ __('contact.email_l') }}</span>
          <a
            href="mailto:{{ $building['email'] }}"
            class="mtz-body-lg"
            style="margin-top:0.5rem;display:block;color:var(--color-text-muted);text-decoration:none;transition:color var(--transition-fast);word-break:break-all;"
            onmouseover="this.style.color='var(--color-text-primary)'"
            onmouseout="this.style.color='var(--color-text-muted)'"
          >{{ $building['email'] }}</a>
        </div>

        {{-- Coloana 4: Program --}}
        <div
          class="py-12 lg:pl-8"
          data-animate="fade-up"
        >
          <span class="material-symbols-outlined mtz-contact-info-icon">schedule</span>
          <span class="mtz-label">{{ __('contact.schedule_l') }}</span>
          <p class="mtz-body-lg" style="margin-top:0.5rem;white-space:pre-line;">{{ __('contact.schedule_v') }}</p>
        </div>

      </div>

      {{-- CTA strip --}}
      <div class="flex flex-col sm:flex-row items-start sm:items-center gap-6 pt-16 border-t border-[var(--color-outline-variant)]" data-animate="fade-up">
        <p class="mtz-body" style="max-width:28rem;">{{ __('contact.page_body') }}</p>
        <a
          href="https://wa.me/{{ $building['whatsapp'] }}"
          class="mtz-btn mtz-btn-primary flex-shrink-0"
          target="_blank"
          rel="noopener noreferrer"
        >
          <x-icon-whatsapp class="w-4 h-4"/>
          Scrie pe WhatsApp
        </a>
      </div>

    </div>
  </section>

  <x-location-map :mapId="'contact'" />


  <x-contact-section />


</div>

@endsection
