<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['Email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // Validation simple
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        echo "Tous les champs sont obligatoires.";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "L'adresse email est invalide.";
        exit;
    }

    // Adresse email où les messages seront envoyés
    $to = "votre-email@example.com"; // Remplacez par votre email
    $full_subject = "Contact : $subject";
    $body = "Nom: $name\nEmail: $email\n\nMessage:\n$message";
    $headers = "From: $email";

    // Envoi de l'email
    if (mail($to, $full_subject, $body, $headers)) {
        echo "Votre message a été envoyé avec succès.";
    } else {
        echo "Une erreur est survenue lors de l'envoi.";
    }
} else {
    echo "Requête non autorisée.";
}
