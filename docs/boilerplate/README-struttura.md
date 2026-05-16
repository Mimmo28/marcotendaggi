# Progetto Boilerplate Astro
Questo progetto è basato su **Astro 6** e **Tailwind CSS 4**, ottimizzato per siti vetrina multi-lingua con alte prestazioni e SEO.

## Architettura delle Cartelle
- `/src/layouts/`: Contiene `Layout.astro`, il template principale che avvolge tutte le pagine.
- [layout-e-ux-mobile.md](./layout-e-ux-mobile.md): Soluzioni per zoom inverso, sticky header e menu mobile.
- [guida-google-search-console.md](./guida-google-search-console.md): Verifica dominio e invio sitemap su Google.
- [componeti-core.md](./componenti-core.md): Guida all'uso dei componenti comuni.
utilizzabili (Header, Footer, Card, etc.).
- `/src/pages/`: Struttura delle rotte:
    - `index.astro`: Home page in lingua predefinita (IT).
    - `/en/`: Sottocartella per la versione inglese.
    - `/[categoria].astro`: Rotte dinamiche per collezioni e brand.
- `/src/i18n/`: Logica di traduzione e routing multi-lingua.
- `/public/`: Risorse statiche come il logo e il favicon.

## Come far partire il progetto
1. Installa le dipendenze: `npm install`
2. Avvia in modalità sviluppo: `npm run dev`
3. Genera la build per produzione: `npm run build`
