# Gestione Errori e Pagina 404

Una buona gestione degli errori migliora l'esperienza utente e previene il "rimbalzo" dei visitatori (bounce rate).

## 1. Pagina 404 Personalizzata
Crea sempre un file `src/pages/404.astro`. Deve contenere:
- Un messaggio chiaro che la pagina non esiste.
- Un pulsante ben visibile per tornare alla Home o alla pagina precedente.
- Eventualmente un campo di ricerca o le categorie principali.

## 2. Reindirizzamenti (Redirects)
Se cambi uno slug o sposti una pagina, aggiorna il file `astro.config.mjs` per gestire i reindirizzamenti 301 (permanenti):

```javascript
// astro.config.mjs
export default defineConfig({
  redirects: {
    '/vecchia-pagina': '/nuova-pagina',
  }
});
```

## 3. Gestione Errori Script
Usa i blocchi `try...catch` nei tuoi componenti lato client per evitare che un errore in uno script secondario blocchi l'intera pagina.
