# Checklist Accessibilità (WCAG)

Obiettivo: Raggiungere 100/100 su Lighthouse e garantire l'uso a tutti gli utenti.

## 1. Struttura Semantica
- [ ] Usa un solo `<h1>` per pagina.
- [ ] Segui l'ordine gerarchico dei titoli (`h1` -> `h2` -> `h3`). Non saltare livelli.
- [ ] Usa i tag semantici: `<header>`, `<nav>`, `<main>`, `<section>`, `<footer>`.

## 2. Navigazione e Pulsanti
- [ ] **Link vs Button**: Usa `<a>` per cambiare pagina, `<button>` per azioni (aprire menu, inviare form).
- [ ] **Aria-Label**: Se un pulsante contiene solo un'icona (es. il pulsante "chiudi" del menu), deve avere un `aria-label="Chiudi menu"`.
- [ ] **Focus State**: Non rimuovere mai l'`outline` dal focus senza fornire un'alternativa visuale chiara.

## 3. Colori e Contrasti
- [ ] Assicurati che il contrasto tra testo e sfondo rispetti il rapporto di **4.5:1** per il testo normale.
- [ ] Non usare solo il colore per trasmettere informazioni (es. un bordo rosso non basta per indicare un errore, serve anche un'icona o un testo).

## 4. Immagini
- [ ] Tutte le immagini devono avere un attributo `alt` descrittivo. Se l'immagine è puramente decorativa, usa `alt=""`.
