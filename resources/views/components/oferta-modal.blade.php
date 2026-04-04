{{--
  Modal ofertă rapid — deschis din nav CTA sau din orice pagină.
  Controlat de evenimentul Alpine 'open-modal' / 'close-modal'.
--}}
<div
  x-data="{ open: false, success: false }"
  x-on:open-modal.window="open = true; success = false"
  x-on:close-modal.window="open = false"
  x-show="open"
  x-transition:enter="transition ease-out duration-200"
  x-transition:enter-start="opacity-0"
  x-transition:enter-end="opacity-100"
  x-transition:leave="transition ease-in duration-150"
  x-transition:leave-start="opacity-100"
  x-transition:leave-end="opacity-0"
  class="mtz-modal-backdrop"
  style="display: none;"
  @keydown.escape.window="open = false"
  @click.self="open = false"
  role="dialog"
  aria-modal="true"
  aria-labelledby="modal-title"
>
  <div
    class="mtz-modal"
    x-transition:enter="transition ease-out duration-250"
    x-transition:enter-start="opacity-0 scale-95 translate-y-4"
    x-transition:enter-end="opacity-100 scale-100 translate-y-0"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-95"
  >
    {{-- Header --}}
    <div class="mtz-modal__header">
      <span id="modal-title" class="mtz-label-dark" style="margin-bottom:0;">
        {{ __('contact.modal_title') }}
      </span>
      <button
        class="mtz-modal__close"
        @click="open = false"
        aria-label="Închide"
      >
        <span class="material-symbols-outlined mtz-icon">close</span>
      </button>
    </div>

    {{-- Body --}}
    <div class="mtz-modal__body">

      {{-- Succes --}}
      <div x-show="success" class="mtz-form-success" style="display:none;">
        <span class="material-symbols-outlined mtz-icon">check_circle</span>
        <span>{{ __('contact.success') }}</span>
      </div>

      {{-- Form --}}
      <div x-show="!success">
        <p class="mtz-body-dark" style="margin-bottom:var(--space-lg);">
          {{ __('contact.modal_body') }}
        </p>

        <form
          id="oferta-modal-form"
          action="{{ route('contact.oferta') }}"
          method="POST"
          class="flex flex-col gap-5"
          @submit.prevent="
            fetch($el.action, {
              method: 'POST',
              headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                'Accept': 'application/json',
              },
              body: new FormData($el)
            })
            .then(r => r.ok ? success = true : null)
            .catch(() => null)
          "
        >
          @csrf
          <div class="mtz-field">
            <label for="modal-f-name">{{ __('contact.field_fullname') }} *</label>
            <input
              id="modal-f-name"
              type="text"
              name="nume"
              placeholder="{{ __('contact.ph_fullname') }}"
              required
              autocomplete="name"
            />
          </div>
          <div class="mtz-field">
            <label for="modal-f-phone">{{ __('contact.field_phone') }} *</label>
            <input
              id="modal-f-phone"
              type="tel"
              name="telefon"
              placeholder="{{ __('contact.ph_phone') }}"
              required
              autocomplete="tel"
            />
          </div>
          <div class="mtz-field">
            <label for="modal-f-email">{{ __('contact.field_email') }}</label>
            <input
              id="modal-f-email"
              type="email"
              name="email"
              placeholder="{{ __('contact.ph_email') }}"
              autocomplete="email"
            />
          </div>
          <div class="mtz-checkbox-wrap">
            <input
              type="checkbox"
              id="modal-gdpr"
              name="gdpr"
              value="1"
              required
            />
            <label for="modal-gdpr" class="mtz-body-dark" style="font-size:var(--text-xs);cursor:pointer;">
              {!! __('contact.field_gdpr', ['link' => '<a href="#" style="color:var(--color-secondary);">' . __('contact.field_gdpr_link') . '</a>']) !!}
            </label>
          </div>
          <button type="submit" class="mtz-btn mtz-btn-cta" style="width:100%;padding:1rem 2rem;">
            {{ __('contact.submit') }}
          </button>
        </form>
      </div>

    </div>
  </div>
</div>
