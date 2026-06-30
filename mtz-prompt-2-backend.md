# MTZ Nord Residence — Prompt 2: Backend

## Context

Frontendul este deja implementat în Laravel 12 cu Blade, Alpine.js și Tailwind. Toate paginile funcționează cu date hardcodate. Această fază conectează totul la o bază de date reală și construiește panoul de administrare.

**Regulă:** nu modifica views, CSS sau JavaScript din Phase 1 decât dacă e strict necesar pentru a wires up date dinamice.

---

## Stack Adițional

MySQL, Filament v3, Intervention Image v3, Laravel Mail.

---

## Entități și Relații

Definește modele, migrații și relații pentru:

**Apartment** — un apartament din bloc. Are: slug, nume, etaj, număr camere, suprafață utilă, suprafață balcon, orientare, status (disponibil/vândut/închiriat), preț (opțional, vizibil sau ascuns), dotări, descriere, imagini multiple, ordinea de afișare.

**Lead** — o persoană care a luat contact. Are: nume, prenume, telefon, email, sursa contactului (formular web / click WhatsApp / adăugat manual), apartamentul de interes (referință sau text liber), preferințe (camere, buget, modalitate plată), mesajul trimis, statusul în pipeline (nou / contactat / interesat / negociere / vândut / pierdut), note interne, data primului contact.

**ProgressUpdate** — un update lunar de pe șantier. Are: titlu, lună, an, descriere, imagini multiple, status (draft / publicat).

**WhatsappClick** — eveniment anonim. Are: pagina de pe care s-a dat click, slug-ul apartamentului dacă e cazul, timestamp.

---

## Funcționalitate Backend

### Formular de contact
- Validează și salvează lead în baza de date
- Trimite email de notificare către adresa din `.env`
- Trimite email de confirmare către lead (dacă a furnizat email)
- Ambele email-uri sunt HTML, branded cu culorile proiectului

### Tracking WhatsApp
- Endpoint `POST /whatsapp-click` — înregistrează click anonim
- Rate limited (protecție anti-spam)
- Toate butoanele de WhatsApp din frontend trimit un request la acest endpoint via Alpine.js `fetch`

### Date dinamice
- Home page: selectorul de etaje primește datele apartamentelor din DB (slug, nume, etaj, status, culoare status, URL pagină)
- Pagina apartament: toate datele și imaginile din DB
- Pagina progres: update-urile publicate din DB, ordonate cronologic descrescător

---

## Admin Panel — Filament v3

Panoul de admin este la `/admin`. Construiește-l ca pe un CRM simplu dar complet.

### Apartamente
CRUD complet. Câmpurile importante: status cu badge colorat, preț cu opțiunea de a-l ascunde, upload imagini multiple cu reordonare, generare automată slug din nume. Filtre după status, etaj, număr camere.

### Leads — CRM
Acesta este cel mai important resource. Trebuie să fie complet funcțional ca un CRM minimal.

Tabelul afișează: nume, telefon, email, sursă, apartament de interes, status cu badge colorat, data creării.

Filtre: după status, sursă, preferință camere, interval dată.

Formularul permite editarea completă a unui lead, inclusiv notele interne și statusul din pipeline.

Acțiuni bulk: schimbarea statusului pentru mai multe lead-uri simultan, export CSV.

Pe pagina de index, deasupra tabelului, afișează un rând de statistici: total leads, câte sunt noi, câte sunt active (contactat + interesat + negociere), câte au rezultat în vânzare.

### Progres Șantier
CRUD pentru update-uri lunare. Upload imagini cu reordonare drag-and-drop. Max 10 imagini per update. Imaginile sunt procesate la upload (resize la max 2000px, calitate 85%, JPEG). Câmp status draft/publicat.

### Clicks WhatsApp
Resource read-only — doar vizualizare. Pe dashboard, un grafic cu clicks per zi în ultimele 30 de zile.

### Dashboard
Widgets:
1. Statistici rapide: apartamente disponibile, leads totale, leads noi, clicks WhatsApp luna curentă
2. Grafic leads pe status (pie/donut)
3. Ultimele 10 leads (tabel)
4. Grafic clicks WhatsApp (ultimele 30 zile)

---

## Stocare Imagini

Local disk, `storage/app/public`. Imaginile sunt accesate via `Storage::url()`. Rulează `php artisan storage:link` în setup.

La upload, procesează cu Intervention Image: resize la max 2000px pe latura lungă, calitate 85, salvează ca JPEG.

---

## Seeder

Seed-uiește date realiste pentru demo:
- ~25 apartamente pe 5 etaje, mix de statusuri
- 3 progress updates publicate
- 1 user admin cu credențiale din `.env`

---

## Variabile de Mediu

```env
ADMIN_EMAIL=
ADMIN_PASSWORD=
NOTIFICATION_EMAIL=
MAIL_MAILER=smtp
MAIL_FROM_ADDRESS=
MAIL_FROM_NAME="MTZ Nord Residence"
```

---

## Note Deployment (Shared Hosting cPanel)

- MySQL, PHP 8.2+
- `APP_ENV=production`, `APP_DEBUG=false`
- `php artisan config:cache && route:cache && view:cache`
- `storage/` și `bootstrap/cache/` writeable (755)

---

## Deliverable Phase 2

Aplicație complet funcțională unde: toate datele vin din DB, formularul salvează leads și trimite emails, clicks WhatsApp sunt tracked, panoul Filament oferă management complet al apartamentelor, leads și progres șantier, `php artisan migrate --seed` rulează fără erori.
