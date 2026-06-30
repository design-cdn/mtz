@extends('layouts.app')

@section('title', $floorLabel . ' — MTZ Nord Residence, Medgidia')
@section('description', 'Planul desfășurat al nivelului ' . $floorLabel . ' din MTZ Nord Residence, Medgidia. Alege apartamentul pentru detalii complete.')

@php
  $activeRoute = 'apartments';

  $statusMeta = [
    'available' => ['label' => 'Disponibil',          'class' => 'is-available'],
    'reserved'  => ['label' => 'Rezervat',            'class' => 'is-reserved'],
    'sold'      => ['label' => 'Vândut',              'class' => 'is-sold'],
    'remodel'   => ['label' => 'În recompartimentare', 'class' => 'is-remodel'],
  ];

  $availableCount = $apartments->where('status', 'available')->count();
  $hasRemodel     = $apartments->where('status', 'remodel')->count() > 0;
@endphp

@section('content')

<div style="padding-top:var(--nav-h);">
  <section class="mtz-section-sm mtz-section-surface mtz-border-top">
    <div class="mtz-container">

      {{-- Breadcrumb --}}
      <nav aria-label="Breadcrumb" class="flex items-center gap-3" style="margin-bottom:var(--space-xl);">
        <a href="{{ route('home') }}" class="mtz-caption" style="color:var(--color-text-primary);opacity:0.4;text-decoration:none;">Acasă</a>
        <span class="mtz-caption" style="opacity:0.3;">·</span>
        <a href="{{ route('apartamente.index') }}" class="mtz-caption" style="color:var(--color-text-primary);opacity:0.4;text-decoration:none;">Apartamente</a>
        <span class="mtz-caption" style="opacity:0.3;">·</span>
        <span class="mtz-caption" style="opacity:0.7;">{{ $floorLabel }}</span>
      </nav>

      <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-20 items-start"
           x-data="floorPlan(@js($apartments))">

        {{-- ═══ PLAN ═══ --}}
        <div class="lg:col-span-7 lg:order-2">
          @if($planSvg)
            <div class="mtz-floorplan" id="mtz-floorplan">
              {!! $planSvg !!}
            </div>
          @elseif($pending)
            <div class="mtz-fp-empty">
              <span class="material-symbols-outlined mtz-icon-xl" style="color:var(--color-secondary);">schedule</span>
              <p class="mtz-body" style="margin-top:var(--space-sm);">Acest nivel este în curs de repartajare.<br/>Planurile vor fi disponibile în curând.</p>
            </div>
          @else
            {{-- Fallback până sosește planul SVG al etajului: grilă de apartamente --}}
            <div class="mtz-fp-fallback">
              @foreach($apartments as $a)
                @php $meta = $statusMeta[$a['status']] ?? $statusMeta['available']; @endphp
                <a href="{{ $a['url'] }}" class="mtz-fp-card">
                  <div class="mtz-fp-card__top">
                    <span class="mtz-fp-card__num">Ap. {{ $a['label'] }}</span>
                    <span class="mtz-avail-badge {{ $meta['class'] }}"><span class="mtz-avail-badge__dot"></span>{{ $meta['label'] }}</span>
                  </div>
                  <span class="mtz-body-sm">{{ $a['rooms'] }} {{ $a['rooms'] === 1 ? 'cameră' : 'camere' }} · {{ $a['areaText'] }}</span>
                </a>
              @endforeach
            </div>
          @endif
        </div>

        {{-- ═══ PANOU LATERAL ═══ --}}
        <aside class="lg:col-span-5 lg:order-1 flex flex-col gap-8">
          <div>
            <span class="mtz-label">{{ $building['name'] }} · {{ $building['location'] }}</span>
            <h1 class="mtz-h1">{{ $floorLabel }}</h1>
            <hr class="mtz-divider" style="margin-top:var(--space-md);"/>
          </div>

          @unless($pending)
            <p class="mtz-body">
              @if($availableCount > 0)
                {{ $availableCount }} {{ $availableCount === 1 ? 'apartament disponibil' : 'apartamente disponibile' }}.
              @endif
              @if($planSvg) Treci cu mouse-ul peste plan sau apasă pe un apartament pentru detalii. @else Apasă pe un apartament pentru detalii. @endif
            </p>

            {{-- Legendă --}}
            <div class="mtz-fp-legend">
              <span class="mtz-fp-legend__item"><span class="mtz-fp-legend__swatch is-available"></span>Disponibil</span>
              <span class="mtz-fp-legend__item"><span class="mtz-fp-legend__swatch is-reserved"></span>Rezervat</span>
              <span class="mtz-fp-legend__item"><span class="mtz-fp-legend__swatch is-sold"></span>Vândut</span>
              @if($hasRemodel)
                <span class="mtz-fp-legend__item"><span class="mtz-fp-legend__swatch is-remodel"></span>În recompartimentare</span>
              @endif
            </div>

            {{-- Listă apartamente --}}
            <ul class="mtz-fp-list">
              @foreach($apartments as $a)
                @php $meta = $statusMeta[$a['status']] ?? $statusMeta['available']; @endphp
                <li>
                  @if($a['status'] === 'remodel')
                    <div class="mtz-fp-list__row is-remodel">
                      <span class="mtz-fp-list__num">Ap. {{ $a['label'] }}</span>
                      <span class="mtz-fp-list__meta">{{ $a['rooms'] }} camere</span>
                      <span class="mtz-avail-badge {{ $meta['class'] }}"><span class="mtz-avail-badge__dot"></span>{{ $meta['label'] }}</span>
                    </div>
                  @else
                    <a href="{{ $a['url'] }}"
                       class="mtz-fp-list__row"
                       data-apt="{{ $a['slug'] }}"
                       @mouseenter="hl('{{ $a['slug'] }}')"
                       @mouseleave="hl(null)">
                      <span class="mtz-fp-list__num">Ap. {{ $a['label'] }}</span>
                      <span class="mtz-fp-list__meta">{{ $a['rooms'] }} cam · {{ $a['areaText'] }}</span>
                      <span class="mtz-avail-badge {{ $meta['class'] }}"><span class="mtz-avail-badge__dot"></span>{{ $meta['label'] }}</span>
                    </a>
                  @endif
                </li>
              @endforeach
            </ul>
          @endunless
        </aside>

      </div>
    </div>
  </section>
</div>

@endsection

@push('scripts')
<script>
  function floorPlan(apts) {
    // Referință la SVG capturată în closure: metodele apelate din expresii Alpine
    // (ex. @mouseenter="hl(...)") rulează cu `this` nelegat, deci nu putem folosi
    // this.$el. Closure-ul rămâne valid indiferent de context.
    let svgRoot = null;

    const setRowHover = (slug, on) => {
      const row = document.querySelector('.mtz-fp-list__row[data-apt="' + slug + '"]');
      if (row) row.classList.toggle('is-hover', on);
    };

    return {
      apts,
      init() {
        svgRoot = this.$el.querySelector('svg');
        if (!svgRoot) return;
        const NS = 'http://www.w3.org/2000/svg';

        this.apts.forEach(a => {
          const g = svgRoot.querySelector('#' + a.svgId);
          if (!g) return;

          g.classList.add('mtz-fp-apt', 'is-' + a.status);

          // Silueta apartamentului = primul shape din grup. O etichetăm cu o clasă
          // unificată ca CSS-ul s-o coloreze indiferent de planul-sursă
          // (parter folosește .cls-10, etaj-tip folosește .st18).
          const shape = g.querySelector('polygon, rect, path');
          if (shape) shape.classList.add('mtz-fp-shape');
          // Apartamentele în recompartimentare nu sunt selectabile/accesibile.
          if (a.status === 'remodel') {
            g.setAttribute('aria-label', 'Apartament ' + a.label + ' — în curs de recompartimentare');
          } else {
            g.setAttribute('role', 'link');
            g.setAttribute('tabindex', '0');
            g.setAttribute('aria-label', 'Apartament ' + a.label);
            const go = () => { window.location = a.url; };
            g.addEventListener('click', go);
            g.addEventListener('keydown', e => {
              if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); go(); }
            });

            // Highlight invers: hover pe plan → evidențiază rândul din listă
            g.addEventListener('mouseenter', () => setRowHover(a.slug, true));
            g.addEventListener('mouseleave', () => setRowHover(a.slug, false));
          }

          // Etichetă (nr. apartament + m² / status) poziționată în centrul amprentei
          let bb;
          try { bb = g.getBBox(); } catch (e) { return; }
          const cx = bb.x + bb.width / 2, cy = bb.y + bb.height / 2;

          const label = document.createElementNS(NS, 'text');
          label.setAttribute('class', 'mtz-fp-label');
          label.setAttribute('x', cx);
          label.setAttribute('y', cy);
          label.setAttribute('text-anchor', 'middle');

          const num = document.createElementNS(NS, 'tspan');
          num.setAttribute('x', cx);
          num.setAttribute('dy', '-0.1em');
          num.setAttribute('class', 'mtz-fp-label__num');
          num.textContent = 'Ap. ' + a.label;
          label.appendChild(num);

          const subLines = a.status === 'sold'     ? ['VÂNDUT']
                         : a.status === 'reserved' ? ['REZERVAT']
                         : a.status === 'remodel'  ? ['ÎN CURS DE', 'RECOMPARTIMENTARE']
                         : [a.areaText];
          subLines.forEach((line, idx) => {
            const sub = document.createElementNS(NS, 'tspan');
            sub.setAttribute('x', cx);
            sub.setAttribute('dy', idx === 0 ? '1.35em' : '1.15em');
            sub.setAttribute('class', 'mtz-fp-label__sub');
            sub.textContent = line;
            label.appendChild(sub);
          });

          g.appendChild(label);

          // Container accent în spatele textului — măsurat după randarea etichetei
          let lb;
          try { lb = label.getBBox(); } catch (e) { return; }
          const padX = 22, padY = 16;
          const bg = document.createElementNS(NS, 'rect');
          bg.setAttribute('class', 'mtz-fp-label-bg');
          bg.setAttribute('x', lb.x - padX);
          bg.setAttribute('y', lb.y - padY);
          bg.setAttribute('width', lb.width + padX * 2);
          bg.setAttribute('height', lb.height + padY * 2);
          bg.setAttribute('rx', 14);
          g.insertBefore(bg, label);
        });
      },

      hl(slug) {
        if (!svgRoot) return;
        svgRoot.querySelectorAll('.mtz-fp-apt.is-hover').forEach(e => e.classList.remove('is-hover'));
        const a = apts.find(x => x.slug === slug);
        if (a) {
          const g = svgRoot.querySelector('#' + a.svgId);
          if (g) g.classList.add('is-hover');
        }
      },
    };
  }
</script>
@endpush
