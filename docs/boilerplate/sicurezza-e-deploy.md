# Guida al Deploy Automatizzato (Astro su cPanel)

Questa guida spiega come configurare un sistema di **Continuous Deployment** (CD) per pubblicare automaticamente il tuo sito Astro su un hosting cPanel (via FTP) ogni volta che fai un `push` su GitHub.

## 1. Caricamento su GitHub
Prima di tutto, assicurati che il tuo codice sia su un repository GitHub.
1. Inizializza git: `git init` (se non l'hai già fatto).
2. Crea un repository su GitHub.
3. Collega e pusha:
   ```bash
   git add .
   git commit -m "Primo commit"
   git branch -M main
   git remote add origin https://github.com/TUOUSER/TUOREPO.git
   git push -u origin main
   ```

## 2. Configurazione dei Segreti (Secrets)
Per non esporre le password, usiamo i **Secret** di GitHub.
1. Vai su GitHub nel tuo repository.
2. Clicca su **Settings** > **Secrets and variables** > **Actions**.
3. Aggiungi i seguenti **Repository secrets**:
   - `FTP_SERVER`: L'host del tuo FTP (es: `ftp.tuosito.it`).
   - `FTP_USERNAME`: Il nome utente FTP (es: `user@tuosito.it`).
   - `FTP_PASSWORD`: La password del tuo account FTP.

## 3. Workflow di Deploy (`deploy.yml`)
Crea il file `.github/workflows/deploy.yml` nella root del progetto:

```yaml
name: Deploy Website to cPanel
on:
  push:
    branches:
      - main
jobs:
  web-deploy:
    name: 🎉 Deploy
    runs-on: ubuntu-latest
    steps:
      - name: 🚚 Get latest code
        uses: actions/checkout@v3

      - name: 🛠️ Install dependencies
        run: npm install

      - name: 🏗️ Build Project
        run: npm run build

      - name: 📂 Sync files via FTP
        uses: SamKirkland/FTP-Deploy-Action@v4.3.4
        with:
          server: ${{ secrets.FTP_SERVER }}
          username: ${{ secrets.FTP_USERNAME }}
          password: ${{ secrets.FTP_PASSWORD }}
          local-dir: ./dist/
          server-dir: ./
```
> [!IMPORTANT]
> **Attenzione al percorso `server-dir`!**
> - Se l'utente FTP che hai creato è già "limitato" (confinato) alla cartella `public_html` (come spesso accade su cPanel), devi usare `server-dir: ./`.
> - Se invece l'utente FTP ha accesso alla root dell'intero hosting, allora devi usare `server-dir: ./public_html/`.
> - **Come capire quale usare?** Se dopo il deploy vedi comparire una cartella `public_html` *dentro* la tua `public_html` originale, significa che devi cambiare il valore in `./`.

## 4. Configurazione `.htaccess`
Per gestire correttamente le rotte di Astro (es: `/chi-siamo` invece di `/chi-siamo.html`) e forzare l'HTTPS su cPanel, crea un file `.htaccess` nella cartella `public/`:

```apache
RewriteEngine On

# Forza HTTPS
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]

# Gestione rotte Astro (Static HTML)
# Se il file non esiste, prova ad aggiungere .html
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME}.html -f
RewriteRule ^(.*)$ $1.html [L]
```

## 5. Il Primo Deploy
Una volta creati questi file, esegui il push:
```bash
git add .
git commit -m "docs: aggiunta configurazione deploy automatico"
git push origin main
```
Vai nel tab **Actions** di GitHub per monitorare il processo. Una volta terminato, il sito sarà online!
