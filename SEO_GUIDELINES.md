# SEO & Multilingual Guidelines

Questo documento serve come riferimento per mantenere l'ottimizzazione SEO e la corretta indicizzazione del sito `megashoparredi.it`.

## 1. Gestione Multilingua (Tag `hreflang`)
Il sistema è configurato per gestire i tag `hreflang` in modo **automatico** all'interno del componente `Layout.astro`.

### Come funziona:
- Quando viene creata una nuova pagina (es. `src/pages/nuova-pagina.astro`), il layout calcola automaticamente l'URL della versione corrispondente in inglese (`/en/nuova-pagina`).
- **Importante**: Per ogni nuova pagina creata in `src/pages/`, assicurati di creare la versione speculare in `src/pages/en/` per garantire che Google possa indicizzare correttamente entrambe le lingue.

## 2. Esclusione dall'Indicizzazione (`noindex`)
Se aggiungi pagine di utilità, bozze o pagine di errore che **non** devono apparire su Google:

### Come fare:
Passa la prop `noindex={true}` al componente `Layout`:
```astro
---
import Layout from '../layouts/Layout.astro';
---
<Layout title="Titolo Pagina" noindex={true}>
  <!-- Contenuto -->
</Layout>
```

## 3. Mappa del Sito (Sitemap)
La `sitemap.xml` viene generata automaticamente ad ogni build.
- Le pagine che contengono `/404` nell'URL vengono già escluse automaticamente tramite la configurazione in `astro.config.mjs`.
- Se desideri escludere altre pagine dalla sitemap, aggiorna la funzione `filter` nel file `astro.config.mjs`.

## 4. Checklist per Nuove Pagine
- [ ] La pagina è presente sia in `src/pages/` che in `src/pages/en/`?
- [ ] Hai usato il componente `<Layout>`?
- [ ] Se la pagina non deve essere indicizzata, hai impostato `noindex={true}`?
- [ ] Hai aggiunto i testi tradotti in `src/i18n/ui.ts`?
