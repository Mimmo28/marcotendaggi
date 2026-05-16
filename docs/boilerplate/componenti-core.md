# Componenti Core Strategici

## Layout Principale (Layout.astro)
Risolve il bug dello scroll bloccato. Importante: **NON** usare `overflow-hidden` o `overflow-x-hidden` sul body/html per permettere la `position: sticky`.

```astro
---
import '../styles/global.css';
import Header from '../components/Header.astro';
---
<html lang="it">
  <body class="min-h-screen flex flex-col bg-primary text-text">
    <Header />
    <main class="flex-grow">
      <slot />
    </main>
  </body>
</html>
```

## Header Sticky Glassmorphism (Header.astro)
Design moderno con trasparenza al 70% ed effetto sfocatura.

```astro
<header class="sticky top-0 z-50 bg-white/70 backdrop-blur-lg border-b border-border/50 transition-colors duration-300 shadow-sm">
  <div class="max-w-7xl mx-auto px-6 h-20 md:h-24 flex items-center justify-between">
    <!-- Logo e Navigazione -->
  </div>
</header>
```

## Menu Mobile Sidebar
Logica JavaScript essenziale per l'apertura/chiusura con transizioni fluide.

```javascript
const openMenu = () => {
  menu.classList.remove('invisible');
  requestAnimationFrame(() => {
    menu.classList.remove('translate-x-full');
    overlay.classList.remove('opacity-0', 'pointer-events-none');
    document.body.style.overflow = 'hidden';
  });
};
```
