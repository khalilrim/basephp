<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mot de passe oublié</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">

    <h1>Réinitialisation</h1>

    <p class="subtitle">
        Entrez votre adresse email
    </p>

    <?php if (!empty($_SESSION['erreur_mdp'])): ?>

    <div class="alerte alerte-erreur">
        <?= $_SESSION['erreur_mdp'] ?>
    </div>

    <?php unset($_SESSION['erreur_mdp']); ?>

    <?php endif; ?>

    <?php if (!empty($_SESSION['succes_mdp'])): ?>

    <div class="alerte alerte-succes">
        <?= $_SESSION['succes_mdp'] ?>
    </div>

    <?php unset($_SESSION['succes_mdp']); ?>

    <?php endif; ?>

    <form action="traitement_mdp.php" method="POST">

        <div class="form-group">

            <label>Email</label>

            <input 
                type="email" 
                name="email"
                required
            >

        </div>

        <button type="submit" class="btn">
            Envoyer le lien
        </button>

    </form>

</div>

</body>
</html>