# 🚀 Guida alla Migrazione del Deploy su cPanel (Hosting & Dominio Reale)

Questo documento serve come promemoria per configurare il deploy su cPanel (tramite FTPS) non appena acquisterai l'hosting e il dominio definitivi per **Marco Tendaggi**.

---

## 🛠️ Step 1: Inserire le credenziali FTP nei "Secrets" di GitHub

Prima di tutto, devi inserire le credenziali dell'hosting su GitHub in modo che l'Action possa accedere al server senza esporre le password nel codice:

1. Vai sul tuo repository su GitHub: `Mimmo28/marcotendaggi`.
2. Clicca sulla scheda **Settings** (Impostazioni) in alto.
3. Nel menu a sinistra, clicca su **Secrets and variables** -> **Actions**.
4. Clicca su **New repository secret** (Nuovo segreto del repository).
5. Crea i seguenti tre segreti usando le credenziali fornite dal tuo hosting:
   * **`FTP_SERVER`** (es. `ftp.marcotendaggi.it` o l'indirizzo IP del server)
   * **`FTP_USERNAME`** (l'utente dell'FTP)
   * **`FTP_PASSWORD`** (la password dell'FTP)

---

## 💻 Step 2: Modificare la configurazione di Astro

Nel file `astro.config.mjs`, dobbiamo rimettere il dominio reale e rimuovere la proprietà `base` di GitHub Pages.

### Prima (GitHub Pages):
```javascript
export default defineConfig({
  site: 'https://Mimmo28.github.io',
  base: '/marcotendaggi',
  // ...
```

### Dopo (cPanel):
```javascript
export default defineConfig({
  site: 'https://www.marcotendaggi.it', // <-- Il tuo nuovo dominio reale
  // La riga "base: ..." va completamente ELIMINATA per servire il sito nella cartella principale del dominio
  i18n: {
  // ...
```

---

## 📦 Step 3: Ripristinare il Workflow di Deploy FTP

Il file `.github/workflows/deploy.yml` deve essere riscritto per caricare i file compilati direttamente sullo spazio web di cPanel anziché su GitHub Pages.

Ecco il codice completo da sostituire in `.github/workflows/deploy.yml`:

```yaml
name: 🚀 Deploy Marco Tendaggi
on:
  push:
    branches:
      - main

jobs:
  web-deploy:
    name: 🏗️ Build & Sync
    runs-on: ubuntu-latest
    steps:
      - name: 🚚 Get latest code
        uses: actions/checkout@v4

      - name: 🟢 Setup Node.js 22
        uses: actions/setup-node@v4
        with:
          node-version: '22'
          cache: 'npm'

      - name: 🛠️ Install dependencies (reproducible)
        run: npm ci

      - name: 🏗️ Build Project
        run: npm run build

      - name: 📂 Sync files to cPanel via FTPS
        uses: SamKirkland/FTP-Deploy-Action@v4.3.5
        with:
          server: ${{ secrets.FTP_SERVER }}
          username: ${{ secrets.FTP_USERNAME }}
          password: ${{ secrets.FTP_PASSWORD }}
          port: 21
          local-dir: ./dist/
          server-dir: ./
          protocol: ftps
          exclude: |
            **/.git*
            **/.git*/**
            **/node_modules/**
```

---

## 📝 Cosa dire all'Assistente AI per procedere:
Quando avrai i dati dell'hosting e sarai pronto, apri una nuova chat e digita semplicemente:
> *"Ho comprato l'hosting e impostato i 3 segreti FTP su GitHub. Procedi pure con la migrazione a cPanel seguendo la guida in `docs/MIGRAZIONE_CPANEL.md`."*
