<?php

try {
	$database = new PDO('mysql:host=localhost;dbname=chatroom;charset=utf8', 'chatroom', 'password');
} catch(Exception $e) {
	die('Erreur : '.$e->getMessage());
}
// Récupérer les données du formulaire
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$date_naissance = $_POST['date_naissance'];
$mail = $_POST['mail'];
$telephone = $_POST['telephone'];

// Préparer le message de bienvenue
$message = "Bonjour $prenom $nom,\n\n";
$message .= "Bienvenue sur notre site web !\n\n";
$message .= "Nous vous remercions de votre inscription.\n\n";
$message .= "Cordialement,\n";
$message .= "L'équipe du site web.";

// Envoyer le message de bienvenue
$subject = "Bienvenue sur notre site web";
$headers = "From: asad-site@hmv.com" . "\r\n" .
    "Reply-To: asad-site@hmv.com" . "\r\n" .
    "X-Mailer: PHP/" . phpversion();

mail($mail, $subject, $message, $headers);

// Rediriger l'utilisateur vers une page de confirmation
header("Location: confirmation.html");

