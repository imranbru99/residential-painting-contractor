# Cedarline Residential Painting — Laravel 13 + Filament 3 ERP & AI Site

Production-ready website, Filament ERP, and AI assistants for a US residential painting contractor (Raleigh–Durham). Brand: **Cedarline Residential Painting**.

## ✨ Features
- 🏠 Public marketing site with hero, services, about, dashboard preview, and contact form
- 🎨 Service detail pages for interiors, exteriors, cabinets, decks, trim, and color consults
- 📰 Blog / knowledge posts seeded with painting-specific guidance
- 📚 Knowledge base: common issues, guides, admin manual, troubleshooting
- 💬 Floating WhatsApp button + public AI chatbot (FAQ demo or live API)
- 🗂️ Filament ERP at `/admin` — customers, jobs, inventory, invoices, payments, appointments
- 👥 Roles: Admin, Manager, Staff
- 📊 Reports dashboard with stats + jobs chart widgets
- ⚙️ Company settings page
- 🤖 Admin AI: content generator, automation suggestions, troubleshooting assistant
- 🌱 Realistic demo seeders for Triangle-area painting operations

## 🛠️ Tech Stack
- Laravel 13
- Filament 3
- Tailwind CSS 4 + Vite + Livewire + Alpine.js
- MySQL or SQLite (demo default)
- OpenAI / Gemini via HTTP (optional keys) with FAQ fallback
- Spatie Laravel Permission

## 🚀 Installation
```bash
git clone https://github.com/imranbru99/residential-painting-contractor.git
cd residential-painting-contractor
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate --seed
npm install
npm run build
php artisan serve
```

Admin panel: `http://localhost:8000/admin`  
Login: `admin@example.com` / `password`

Configure `OPENAI_API_KEY` or `GEMINI_API_KEY` in `.env` for live AI; otherwise demo FAQ responses are used.

For MySQL, set `DB_CONNECTION=mysql` and related credentials in `.env`, then migrate again.

## 🖼️ Screenshots / Visual Dashboard
![Cedarline interior painting hero](https://images.unsplash.com/photo-1562259949-e8e7689d7828?auto=format&fit=crop&w=1200&q=80)

![Paint brushes and residential color prep](https://images.unsplash.com/photo-1589939705384-5185137a7f0f?auto=format&fit=crop&w=1200&q=80)

![Suburban home exterior finish](https://images.unsplash.com/photo-1605276374104-dee2a0ed3cd6?auto=format&fit=crop&w=1200&q=80)

![Paint supply staging for job crews](https://images.unsplash.com/photo-1558618666-fcd25c85f82e?auto=format&fit=crop&w=1200&q=80)

## 🌐 Live Demo
Placeholder — deploy to your host and share the public URL + `/admin` demo credentials.

## 🔍 SEO-Optimized Repo Description Suggestion
`Cedarline Residential Painting — Laravel 13 + Filament 3 website, ERP, and AI chatbot for US residential painting contractors (jobs, inventory, invoices, KB).`

---

## 🤝 Let's Connect & Collaborate
I am open to Senior Remote Full-Stack Roles, AI Platform Architecture Contracts, and Enterprise Technical Advisory.
Timezone: UTC+6 (Dhaka / Rangpur, Bangladesh) — Flexible overlap with US, UK, and European business hours.
Delivery Mode: Async-ready, Slack, Discord, Jira, GitHub, and production-first accountability.

| Channel | Address / Handle | Quick Action |
|---------|------------------|--------------|
| 🌐 Primary Portfolio | imrandev.bd | Visit Site ↗ |
| 📦 Packagist Packages | packagist.org/packages/imrandevbd/ | View Packages ↗ |
| 💼 LinkedIn Profile | linkedin.com/in/imranbru99 | Connect ↗ |
| 🐙 GitHub Profile | github.com/imranbru99 | Follow ↗ |
| 💬 WhatsApp Direct | +880 1576-918420 | Chat Now ↗ |
| 📧 Direct Email | me@imrandev.bd | Send Email ↗ |
| 🐦 X (Twitter) | @imrandev_bd | Follow ↗ |
| 📺 YouTube Tech | @ImranDevBD | Subscribe ↗ |
