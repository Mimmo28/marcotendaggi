# Guida SEO e Multi-Lingua

## Routing Multi-Lingua (IT/EN)
Utilizziamo una struttura a sottocartelle (`/en/` per l'inglese) e un file `ui.ts` per le stringhe di traduzione.
- **getLangFromUrl**: Estrae la lingua dall'URL.
- **useTranslatedPath**: Genera i link corretti (es. aggiunge `/en` solo se necessario).

## Meta Tag Dinamici
Ogni pagina deve passare il titolo e la descrizione al componente `Layout`.

```astro
---
import Layout from '../layouts/Layout.astro';
const title = "Nome Pagina";
const description = "Descrizione ottimizzata con keyword locali...";
---
<Layout title={title} description={description}> ... </Layout>
```

## Ottimizzazione Immagini
Usa sempre il componente `<Image />` di Astro per generare automaticamente i formati WebP e gestire il Lazy Loading.
