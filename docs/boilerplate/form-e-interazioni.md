# Gestione Form e Interazioni

Per evitare bug comuni nei moduli di contatto e nelle interazioni utente, ecco la struttura professionale definitiva.

## Best Practice per i Form
1.  **Accessibilità**: Ogni `input` deve avere un `label` associato tramite l'attributo `for`.
2.  **Validazione Native**: Usa gli attributi HTML5 (`required`, `type="email"`, `pattern`) per una prima validazione senza JavaScript.
3.  **Feedback Utente**: Mostra sempre un messaggio di caricamento o successo dopo l'invio.
4.  **Honeypot**: Campo nascosto per bloccare i bot dello spam.

## Esempio Completo (Astro + Tailwind)
Questa è la struttura professionale usata in Mega Shop Arredi, ottimizzata per il design glassmorphism e la sicurezza:

```astro
<form id="contact-form" action="/contact.php" method="POST" class="space-y-8">
  {/* Honeypot per Anti-spam (Invisibile agli umani) */}
  <div class="hidden" aria-hidden="true">
    <input type="text" name="website_honey_pot" tabindex="-1" autocomplete="off" />
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
    <div class="space-y-2">
      <label for="name" class="text-xs uppercase tracking-widest font-bold text-text/50 ml-1">Nome e Cognome</label>
      <input type="text" id="name" name="name" required class="w-full bg-white border border-border/60 px-6 py-4 focus:border-accent transition-all outline-none rounded-sm" />
    </div>
    <div class="space-y-2">
      <label for="email" class="text-xs uppercase tracking-widest font-bold text-text/50 ml-1">Email</label>
      <input type="email" id="email" name="email" required class="w-full bg-white border border-border/60 px-6 py-4 focus:border-accent transition-all outline-none rounded-sm" />
    </div>
  </div>

  <div class="space-y-2">
    <label for="subject" class="text-xs uppercase tracking-widest font-bold text-text/50 ml-1">Oggetto</label>
    <select id="subject" name="subject" class="w-full bg-white border border-border/60 px-6 py-4 focus:border-accent transition-all outline-none rounded-sm appearance-none cursor-pointer">
      <option value="Informazioni General">Informazioni Generali</option>
      <option value="Altro">Altro</option>
    </select>
  </div>

  <div class="space-y-2">
    <label for="message" class="text-xs uppercase tracking-widest font-bold text-text/50 ml-1">Messaggio</label>
    <textarea id="message" name="message" rows="5" required class="w-full bg-white border border-border/60 px-6 py-4 focus:border-accent transition-all outline-none rounded-sm"></textarea>
  </div>

  <button type="submit" class="bg-accent text-black px-10 py-5 hover:bg-black transition-all font-bold uppercase tracking-widest text-sm">
    Invia Messaggio
  </button>
</form>
```

## Backend Sicuro (contact.php)
Crea un file `public/contact.php` per gestire l'invio via mail su cPanel:

```php
<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Honeypot
    if (!empty($_POST["website_honey_pot"])) { exit; }
    
    // 2. Rate Limiting (1 min)
    if (time() - ($_SESSION['last_submit'] ?? 0) < 60) { header("Location: /?success=true"); exit; }
    $_SESSION['last_submit'] = time();

    // 3. Sanitizzazione
    $name = str_replace(["\r", "\n"], '', strip_tags($_POST["name"]));
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars($_POST["message"], ENT_QUOTES, 'UTF-8');

    // 4. Invio
    $recipient = "tua@email.it";
    $headers = "From: Web <noreply@dominio.it>\r\nReply-To: $email";
    mail($recipient, "Nuovo Messaggio", $message, $headers);
    header("Location: /contatti?success=true#contact-form");
}
?>
```
