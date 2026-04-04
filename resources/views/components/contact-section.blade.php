@php
  /*
   * Componentă reutilizabilă: Secțiune Contact dark — sidebar + formular.
   * Citește datele din config('apartments.building') — fără a necesita
   * $building din controller.
   *
   * Utilizare:
   *   <x-contact-section />
   *
   * Props opționale:
   *   :sectionId="'contact'"   — id HTML pentru anchor/nav (default: 'contact')
   */
  $sectionBuilding = config('apartments.building', []);
@endphp

@props(['sectionId' => 'contact'])

<section id="{{ $sectionId }}" class="mtz-section-dark">
  <div class="mtz-container" style="padding-top:var(--space-2xl);padding-bottom:var(--space-2xl);">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 lg:gap-24">

      {{-- Stânga: info + CTA --}}
      <div class="lg:col-span-4" data-animate="fade-up">
        <span class="mtz-label-dark">{{ __('contact.section_label') }}</span>
        <h2 class="mtz-h2-dark" style="margin-bottom:var(--space-md);">{{ __('contact.section_title') }}</h2>
        <p class="mtz-body-dark">{{ __('contact.section_body') }}</p>

        {{-- Date contact --}}
        <div class="flex flex-col gap-6" style="margin-top:var(--space-xl);padding-top:var(--space-xl);border-top:1px solid rgba(255,255,255,0.08);">
          <div>
            <span class="mtz-label-dark">{{ __('contact.phone_l') }}</span>
            <a href="tel:{{ $sectionBuilding['phone'] }}"
               class="mtz-body-dark"
               style="color:var(--color-text-light);text-decoration:none;">
              {{ $sectionBuilding['phone'] }}
            </a>
          </div>
          <div>
            <span class="mtz-label-dark">{{ __('contact.email_l') }}</span>
            <a href="mailto:{{ $sectionBuilding['email'] }}"
               class="mtz-body-dark"
               style="color:var(--color-text-light);text-decoration:none;word-break:break-all;">
              {{ $sectionBuilding['email'] }}
            </a>
          </div>
          <div>
            <span class="mtz-label-dark">{{ __('contact.social_l') }}</span>
            <div class="flex gap-5 mt-2">
              {{-- Facebook --}}
              <a href="#" class="mtz-social-link" aria-label="Facebook" rel="noopener noreferrer" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true">
                  <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                </svg>
              </a>
              {{-- Instagram --}}
              <a href="#" class="mtz-social-link" aria-label="Instagram" rel="noopener noreferrer" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true">
                  <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                </svg>
              </a>
            </div>
          </div>
        </div>

        {{-- WhatsApp CTA --}}
        <a
          href="https://wa.me/{{ $sectionBuilding['whatsapp'] }}"
          class="mtz-btn-wa mtz-btn-wa--contact"
          target="_blank"
          rel="noopener noreferrer"
        >
          <x-icon-whatsapp class="w-4 h-4"/>
          {{ __('contact.whatsapp_link') }}
        </a>
      </div>

      {{-- Dreapta: formular --}}
      <div class="lg:col-span-8" data-animate="fade-up">
        <x-contact-form/>
      </div>

    </div>
  </div>
</section>
