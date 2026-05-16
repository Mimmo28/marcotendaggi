# Layout e UX Mobile: Soluzioni Moderne

In questo documento sono raccolte le soluzioni tecniche adottate per garantire un'esperienza mobile d'eccellenza, risolvendo bug comuni come l'overflow orizzontale e il posizionamento errato degli elementi fissi.

## 1. Problema "Zoom Inverso" (Overflow Orizzontale)

Lo scorrimento orizzontale indesiderato su mobile è spesso causato dall'uso di `100vw`, che include la larghezza della scrollbar verticale, o da elementi che sporgono per pochi pixel.

### Soluzione:
- **Usare `100%` invece di `100vw`**: Per la larghezza di `html` e `body`.
- **Protezione con `overflow-x: clip`**: A differenza di `hidden`, `clip` non interferisce con il posizionamento `sticky`.

```css
/* In global.css */
html, body {
  max-width: 100%;
  overflow-x: clip;
  position: relative;
}
```

### Best Practice:
Sempre aggiungere `overflow-x: clip` anche al tag `<main>` per catturare elementi decorativi sporgenti.

---

## 2. Sticky Header con Backdrop-Blur

L'uso di `backdrop-blur` o filtri CSS sull'header crea un nuovo "stacking context". Questo può rompere il posizionamento di elementi `fixed` (come il menu mobile) se questi sono figli dell'header.

### Bug Riscontrato:
Il menu mobile si apriva in cima alla pagina (`y=0`) e non nel viewport corrente quando l'utente aveva scrollato.

### Soluzione:
**Spostare i componenti Overlay e Sidebar fuori dal tag `<header>`**. Devono essere fratelli dell'header o posizionati alla radice del body.

```astro
<!-- Header.astro -->
<header class="sticky top-0 z-50 backdrop-blur-lg">
  <!-- Contenuto Header -->
</header>

<!-- Menu e Overlay FUORI dall'header -->
<div id="mobile-menu-overlay" class="fixed inset-0 z-[60]"></div>
<div id="mobile-menu" class="fixed inset-0 z-[70]"></div>
```

---

## 3. Gestione Spazio Header Mobile

Su schermi stretti (es. 375px), un header con molti elementi (burger, logo, testo, pulsanti) può affollarsi e causare overflow.

### Soluzione:
- **Ridurre il Logo**: Impostare un `max-width` rigoroso su mobile (es. 40-50px).
- **Controllo Shrink**: Usare `shrink-0` sugli elementi che non devono mai rimpicciolirsi.
- **Padding Responsivo**: Usare `px-4` su mobile e `px-6+` su desktop.

```html
<a class="flex md:hidden items-center shrink-0 max-w-[45px]">
  <Image src={logo} alt="Logo" class="h-8 w-auto object-contain" />
</a>
```

---

## 4. Scroll Lock

Quando il menu mobile è aperto, è opportuno bloccare lo scorrimento della pagina sottostante.

```javascript
/* All'apertura del menu */
document.body.style.overflow = 'hidden';

/* Alla chiusura */
document.body.style.overflow = '';
```
