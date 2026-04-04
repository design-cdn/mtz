{{--
  Formular de contact reutilizabil.
  Props:
    $apartment  — array cu datele apartamentului (optional, pentru pagina apartament)
    $action     — route name (default: contact.store)
    $dark       — stilizare dark section (default: true)
--}}
@props([
    'apartment' => null,
    'action'    => 'contact.store',
    'dark'      => true,
])

<form
  class=""
  action="{{ route($action) }}"
  method="POST"
  x-data="{ success: {{ session('success') ? 'true' : 'false' }} }"
>
  @csrf

  {{-- Mesaj succes --}}
  <div x-show="success" class="mtz-form-success" style="display:none;">
    <span class="material-symbols-outlined mtz-icon">check_circle</span>
    <span>{{ __('contact.success') }}</span>
  </div>

  <div x-show="!success" class="mtz-contact-form">

    {{-- Câmp readonly apartament (dacă e specificat) --}}
    @if($apartment)
      <div class="mtz-field mtz-field--readonly">
        <label>{{ __('contact.field_apartment') }}</label>
        <input
          type="text"
          name="apartament"
          value="{{ $apartment['label'] }} · Etaj {{ $apartment['floor'] }} · {{ $apartment['area'] }} m² · {{ config('apartments.building.name') }}"
          readonly
        />
      </div>
    @endif

    {{-- Nume + Prenume --}}
    <div class="mtz-form-section">
      <div class="mtz-field">
        <label for="{{ $apartment ? 'ap' : 'f' }}-nume">{{ __('contact.field_name') }} *</label>
        <input
          id="{{ $apartment ? 'ap' : 'f' }}-nume"
          type="text"
          name="nume"
          placeholder="{{ __('contact.ph_name') }}"
          required
          autocomplete="family-name"
          value="{{ old('nume') }}"
        />
        @error('nume')<span class="mtz-caption" style="color:#e57373;margin-top:4px;">{{ $message }}</span>@enderror
      </div>
      <div class="mtz-field">
        <label for="{{ $apartment ? 'ap' : 'f' }}-prenume">{{ __('contact.field_prenume') }} *</label>
        <input
          id="{{ $apartment ? 'ap' : 'f' }}-prenume"
          type="text"
          name="prenume"
          placeholder="{{ __('contact.ph_prenume') }}"
          required
          autocomplete="given-name"
          value="{{ old('prenume') }}"
        />
      </div>
    </div>

    {{-- Telefon + Email --}}
    <div class="mtz-form-section">
      <div class="mtz-field">
        <label for="{{ $apartment ? 'ap' : 'f' }}-telefon">{{ __('contact.field_phone') }} *</label>
        <input
          id="{{ $apartment ? 'ap' : 'f' }}-telefon"
          type="tel"
          name="telefon"
          placeholder="{{ __('contact.ph_phone') }}"
          required
          autocomplete="tel"
          value="{{ old('telefon') }}"
        />
        @error('telefon')<span class="mtz-caption" style="color:#e57373;margin-top:4px;">{{ $message }}</span>@enderror
      </div>
      <div class="mtz-field">
        <label for="{{ $apartment ? 'ap' : 'f' }}-email">{{ __('contact.field_email') }}</label>
        <input
          id="{{ $apartment ? 'ap' : 'f' }}-email"
          type="email"
          name="email"
          placeholder="{{ __('contact.ph_email') }}"
          autocomplete="email"
          value="{{ old('email') }}"
        />
      </div>
    </div>

    {{-- Tip apartament (dacă nu e pre-completat) + Buget / Finanțare --}}
    <div class="mtz-form-section">
      @if($apartment)
        {{-- Finanțare pe pagina apartament --}}
        <div class="mtz-field">
          <label for="{{ $apartment ? 'ap' : 'f' }}-finantare">{{ __('contact.field_financing') }}</label>
          <select
            id="{{ $apartment ? 'ap' : 'f' }}-finantare"
            name="finantare"
            x-on:change="$el.classList.add('selected')"
          >
            <option value="" disabled selected>{{ __('contact.ph_financing') }}</option>
            @foreach(__('contact.financing_options') as $val => $label)
              <option value="{{ $val }}" {{ old('finantare') === $val ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
          </select>
        </div>
      @else
        {{-- Tip pe pagina generică --}}
        <div class="mtz-field">
          <label for="f-tip">{{ __('contact.field_type') }}</label>
          <select id="f-tip" name="tip_apartament" x-on:change="$el.classList.add('selected')">
            <option value="" disabled selected>{{ __('contact.ph_type') }}</option>
            @foreach(__('contact.type_options') as $val => $label)
              <option value="{{ $val }}" {{ old('tip_apartament') === $val ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
          </select>
        </div>
      @endif

      <div class="mtz-field">
        <label for="{{ $apartment ? 'ap' : 'f' }}-buget">{{ __('contact.field_budget') }}</label>
        <select
          id="{{ $apartment ? 'ap' : 'f' }}-buget"
          name="buget"
          x-on:change="$el.classList.add('selected')"
        >
          <option value="" disabled selected>{{ __('contact.ph_budget') }}</option>
          @foreach(__('contact.budget_options') as $val => $label)
            <option value="{{ $val }}" {{ old('buget') === $val ? 'selected' : '' }}>{{ $label }}</option>
          @endforeach
        </select>
      </div>
    </div>

    {{-- Mesaj --}}
    <div class="mtz-field">
      <label for="{{ $apartment ? 'ap' : 'f' }}-mesaj">{{ __('contact.field_message') }}</label>
      <textarea
        id="{{ $apartment ? 'ap' : 'f' }}-mesaj"
        name="mesaj"
        placeholder="{{ $apartment ? __('contact.ph_message') : __('contact.ph_message') }}"
      >{{ old('mesaj') }}</textarea>
    </div>

    {{-- GDPR --}}
    <div class="mtz-checkbox-wrap">
      <input
        type="checkbox"
        id="{{ $apartment ? 'ap' : 'f' }}-gdpr"
        name="gdpr"
        value="1"
        required
        {{ old('gdpr') ? 'checked' : '' }}
      />
      <label
        for="{{ $apartment ? 'ap' : 'f' }}-gdpr"
        class="mtz-body-dark"
        style="cursor:pointer;"
      >
        {!! __('contact.field_gdpr', ['link' => '<a href="#" style="color:var(--color-secondary);">' . __('contact.field_gdpr_link') . '</a>']) !!}
      </label>
    </div>
    @error('gdpr')<span class="mtz-caption" style="color:#e57373;">{{ $message }}</span>@enderror

    {{-- Submit --}}
    <div>
      <button type="submit" class="mtz-btn mtz-btn-cta" style="padding:1.25rem 3rem;">
        {{ __('contact.submit') }}
      </button>
    </div>

  </div>
</form>
