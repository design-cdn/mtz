# MTZ Nord Residence — Prompt 1: Frontend

## Proiect

Site de prezentare pentru **MTZ Nord Residence**, un ansamblu rezidențial în Mangalia, România. Scopul site-ului este conversia vizitatorilor în lead-uri — fiecare decizie de design și interactivitate servește acest scop.

---

## Stack

Laravel 12, Blade, Alpine.js, Tailwind CSS v3, Vite, GSAP 3 + ScrollTrigger, Lenis (smooth scroll), Google Material Symbols (CDN), Manrope font (CDN).

**Regulă critică pentru Lenis + GSAP:** folosește un singur RAF loop — `gsap.ticker.add((time) => { lenis.raf(time * 1000) })`. Nu rula `requestAnimationFrame` separat în paralel cu GSAP ticker — provoacă lag la scroll.

---

## Design System

Proiectul are un design system definit în `mtz-design-system.css`. Importă-l în `app.css` înaintea directivelor Tailwind. Toate clasele semantice sunt prefixate cu `mtz-` și acoperă tipografie, layout, butoane, formulare, imagini, nav și footer.

**Regulă:** folosește întotdeauna clasele `mtz-*` pentru tipografie și componente. Nu folosi clase Tailwind ad-hoc pe elemente de text sau butoane — toate valorile sunt deja definite în design system.

---

## Pagini

### Home (`/`)

Pagină single-scroll cu următoarele secțiuni în ordine:

1. **Hero** — full viewport, imagine de fundal a clădirii, headline mic suprapus, selector interactiv de etaje (vezi mai jos), indicator scroll
2. **Despre proiect** — text descriptiv despre ansamblu și locație
3. **Cifre cheie** — statistici animate la scroll (etaje, tipuri camere, an finalizare etc.)
4. **Galerie** — layout editorial asimetric cu imaginile proiectului
5. **Ce primești** — grid de features/dotări ale ansamblului
6. **Localizare** — Google Maps embed + card cu puncte de interes din Mangalia
7. **CTA** — secțiune dark cu call to action spre WhatsApp
8. **Contact** — formular complet (vezi secțiunea Formular)

### Pagina apartament (`/apartamente/{slug}`)

Pagină dedicată unui apartament. Conține: date tehnice ale apartamentului (camere, mp, etaj, orientare, dotări), galerie foto, plan 2D, formular de ofertă cu apartamentul pre-completat.

### Progres șantier (`/progres`)

Timeline de update-uri lunare cu poze de pe șantier. Cel mai recent update e afișat prominent, restul în arhivă cronologică.

### Contact (`/contact`)

Pagină separată cu formularul de contact și datele de contact.

---

## Selector Interactiv Etaje (componenta principală)

Aceasta este componenta centrală a site-ului. Trăiește în hero-ul paginii home.

**Flux utilizator:**
1. Utilizatorul vede fațada clădirii cu etajele marcate
2. Hover pe un etaj → highlight vizual
3. Click pe etaj → tranziție animată spre planul 2D al etajului respectiv
4. Pe planul 2D, fiecare apartament e o zonă clickabilă colorată după status
5. Hover pe apartament → tooltip cu date sumare
6. Click pe apartament → navighează la pagina de detalii

**Status-uri apartament și culorile lor:**
- `available` → culoarea secondary din design system
- `sold` → culoarea primary din design system
- `rented` → varianta mai deschisă a secondary

**Implementare:**
- Fațada clădirii: SVG cu zone clickabile per etaj suprapuse pe imaginea JPG a clădirii
- Planul etajului: SVG 2D văzut de sus, cu shapes per apartament
- Starea (`selectedFloor`, datele apartamentelor) gestionată cu Alpine.js
- Tranziția între fațadă și plan: animată cu GSAP
- În Phase 1 datele sunt hardcodate în Alpine; în Phase 2 vor veni din backend

**Legendă** sub selector: Disponibil / Vândut / Închiriat cu culorile corespunzătoare.

---

## Formular de Contact

Câmpuri: Nume, Prenume, Telefon (required), Email, Tip apartament (select), Buget (select), Mesaj, checkbox GDPR.

Versiunea de pe pagina apartamentului are un câmp suplimentar readonly cu numele apartamentului, pre-completat automat.

În Phase 1: `POST /contact` returnează `back()->with('success', true)`. Afișează mesaj de confirmare cu Alpine.js.

---

## Elemente Globale

- **Nav** fixed, transparent cu blur, logo stânga, linkuri centru, CTA dreapta
- **Buton "Cere ofertă"** în nav → deschide un modal rapid cu formular minimal
- **Buton WhatsApp** sticky în colțul din dreapta-jos pe toate paginile
- **Footer** cu logo, tagline, linkuri legale, social media

---

## Cerințe Tehnice

- `npm run build` fără erori
- Toate imaginile cu `loading="lazy"` (excepție: hero)
- Mobile responsive — fără scroll orizontal
- Înălțimea navului setată ca CSS custom property `--nav-h` și folosită consistent
- CSRF token în `<head>` pentru request-urile Alpine
- Scroll animations GSAP pe elementele cu `data-animate="fade-up"`

---

## Deliverable Phase 1

Aplicație Laravel funcțională cu toate paginile renderizate corect, selectorul de etaje funcțional cu date hardcodate, formularul de contact care trimite și afișează confirmare, modalul de ofertă funcțional, smooth scroll activ.
