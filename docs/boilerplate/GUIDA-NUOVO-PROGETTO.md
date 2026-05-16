# Guida Operativa: Come Avviare un Nuovo Progetto

Questa guida ti spiega come usare i file in questa cartella per creare un nuovo sito da zero in modo veloce e senza errori.

## Opzione A: Il Metodo "Copia e Incolla" (Più veloce)
Invece di ricominciare da zero, usa l'attuale progetto come "scheletro".

1.  **Duplica la cartella** del progetto attuale.
2.  **Pulisci i contenuti**:
    - Vai in `src/pages/` e tieni solo le strutture (index, contatti, chi-siamo).
    - Vai in `src/i18n/ui.ts` e sostituisci i testi con quelli del nuovo cliente.
    - Sostituisci il logo in `public/logo/icona_sito.png`.
3.  **Configura il Backend**:
    - Apri `public/contact.php` e cambia l'email `$recipient` con quella del nuovo cliente.
4.  **Installa**: Esegui `npm install` e sei pronto a partire.

## Opzione B: Il Metodo "Manuale" (Da un progetto Astro nuovo)
Se preferisci iniziare un progetto Astro pulito (`npm create astro@latest`):

1.  **Layout & CSS**: Copia `src/layouts/Layout.astro` e `src/styles/global.css`. Assicurati che il `body` non abbia `overflow-x-hidden`.
2.  **Header & Menu**: Copia `src/components/Header.astro`. È già configurato per essere sticky e con il menu mobile funzionante.
3.  **Multilingua**: Copia la cartella `src/i18n/` per avere già la logica IT/EN pronta.
4.  **Form**: Copia il modulo da `Contatti.astro` e il file `public/contact.php`.

## Checklist di Controllo (Prima di consegnare)
Prima di dire al cliente "il sito è pronto", apri questi file e spunta le voci:
1.  **`docs/boilerplate/accessibilita-checklist.md`**: Il sito è usabile da tutti?
2.  **`docs/boilerplate/seo-best-practices.md`**: Google troverà il sito?
3.  **`docs/boilerplate/performance-e-immagini.md`**: Il sito è veloce?
4.  **`docs/boilerplate/sicurezza-e-deploy.md`**: Ho protetto i dati?

## Manutenzione
Tieni sempre aggiornata questa cartella `docs/boilerplate/`. Se scopri un nuovo trucco o risolvi un nuovo errore, aggiungilo qui. Sarà il tuo "tesoro" per guadagnare tempo in futuro.
