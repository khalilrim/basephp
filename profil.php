<?php
session_start();
require_once 'config/connexion.php';

if (empty($_SESSION['utilisateur_id'])) {
    header('Location: connexion.php');
    exit;
}

$stmt = $pdo->prepare("SELECT prenom FROM utilisateurs WHERE id = :id");
$stmt->execute([':id' => $_SESSION['utilisateur_id']]);

$user = $stmt->fetch();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nouveau_prenom = trim($_POST['prenom']);
    $photo = $_FILES['photo']['name'];

    move_uploaded_file(
    $_FILES['photo']['tmp_name'],
    "uploads/" . $photo
    );

    $stmt = $pdo->prepare(
        "UPDATE utilisateurs 
         SET prenom = :prenom,
         photo_profil = :photo
         WHERE id = :id"
    );

    $stmt->execute([
        ':prenom' => $nouveau_prenom,
        ':id' => $_SESSION['utilisateur_id'],
        ':photo' => $photo,

    ]);

    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier profil</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="profile-box">

    <h1>Modifier mon profil</h1>

    <p>Changez votre prénom ici.</p>

    <form action="" method="POST" enctype="multipart/form-data">

        <div class="form-group">

            <label>Prénom</label>

            <input
                type="text"
                name="prenom"
                value="<?= htmlspecialchars($user['prenom']) ?>"
            >

        </div>

        <div class="form-group">

            <label>Photo de profil</label>

            <input type="file" name="photo">

        </div>

        <button type="submit" class="btn">
            Modifier
        </button>

    </form>

</div>

</body>
</html>