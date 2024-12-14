<?php session_start()?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include ("includes/header.php") ?>
<div class="contenu">

        <h1>Bienvenue sur le pokedex</h1>
        <?php
        if (isset($_GET['message']) && !empty($_GET['message'])) {
            echo "<p class='erreur'>" . htmlspecialchars($_GET['message']) . "</p>";
        }
        ?>
    <div class="main">
        <h2>Ouvrir une session utilisateur</h2>
            <form method="POST" action="traitement.php">

                <input type="text" name="pseudo" id="pseudo" value="<?= isset($_COOKIE['pseudo']) ? $_COOKIE['pseudo'] : '' ?>" placeholder="Veuillez entrer votre pseudo" required>
                <input type="submit" value="Envoyer">
            </form>

    </div>
</div>
</body>
</html>
