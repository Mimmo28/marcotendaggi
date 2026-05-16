# English Pages & Translation Guidelines

Per garantire un'esperienza utente professionale e coerente su `megashoparredi.it`, è essenziale che la versione inglese sia sempre lo specchio fedele di quella italiana.

## 1. Struttura delle Directory e File
Il sito utilizza un sistema di routing multilingua basato su subdirectory:
- **Italiano (Default)**: `src/pages/`
- **Inglese**: `src/pages/en/`

### Regola d'Oro:
Ogni file creato in `src/pages/` deve avere un file identico in `src/pages/en/`.
*Esempio: Se crei `src/pages/nuova-collezione.astro`, devi creare anche `src/pages/en/nuova-collezione.astro`.*

## 2. Utilizzo delle Traduzioni (`i18n`)
Non inserire mai testi statici direttamente nei file `.astro`. Utilizza sempre il sistema di traduzione centralizzato.

### Dove tradurre:
I testi si trovano in `src/i18n/ui.ts`. Aggiungi la chiave sia sotto `it` che sotto `en`.

### Come richiamare i testi:
```astro
---
import { getLangFromUrl, useTranslations } from '../../i18n/utils';
const lang = getLangFromUrl(Astro.url);
const t = useTranslations(lang);
---
<h1>{t('titolo.pagina')}</h1>
```

## 3. Gestione dei Link (Navigation)
Non usare link diretti come `<a href="/contatti">`. Usa `useTranslatedPath` per assicurarti che l'utente rimanga nella lingua corretta.

### Esempio:
```astro
---
import { getLangFromUrl, useTranslatedPath } from '../../i18n/utils';
const lang = getLangFromUrl(Astro.url);
const translatePath = useTranslatedPath(lang);
---
<a href={translatePath('/contatti')}>Contatti</a>
```

## 4. Rotte Dinamiche (`[brand]` e `[categoria]`)
Le rotte dinamiche devono essere presenti in entrambe le lingue:
- `src/pages/brand/[brand].astro`
- `src/pages/en/brand/[brand].astro`

Assicurati che i dati caricati (es. descrizioni dei brand o delle categorie) siano tradotti in base alla variabile `lang`.

## 5. Checklist di Sincronizzazione
In caso di discrepanze tra IT ed EN, verifica:
- [ ] Il file esiste in entrambe le cartelle `src/pages/` e `src/pages/en/`?
- [ ] Entrambi i file utilizzano lo stesso componente di layout o di pagina?
- [ ] Tutte le stringhe di testo sono passate attraverso la funzione `t()`?
- [ ] I link interni usano `translatePath()`?
- [ ] Le immagini e gli asset sono coerenti tra le due versioni?
