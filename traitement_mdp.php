<?php

session_start();

require_once 'config/connexion.php';

$email = trim($_POST['email']);

$stmt = $pdo->prepare(
    "SELECT * FROM utilisateur WHERE email = :email"
);

$stmt->execute([
    ':email' => $email
]);

$user = $stmt->fetch();

if (!$user) {

    $_SESSION['erreur_mdp'] = "Email introuvable";

    header('Location: mdp_oublie.php');

    exit;
}

$_SESSION['succes_mdp'] =
"Un lien de réinitialisation a été envoyé à votre adresse email.";

header('Location: mdp_oublie.php');

exit;