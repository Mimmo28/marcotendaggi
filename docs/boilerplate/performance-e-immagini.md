# Performance e Ottimizzazione Immagini

Le immagini sono spesso la causa principale di un sito lento. In Astro, l'ottimizzazione è integrata ma va usata correttamente.

## 1. Il Componente `<Image />`
Importa sempre `@astrojs/image` (o il core in Astro 5/6) per processare le immagini.

```astro
---
import { Image } from 'astro:assets';
import myImage from '../assets/hero.jpg';
---
<Image 
  src={myImage} 
  alt="Descrizione" 
  width={800} 
  height={600} 
  format="webp"
  quality="high"
/>
```

## 2. Priorità di Caricamento
- **Above the Fold (Hero)**: Usa `loading="eager"` e `fetchpriority="high"`. Questo dice al browser di scaricare subito quell'immagine.
- **Below the Fold**: Lascia il default `loading="lazy"` per non rallentare l'avvio della pagina.

## 3. Prevenire il Layout Shift (CLS)
- Specifica sempre `width` e `height` (o un `aspect-ratio` nel CSS) per riservare lo spazio all'immagine prima che venga scaricata.

## 4. Font Locali
- Scarica i font e servili localmente invece di usare Google Fonts esternamente per migliorare la privacy (GDPR) e la velocità di caricamento.
