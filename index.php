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

<?php
include ("includes/header.php");
?>
<?php if(!isset ($_SESSION['pseudo'])){
header("Location: connexion.php?message=Veuillez ouvrir une session");
exit();
}
?>

<h1>Bienvenue sur le pokedex</h1>

<div class="main">
    <h2>Rechercher un pokémon</h2>
    <form method="POST" action="pokemon.php">
        <input type="text" name="Nom">
        <input type="text" name="Identifiant" >
        <input type="submit" value="Envoyer">
    </form>

    <?php
        if (isset($_GET['message'])) {
            echo "<p style='color: red;'>" . htmlspecialchars($_GET['message']) . "</p>";
        }
?>


    <?php
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            echo "<p>" . htmlspecialchars($_GET['id']) . "</p>";
        }
        ?>

</div>
</div>


</body>

</body>
</html>
