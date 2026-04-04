/**
 * MTZ Nord Residence — app.js
 * GSAP ScrollTrigger + fade-up animations + nav behavior
 * Fără Lenis. Scroll nativ.
 */

// ── Alpine Store: stare meniu mobil ──────────────────────
// Înregistrat înainte ca Alpine să se inițializeze componente.
document.addEventListener('alpine:init', () => {
  Alpine.store('nav', {
    open: false,
    toggle() { this.open = !this.open; },
    close()  { this.open = false; },
  });

  // ── Lightbox reutilizabil pentru galerie ────────────────
  Alpine.data('mtzLightbox', (images) => ({
    open: false,
    index: 0,
    images: images,
    touchStartX: 0,

    go(dir) {
      this.index = (this.index + dir + this.images.length) % this.images.length;
    },

    openAt(i) {
      this.index = i;
      this.open = true;
    },

    onTouchStart(e) {
      this.touchStartX = e.changedTouches[0].screenX;
    },

    onTouchEnd(e) {
      const diff = this.touchStartX - e.changedTouches[0].screenX;
      if (Math.abs(diff) > 50) this.go(diff > 0 ? 1 : -1);
    },
  }));
});

// ── Constante ────────────────────────────────────────────
const FADE_UP_DISTANCE = '2rem';   // distanță de translație
const FADE_UP_DURATION = 0.7;      // secunde
const FADE_UP_STAGGER  = 0.12;     // stagger între elemente sibling
const NAV_TRIGGER_PX   = 20;       // px scroll pentru a activa nav scrolled

// ── Inițializare GSAP + ScrollTrigger ───────────────────
document.addEventListener('DOMContentLoaded', () => {

  if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') {
    console.warn('[MTZ] GSAP sau ScrollTrigger nu sunt disponibile.');
    // Fallback: afișează tot
    document.querySelectorAll('[data-animate="fade-up"]').forEach(el => {
      el.style.opacity = '1';
      el.style.transform = 'none';
    });
    return;
  }

  gsap.registerPlugin(ScrollTrigger);

  // ── Fade-up la scroll ──────────────────────────────────
  initFadeUpAnimations();

  // ── Hero background scale-in ───────────────────────────
  initHeroBg();

  // ── Counter animation la scroll (highlights) ───────────
  initCounterAnimations();

});

/**
 * Animații fade-up pe toate elementele cu data-animate="fade-up".
 * Elementele sibling în același părinte au stagger automat.
 */
function initFadeUpAnimations() {
  const elements = gsap.utils.toArray('[data-animate="fade-up"]');

  // Grupare sibling pentru stagger
  const parentMap = new Map();
  elements.forEach(el => {
    const parent = el.parentElement;
    if (!parentMap.has(parent)) parentMap.set(parent, []);
    parentMap.get(parent).push(el);
  });

  parentMap.forEach((siblings, parent) => {
    if (siblings.length > 1) {
      // Multiple siblings: stagger
      gsap.fromTo(siblings,
        { opacity: 0, y: 32 },
        {
          opacity: 1,
          y: 0,
          duration: FADE_UP_DURATION,
          stagger: FADE_UP_STAGGER,
          ease: 'power2.out',
          scrollTrigger: {
            trigger: parent,
            start: 'top 88%',
            once: true,
          },
        }
      );
    } else {
      // Singur: animație simplă
      gsap.fromTo(siblings[0],
        { opacity: 0, y: 32 },
        {
          opacity: 1,
          y: 0,
          duration: FADE_UP_DURATION,
          ease: 'power2.out',
          scrollTrigger: {
            trigger: siblings[0],
            start: 'top 88%',
            once: true,
          },
        }
      );
    }
  });
}

/**
 * Hero background: scale-in la load pentru efect cinematic.
 */
function initHeroBg() {
  const heroBg = document.getElementById('hero-bg');
  if (!heroBg) return;

  // Scale-in kenburn la load
  heroBg.addEventListener('load', () => {
    heroBg.classList.add('mtz-hero__bg--loaded');
  });

  // Dacă deja loaded (cache)
  if (heroBg.complete) {
    heroBg.classList.add('mtz-hero__bg--loaded');
  }

  // Parallax subtil la scroll
  gsap.to(heroBg, {
    yPercent: 15,
    ease: 'none',
    scrollTrigger: {
      trigger: '#hero',
      start: 'top top',
      end: 'bottom top',
      scrub: true,
    },
  });
}
/**
 * Counter animation — numere care cresc la scroll.
 * Trigger: [data-counter="<target>"], opțional:
 *   data-suffix="%"         — adăugat după număr
 *   data-counter-start="N" — valoare de pornire (default 0)
 */
const COUNTER_DURATION = 1.6;  // secunde

function initCounterAnimations() {
  const counters = gsap.utils.toArray('[data-counter]');
  if (!counters.length) return;

  counters.forEach(el => {
    const target = parseFloat(el.dataset.counter);
    const suffix = el.dataset.suffix ?? '';
    const rawStart = el.dataset.counterStart;
    const start  = rawStart !== undefined ? parseFloat(rawStart) : 0;

    const obj = { val: start };

    gsap.fromTo(
      obj,
      { val: start },
      {
        val: target,
        duration: COUNTER_DURATION,
        ease: 'power3.out',
        scrollTrigger: {
          trigger: el,
          start: 'top 88%',
          once: true,
        },
        onUpdate() {
          const v = Number.isInteger(target)
            ? Math.round(obj.val)
            : obj.val.toFixed(1);
          el.textContent = v + suffix;
        },
      }
    );
  });
}
