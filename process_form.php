<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = strip_tags(trim($_POST["message"]));

    if (empty($name) || empty($email) || empty($message)) {
        http_response_code(400);
        echo "Veuillez remplir tous les champs.";
        exit;
    }

    $to = "matteo.teixeira45@gmail.com";
    $subject = "Nouveau message de contact de $name";
    $body = "Nom: $name\nEmail: $email\nMessage:\n$message";
    $headers = "From: $email";

    if (mail($to, $subject, $body, $headers)) {
        http_response_code(200);
        echo "Merci pour votre message. Nous vous répondrons bientôt.";
    } else {
        http_response_code(500);
        echo "Erreur lors de l'envoi de l'email.";
    }
} else {
    http_response_code(403);
    echo "Accès interdit.";
}
?>
