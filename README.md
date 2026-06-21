# Marco Tendaggi - Documentazione Tecnica

Benvenuto nel codice sorgente del sito vetrina di "Marco Tendaggi", interamente progettato per essere ultra-veloce, sicuro e profondamente ottimizzato per i motori di ricerca.
Questo documento funge da "mappa tecnica" per ricordarti tutto ciò che abbiamo realizzato assieme, gli strumenti che abbiamo usato e come è configurato il tuo prezioso ecosistema digitale.

## 🚀 Architettura del Progetto

Il sito è un'applicazione web statica (SSG - Static Site Generation) costruita con le tecnologie più avanguardistiche del settore:

1. **Astro**: Il motore principale del sito. Abbiamo scelto Astro per la sua impareggiabile velocità. A differenza di CMS pesanti come WordPress, Astro elimina il codice superfluo e porta agli utenti solo pagine HTML pure e CSS alleggeriti, rendendo il sito un fulmine e totalmente invulnerabile agli attacchi al database (che qui per natura non c'è!).
2. **Tailwind CSS**: Il framework utilizzato per il design e lo styling. Ci ha permesso di ottenere un'estetica premium: palette colori personalizzata (con l'iconico oro/dorato `#E4A11B`), animazioni soffici come lo zoom delle foto e una totale responsività per cellulari, tablet e pc.

## 🛠️ Cosa abbiamo costruito (Feature List)

- **Layout e Componenti Globali**: Un *Header* (con logo a scomparsa e menu mobile), un *Footer* ricolmo di info di contatto e mercati settimanali, un pulsante galleggiante laterale (FAB) per la chat rapida tramite WhatsApp, e un complesso sistema nativo di `Lightbox` per cliccare e ingrandire le immagini delle collezioni.
- **Pagine Principali**: 
  - *Home (`/`)*: Un ingresso esplosivo con slider in apertura e griglie per la panoramica delle collezioni di tendaggi.
  - *Collezioni (`/collezioni/[nome]`)*: Varie gallerie fotografiche automatiche (tende da interno, tende da esterno, tessuti, binari, tende a rullo, veneziane) collegate intelligentemente per leggere le cartelle fisiche `public/images/`.
  - *Chi Siamo (`/chi-siamo`)*: Lo storytelling dell'attività, il focus sul showroom di Ribera (AG) e i mercati settimanali.
  - *Contatti (`/contatti`)*: Mappe interattive di Google coordinate con i colori del brand.
  - *Privacy & Cookie Policy (`/privacy`)*: Testo per i termini legali strutturato a norma di GDPR, accompagnato dal **Cookie Banner a comparsa intelligente** in fondo alla pagina.
  - *Pagina 404 (`/404`)*: Schermata esclusiva per guidare col sorriso gli avventori che premono un link errato.
- **Multilingua (i18n)**: Rete costruita internamente con i file in `src/i18n` e rotte clonate in `/en` per preparare il terreno in vista di un pubblico estero.

## 🛡️ Sicurezza e Blindatura
Il sito è stato indurito da un Security Audit completo:
- L'architettura esclude vulnerabilità pericolose come l'XSS (*Cross-Site Scripting*) o *Path Traversal* (non ci sono backend rischiosi o accessi ai file, i recapiti si avvalgono solo di interfacciamento alle app telefoniche).
- **Security Headers**: Direttive forti nel file `public/_headers` (anti-Clickjacking e traffico forzato HSTS) e un tag ferreo di *Content-Security-Policy (CSP)* nel Layout.
- **Dipendenze Sane**: Ultimo check (`npm audit`) recita 0 bug irrisolti sul pacchetto. L'ecosistema è blindato.

## 🔍 SEO e Intelligenza Artificiale
- **Sitemap & Robots**: Generazione automatica della mappa sito in `/sitemap-index.xml` tramite intelligenza nativa di Astro e file `robots.txt` a scudo d'acciaio contro determinati scraper AI non desiderati.
- **Open Graph (Social Share)**: Incorporati i Meta Tag OpenGraph per far sì che sui social (WhatsApp, Facebook, LinkedIn) l'anteprima mostri un logo fiero e una descrizione invitante.
- **LLMs.txt**: Coniando un nuovissimo standard tecnologico, il file `public/llms.txt` fa da ponte pulito perché chat intelligenti come ChatGPT e Gemini trovino e raccomandino "Marco Tendaggi".

## 👨‍💻 Comandi Utili per il Lato Tecnico
Apri il terminale dentro la cartella `marcotendaggi` e sperimenta:

| Comando                 | Azione                                                    |
| :---------------------- | :-------------------------------------------------------- |
| `npm run dev`           | Accende l'anteprima in tempo reale sul tuo web browser.   |
| `npm run build`         | Impacchetta e comprime il sito definitivo nella `/dist/`. |
| `npm run preview`       | Testa la velocità della versione finale localmente.       |
