# Guida Google Search Console (GSC)

Questa guida spiega come indicizzare correttamente il tuo sito su Google dopo averlo pubblicato.

## 1. Verifica Proprietà del Dominio
Google deve essere sicuro che il sito sia tuo.

1. Vai su [Google Search Console](https://search.google.com/search-console).
2. Clicca sul selettore di proprietà in alto a sinistra e scegli **"Aggiungi proprietà"**.
3. Scegli l'opzione **"Dominio"** (quella a sinistra). Inserisci il tuo dominio (es. `megashoparredi.it`).
4. **Copia il record TXT** che ti fornisce Google.
5. Vai nel pannello di gestione del tuo DNS.
   - **Su cPanel**: Cerca l'icona **"Zone Editor"** (o "Editor di zona") nella sezione **Domini**. Clicca su **"Gestisci"** (Manage) accanto al tuo dominio, poi su **"Aggiungi Record"** e scegli il tipo **TXT**.
   - **Altrove**: (es. Aruba, Cloudflare) Cerca "Gestione DNS" o "Name Server".
6. Incolla il codice e salva.
7. Torna su GSC e clicca su **"Verifica"**. (Potrebbe volerci qualche minuto prima che il DNS si aggiorni).

---

## 2. Invio della Sitemap
Una volta verificato il sito, devi consegnare la "mappa" a Google.

1. Nel menu a sinistra di GSC, clicca su **Sitemap** (sotto la sezione "Indicizzazione").
2. Nel campo "Aggiungi una nuova sitemap", incolla solo la parte finale dell'URL: `sitemap-index.xml`.
   - **Nota**: Se Google non accetta solo la parte finale, prova a incollare l'URL completo (es. `https://www.tuosito.it/sitemap-index.xml`).
3. Clicca su **Invia**.
4. Vedrai comparire una riga con lo stato **"Operazione completata"** in verde. Da questo momento Google inizierà a esplorare tutte le pagine elencate nel file.

---

## 3. Strumento "Controllo URL" (Il "Turbo")
Questo serve per forzare Google a passare subito sulla tua Home Page.

1. In alto, nella barra di ricerca grigia che dice "Ispeziona qualsiasi URL in...", digita l'indirizzo completo: `https://www.tuosito.it/`.
2. Google ti dirà: "L'URL non è presente su Google".
3. Clicca sul pulsante in basso a destra: **"Richiedi indicizzazione"**.
4. Apparirà un popup che dice "Verifica se l'URL pubblicato può essere indicizzato". Se tutto è ok, la richiesta verrà messa in coda prioritaria.

---

## 4. Consiglio Extra per Astro
Dato che usi Astro, assicurati che nel tuo file `astro.config.mjs` il campo `site` sia configurato correttamente:

```javascript
// astro.config.mjs
export default defineConfig({
  site: 'https://www.tuosito.it',
  // ... altre config
});
```

> [!TIP]
> Senza questa riga, la sitemap generata automaticamente potrebbe contenere URL errati o relativi, impedendo a Google di trovare le pagine.
