@extends('layouts.app')

@section('title', __('meta.privacy.title'))
@section('description', __('meta.privacy.description'))

@php
  $activeRoute = 'legal';
@endphp

@section('content')

<div style="padding-top:var(--nav-h);">
  <section class="mtz-section mtz-section-surface mtz-border-top">
    <div class="mtz-legal">

      <span class="mtz-label">MTZ Nord Residence · Medgidia</span>
      <h1 class="mtz-h1">Politică de confidențialitate</h1>
      <hr class="mtz-divider" style="margin:var(--space-lg) 0;"/>
      <p class="mtz-meta mtz-legal__updated">Ultima actualizare: <span class="mtz-legal-ph">[ZZ.LL.AAAA]</span></p>

      <div class="mtz-legal-note">
        <p><strong>Notă:</strong> câmpurile marcate cu <span class="mtz-legal-ph">[...]</span> trebuie completate cu datele oficiale ale dezvoltatorului. Recomandăm o verificare juridică înainte de publicare.</p>
      </div>

      <article class="mtz-legal-prose">

        <h2>1. Cine suntem</h2>
        <p>Acest site prezintă ansamblul rezidențial <strong>MTZ Nord Residence</strong> din Medgidia, județul Constanța. Operatorul datelor cu caracter personal colectate prin intermediul site-ului este:</p>
        <ul>
          <li>Denumire: <span class="mtz-legal-ph">[DENUMIRE DEZVOLTATOR S.R.L.]</span></li>
          <li>CUI: <span class="mtz-legal-ph">[CUI]</span> · Nr. Reg. Com.: <span class="mtz-legal-ph">[J__/___/____]</span></li>
          <li>Sediu: <span class="mtz-legal-ph">[ADRESĂ SEDIU SOCIAL]</span></li>
          <li>E-mail: <a href="mailto:office@mtznordresidence.ro">office@mtznordresidence.ro</a></li>
          <li>Telefon: <span class="mtz-legal-ph">[TELEFON]</span></li>
        </ul>

        <h2>2. Ce date colectăm</h2>
        <p>Colectăm doar datele de care avem nevoie pentru a-ți răspunde:</p>
        <ul>
          <li><strong>Date furnizate de tine</strong> prin formularul de contact sau de cerere ofertă: nume, număr de telefon și, opțional, adresa de e-mail.</li>
          <li><strong>Date tehnice</strong> generate automat la navigare: adresa IP, tipul de browser, paginile vizitate și momentul vizitei — folosite strict pentru funcționarea și securitatea site-ului.</li>
        </ul>
        <p>Nu colectăm date sensibile (origine, sănătate, opinii politice etc.) și nu îți cerem astfel de informații.</p>

        <h2>3. În ce scop folosim datele</h2>
        <ul>
          <li>Pentru a răspunde solicitărilor tale și a-ți transmite informații despre apartamentele disponibile.</li>
          <li>Pentru a-ți trimite oferta personalizată pe care ai cerut-o.</li>
          <li>Pentru a menține site-ul funcțional, sigur și pentru a preveni utilizarea abuzivă.</li>
        </ul>
        <p>Detalii complete despre temeiurile legale și drepturile tale găsești în <a href="{{ route('legal.gdpr') }}">informarea GDPR</a>.</p>

        <h2>4. Cookie-uri și servicii terțe</h2>
        <p>Site-ul folosește cookie-uri și tehnologii strict necesare pentru a funcționa corect. Pentru afișare folosim și servicii externe care îți pot prelucra datele tehnice:</p>
        <ul>
          <li><strong>Hărți</strong> — OpenStreetMap și CARTO, pentru harta de localizare.</li>
          <li><strong>Fonturi și iconițe</strong> — Google Fonts.</li>
          <li><strong>Mesagerie</strong> — link către WhatsApp, deschis doar la inițiativa ta.</li>
        </ul>
        <p>Îți poți gestiona sau șterge cookie-urile oricând din setările browserului.</p>

        <h2>5. Cui dezvăluim datele</h2>
        <p>Nu vindem și nu închiriem datele tale. Le putem dezvălui doar:</p>
        <ul>
          <li>furnizorilor care ne ajută să operăm site-ul (găzduire, e-mail), pe bază de contract și cu obligație de confidențialitate;</li>
          <li>autorităților publice, atunci când legea ne obligă.</li>
        </ul>

        <h2>6. Cât timp păstrăm datele</h2>
        <p>Păstrăm datele din formulare doar atât cât e necesar pentru a-ți răspunde și pentru relația precontractuală, dar nu mai mult de <span class="mtz-legal-ph">[ex: 24 de luni]</span> de la ultima interacțiune, dacă nu există o obligație legală de păstrare mai îndelungată.</p>

        <h2>7. Securitatea datelor</h2>
        <p>Aplicăm măsuri tehnice și organizatorice rezonabile pentru a-ți proteja datele împotriva accesului neautorizat, pierderii sau divulgării.</p>

        <h2>8. Drepturile tale</h2>
        <p>Ai dreptul de acces, rectificare, ștergere, restricționare, opoziție și portabilitate, precum și dreptul de a-ți retrage consimțământul. Modul concret de exercitare este descris în <a href="{{ route('legal.gdpr') }}">informarea GDPR</a>.</p>

        <h2>9. Contact</h2>
        <p>Pentru orice întrebare legată de confidențialitate, scrie-ne la <a href="mailto:office@mtznordresidence.ro">office@mtznordresidence.ro</a>.</p>

        <h2>10. Modificări ale acestei politici</h2>
        <p>Putem actualiza această politică periodic. Versiunea valabilă este cea publicată pe această pagină, cu data ultimei actualizări de mai sus.</p>

      </article>
    </div>
  </section>
</div>

@endsection
