<?php
session_start();
require_once 'config/connexion.php';

if (empty($_SESSION['utilisateur_id'])) {
    header('Location: connexion.php');
    exit;
}

$stmt = $pdo->prepare(
    "SELECT role FROM utilisateur WHERE id = :id"
);

$stmt->execute([
    ':id' => $_SESSION['utilisateur_id']
]);

$user = $stmt->fetch();

if ($user['role'] !== 'admin') {
    die('Acces refuse');
}

$stmt = $pdo->query(
    "SELECT prenom, nom, email FROM utilisateur"
);

$utilisateurs = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">

    <h1>Liste des utilisateurs</h1>

    <br>

    <?php foreach($utilisateurs as $u): ?>

        <p>
            <?= htmlspecialchars($u['prenom']) ?>
            <?= htmlspecialchars($u['nom']) ?>
            -
            <?= htmlspecialchars($u['email']) ?>
        </p>

        <br>

    <?php endforeach; ?>

</div>

</body>
</html>