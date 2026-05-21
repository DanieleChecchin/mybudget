# 💰 MyBudget

Applicazione web per la gestione delle spese personali sviluppata in Laravel.

**MyBudget** nasce come progetto personale per tracciare entrate, uscite, budget e obiettivi di risparmio, con particolare attenzione all’esperienza utente e all’automazione delle operazioni ricorrenti.

---

## 🚀 Features

### MVP (prima versione)

- ✅ Autenticazione utenti
- ✅ Dashboard mensile
- ✅ Gestione entrate e uscite
- ✅ Categorie personalizzabili
- ✅ Filtri per periodo e categoria
- ✅ Budget mensili
- ✅ Grafici andamento spese
- ✅ Multi account (conto, carta, contanti)

### Planned Features

- 🔄 Transazioni ricorrenti (abbonamenti, stipendio, affitto)
- 🧾 OCR scontrini e PDF
- 🏦 Import CSV banca
- 🎯 Obiettivi di risparmio
- 🏷️ Sistema tag
- 🔔 Notifiche budget
- 📤 Export PDF / Excel
- 🌍 Multi valuta
- 📱 Responsive / PWA

---

## 🛠️ Tech Stack

### Backend
- PHP 8+
- Laravel
- MySQL / MariaDB

### Frontend
- Livewire
- Blade
- Bootstrap

### Librerie previste

- Laravel Breeze → autenticazione
- Laravel Livewire → UI dinamica
- Laravel Excel → import/export CSV & Excel
- DomPDF → export PDF
- Spatie Laravel Permission → ruoli e permessi
- Laravel Pulse → monitoraggio performance
- Chart.js / ApexCharts → grafici dashboard

---

## 📸 Screenshots

> Coming soon

---

## 📂 Project Structure

```txt
app/
├── Models
├── Services
├── Actions
├── DTOs
├── Enums
└── Livewire

resources/
├── views
└── js
```

---

## ⚙️ Installation

Clona il repository:

```bash
git clone https://github.com/your-username/mybudget.git
```

Entra nella cartella:

```bash
cd mybudget
```

Installa le dipendenze:

```bash
composer install
npm install
```

Copia il file `.env`:

```bash
cp .env.example .env
```

Genera la chiave:

```bash
php artisan key:generate
```

Configura database nel `.env` e lancia le migration:

```bash
php artisan migrate
```

Avvia il server:

```bash
php artisan serve
```

Compila assets:

```bash
npm run dev
```

---

## 🧠 Obiettivo del progetto

Questo progetto nasce per:

- migliorare competenze Laravel avanzate
- sperimentare architetture scalabili
- utilizzare librerie reali di produzione
- lavorare con jobs, scheduler, queue e testing
- creare un prodotto realmente utile nella vita quotidiana

---

## 🗺️ Roadmap

### v0.1 – MVP
- [ ] Login / registrazione
- [ ] CRUD transazioni
- [ ] Dashboard
- [ ] Categorie
- [ ] Budget mensile

### v0.2 – Smart Features
- [ ] Ricorrenze automatiche
- [ ] Obiettivi risparmio
- [ ] Grafici avanzati

### v0.3 – Automation
- [ ] OCR ricevute
- [ ] Import CSV banca
- [ ] Suggerimenti automatici categorie

### v1.0
- [ ] Deploy production
- [ ] Testing completo
- [ ] PWA
- [ ] Premium features

---

## 📖 Learning Goals

Con questo progetto voglio approfondire:

- Laravel Architecture
- Service Pattern
- Queue & Jobs
- Events & Listeners
- API integrations
- File processing
- Testing (Feature / Unit)
- Caching
- Performance optimization

---

## 📄 License

MIT
