@extends('layouts.app')

@section('title', __('meta.gdpr.title'))
@section('description', __('meta.gdpr.description'))

@php
  $activeRoute = 'legal';
@endphp

@section('content')

<div style="padding-top:var(--nav-h);">
  <section class="mtz-section mtz-section-surface mtz-border-top">
    <div class="mtz-legal">

      <span class="mtz-label">MTZ Nord Residence · Medgidia</span>
      <h1 class="mtz-h1">Prelucrarea datelor cu caracter personal</h1>
      <hr class="mtz-divider" style="margin:var(--space-lg) 0;"/>
      <p class="mtz-meta mtz-legal__updated">Conform Regulamentului (UE) 2016/679 (GDPR) · Ultima actualizare: <span class="mtz-legal-ph">[ZZ.LL.AAAA]</span></p>

      <div class="mtz-legal-note">
        <p><strong>Notă:</strong> câmpurile marcate cu <span class="mtz-legal-ph">[...]</span> trebuie completate cu datele oficiale ale dezvoltatorului. Recomandăm o verificare juridică înainte de publicare.</p>
      </div>

      <article class="mtz-legal-prose">

        <h2>1. Operatorul de date</h2>
        <p>Operatorul care decide scopurile și mijloacele prelucrării datelor tale este:</p>
        <ul>
          <li>Denumire: <span class="mtz-legal-ph">[DENUMIRE DEZVOLTATOR S.R.L.]</span></li>
          <li>CUI: <span class="mtz-legal-ph">[CUI]</span> · Nr. Reg. Com.: <span class="mtz-legal-ph">[J__/___/____]</span></li>
          <li>Sediu: <span class="mtz-legal-ph">[ADRESĂ SEDIU SOCIAL]</span></li>
          <li>E-mail: <a href="mailto:office@mtznordresidence.ro">office@mtznordresidence.ro</a></li>
          <li>Telefon: <span class="mtz-legal-ph">[TELEFON]</span></li>
          <li>Responsabil cu protecția datelor (DPO), dacă este desemnat: <span class="mtz-legal-ph">[DATE DPO]</span></li>
        </ul>

        <h2>2. Ce date prelucrăm</h2>
        <p>Prelucrăm datele pe care ni le furnizezi prin formularele site-ului — <strong>nume, număr de telefon și, opțional, adresa de e-mail</strong> — și datele tehnice generate automat la navigare (adresă IP, date despre dispozitiv și browser).</p>

        <h2>3. Scopurile și temeiurile legale</h2>
        <ul>
          <li><strong>Gestionarea solicitărilor și a cererilor de ofertă</strong> — temei: demersuri precontractuale la cererea ta și interesul legitim de a răspunde (art. 6 alin. 1 lit. b și f).</li>
          <li><strong>Transmiterea de oferte și comunicări comerciale</strong> — temei: consimțământul tău (art. 6 alin. 1 lit. a), pe care îl poți retrage oricând.</li>
          <li><strong>Funcționarea și securitatea site-ului</strong> — temei: interesul legitim (art. 6 alin. 1 lit. f).</li>
          <li><strong>Respectarea obligațiilor legale</strong> — temei: obligația legală (art. 6 alin. 1 lit. c).</li>
        </ul>

        <h2>4. Cât timp stocăm datele</h2>
        <p>Păstrăm datele doar pe durata necesară scopului pentru care au fost colectate sau pe durata impusă de lege, după care le ștergem sau le anonimizăm. Datele prelucrate pe bază de consimțământ se păstrează până la retragerea acestuia.</p>

        <h2>5. Destinatarii datelor</h2>
        <p>Datele pot fi accesate de furnizorii noștri de servicii (găzduire, e-mail, mentenanță), care acționează ca persoane împuternicite pe baza unui contract, precum și de autoritățile publice când legea o cere. Nu vindem datele tale.</p>

        <h2>6. Transferuri în afara UE/SEE</h2>
        <p>Unele servicii terțe folosite pentru afișarea site-ului (de ex. furnizori de fonturi sau hărți) pot prelucra date în afara Spațiului Economic European. În aceste cazuri, transferul se face cu garanțiile prevăzute de GDPR (clauze contractuale standard sau decizii de adecvare).</p>

        <h2>7. Drepturile tale</h2>
        <p>În calitate de persoană vizată, ai următoarele drepturi:</p>
        <ul>
          <li>dreptul de acces la datele tale;</li>
          <li>dreptul la rectificarea datelor inexacte;</li>
          <li>dreptul la ștergere („dreptul de a fi uitat");</li>
          <li>dreptul la restricționarea prelucrării;</li>
          <li>dreptul la portabilitatea datelor;</li>
          <li>dreptul de a te opune prelucrării;</li>
          <li>dreptul de a-ți retrage consimțământul oricând, fără a afecta legalitatea prelucrării anterioare;</li>
          <li>dreptul de a depune plângere la autoritatea de supraveghere.</li>
        </ul>

        <h2>8. Cum îți exerciți drepturile</h2>
        <p>Trimite o cerere la <a href="mailto:office@mtznordresidence.ro">office@mtznordresidence.ro</a>. Îți răspundem în cel mult 30 de zile.</p>

        <h2>9. Autoritatea de supraveghere</h2>
        <p>Dacă apreciezi că drepturile tale au fost încălcate, te poți adresa Autorității Naționale de Supraveghere a Prelucrării Datelor cu Caracter Personal (ANSPDCP):</p>
        <ul>
          <li>B-dul G-ral Gheorghe Magheru nr. 28-30, Sector 1, București</li>
          <li>E-mail: <a href="mailto:anspdcp@dataprotection.ro">anspdcp@dataprotection.ro</a></li>
          <li>Web: <a href="https://www.dataprotection.ro" target="_blank" rel="noopener noreferrer">www.dataprotection.ro</a></li>
        </ul>

        <h2>10. Securitate și actualizări</h2>
        <p>Aplicăm măsuri tehnice și organizatorice adecvate pentru protejarea datelor. Această informare poate fi actualizată; versiunea în vigoare este cea publicată pe această pagină.</p>

      </article>
    </div>
  </section>
</div>

@endsection
