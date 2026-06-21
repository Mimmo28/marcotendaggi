<?php
/**
 * contact.php - Versione Hardened per cPanel
 * Gestisce l'invio sicuro dei messaggi dal modulo di contatto.
 */

session_start();

// Configurazione
$recipient = "info@marcotendaggi.it"; // Email di destinazione reale
$sender_email = "noreply@marcotendaggi.it"; // Deve appartenere al dominio per SPF/DKIM
$site_name = "Marco Tendaggi";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 1. Honey Pot Trap (Campo invisibile agli umani)
    if (!empty($_POST["website_honey_pot"])) {
        // Silenziosamente reindirizza per non dare indizi ai bot
        header("Location: /contatti?success=true#contact-form"); 
        exit;
    }

    // 2. Rate Limiting (Minimo 60 secondi tra un invio e l'altro)
    $last_submit = isset($_SESSION['last_form_submit']) ? $_SESSION['last_form_submit'] : 0;
    if (time() - $last_submit < 60) {
        // Se tenta troppo spesso, lo blocchiamo senza inviare nulla
        header("Location: /contatti?success=true#contact-form");
        exit;
    }
    $_SESSION['last_form_submit'] = time();

    // 3. Sanitizzazione Header (Protezione Header Injection)
    function clean_header($data) {
        return str_replace(array("\r", "\n", "%0a", "%0d"), '', $data);
    }

    // Acquisizione e pulizia dati
    $name = clean_header(strip_tags(trim($_POST["name"])));
    $email = clean_header(filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL));
    $subject_raw = clean_header(strip_tags(trim($_POST["subject"] ?? 'Richiesta Informazioni')));
    $message_content = htmlspecialchars(trim($_POST["message"]), ENT_QUOTES, 'UTF-8');

    // Validazione base email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: /contatti?success=false#contact-form");
        exit;
    }

    // 4. Preparazione Invio Email Professionale
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/plain; charset=utf-8\r\n";
    $headers .= "From: $site_name Web Server <$sender_email>\r\n";
    $headers .= "Reply-To: $name <$email>\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    $email_subject = "Nuovo Contatto dal Sito: $subject_raw";
    
    $email_body = "Dettagli del Messaggio:\n";
    $email_body .= "------------------------\n";
    $email_body .= "Nome: $name\n";
    $email_body .= "Email: $email\n";
    $email_body .= "Oggetto: $subject_raw\n\n";
    $email_body .= "Messaggio:\n$message_content\n";
    $email_body .= "------------------------\n";
    $email_body .= "Inviato da: " . $_SERVER['REMOTE_ADDR'] . "\n";

    // 5. Invio e Redirect
    if (mail($recipient, $email_subject, $email_body, $headers)) {
        header("Location: /contatti?success=true#contact-form");
    } else {
        // Log errore interno se necessario per il debug in cPanel
        error_log("Errore invio mail: non è stato possibile inviare l'email a $recipient");
        header("Location: /contatti?success=false#contact-form");
    }
    exit;
} else {
    // Se tentano di accedere al file direttamente senza POST
    header("Location: /contatti");
    exit;
}
