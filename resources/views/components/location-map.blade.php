@props(['mapId' => 'main'])

@php
  /*
   * Componentă reutilizabilă: Hartă Leaflet + card POI.
   * Se poate folosi pe orice pagină fără a pasa $poi din controller.
   * Datele provin direct din config('apartments.poi').
   * Leaflet.js + leaflet.css sunt incluse în layouts/app.blade.php.
   *
   * Utilizare:
   *   <x-location-map />
   */
  $mapPoi = config('apartments.poi', []);
@endphp

<section id="localizare" class="mtz-map-section">

  {{-- Map canvas — Leaflet inițializat în @push('scripts') --}}
  <div id="mtz-leaflet-map-{{ $mapId ?? 'main' }}" class="mtz-map-canvas"></div>

  {{-- Fade sus — blendare cu secțiunea anterioară --}}
  <div class="mtz-map-fade-top" aria-hidden="true"></div>

  {{-- Fade jos — blendare cu secțiunea următoare --}}
  <div class="mtz-map-fade-bottom" aria-hidden="true"></div>

  {{-- Titlu secțiune — stânga-jos pe hartă --}}
  <div class="mtz-map-title" data-animate="fade-up">
    <span class="mtz-label">{{ __('hero.map_section_label') }}</span>
    <h2 class="mtz-h2">{{ __('hero.map_section_title') }}</h2>
    <hr class="mtz-divider"/>
  </div>

  {{-- Card localizare — dreapta sus --}}
  <div class="mtz-map-card" data-animate="fade-up">
    <div class="mtz-map-card__body">
      <span class="mtz-label">{{ __('hero.map_section_label') }}</span>
      <h3 class="mtz-map-card__title">{{ __('hero.map_neighborhood') }}</h3>
      <div class="mtz-map-card__poi">
        @foreach($mapPoi as $point)
          <div class="mtz-map-card__poi-row">
            <div class="mtz-map-card__poi-label">
              <span class="material-symbols-outlined mtz-map-card__poi-icon">{{ $point['icon'] }}</span>
              {{ $point['label'] }}
            </div>
            <span class="mtz-map-card__poi-dist">{{ $point['distance'] }}</span>
          </div>
        @endforeach
      </div>
    </div>
  </div>

</section>

@push('scripts')
<script>
(function initLeafletMap() {
  const mapId  = 'mtz-leaflet-map-{{ $mapId ?? 'main' }}';
  const mapEl  = document.getElementById(mapId);
  if (!mapEl || typeof L === 'undefined') return;

  // Coordonate MTZ Nord Residence, Mangalia
  const LAT  = 43.8134;
  const LNG  = 28.5831;
  const ZOOM = 14;

  const map = L.map(mapId, {
    center:             [LAT, LNG],
    zoom:               ZOOM,
    zoomControl:        false,
    scrollWheelZoom:    false,
    dragging:           false,
    doubleClickZoom:    false,
    touchZoom:          false,
    keyboard:           false,
    attributionControl: true,
  });

  // Tile layers — CartoDB Positron cu fallback pe OSM
  const cartoLayer = L.tileLayer(
    'https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png',
    {
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright" target="_blank">OSM</a> &copy; <a href="https://carto.com/" target="_blank">CARTO</a>',
      subdomains:  'abcd',
      maxZoom:     19,
    }
  );

  const osmLayer = L.tileLayer(
    'https://tile.openstreetmap.org/{z}/{x}/{y}.png',
    {
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright" target="_blank">OpenStreetMap</a>',
      maxZoom: 19,
    }
  );

  cartoLayer.addTo(map);
  let cartoLoaded = false;
  cartoLayer.on('tileload', () => { cartoLoaded = true; });
  setTimeout(() => {
    if (!cartoLoaded) {
      map.removeLayer(cartoLayer);
      osmLayer.addTo(map);
    }
  }, 3000);

  // Pin custom SVG — culori brand
  const pinSVG = `
    <svg xmlns="http://www.w3.org/2000/svg" width="44" height="56" viewBox="0 0 44 56" fill="none">
      <path d="M22 0C9.85 0 0 9.85 0 22C0 36.667 20.167 54.5 21.083 55.333C21.583 55.778 22.417 55.778 22.917 55.333C23.833 54.5 44 36.667 44 22C44 9.85 34.15 0 22 0Z" fill="#433a35"/>
      <circle cx="22" cy="22" r="9" fill="#fdfcfb"/>
      <circle cx="22" cy="22" r="4" fill="#a69080"/>
    </svg>
  `;

  const pinIcon = L.divIcon({
    html:       pinSVG,
    className:  'mtz-leaflet-pin',
    iconSize:   [44, 56],
    iconAnchor: [22, 56],
  });

  L.marker([LAT, LNG], { icon: pinIcon }).addTo(map);
})();
</script>
@endpush
