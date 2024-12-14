<?php
var_dump($_POST);

// Vérifie si un pseudo a été soumis via POST
if (!isset($_POST['pseudo']) || empty($_POST['pseudo'])) {
    // Redirige vers la page de connexion avec un message d'erreur
    header("Location: connexion.php?message=Votre pseudo est vide !");
    exit(); // Assure que le script s'arrête ici
}

// Si un pseudo est soumis correctement
setcookie("pseudo", $_POST['pseudo'], time() + (86400 * 30), "/");
session_start();
$_SESSION['pseudo'] = $_POST['pseudo'];
header("location: index.php");
exit(); // Assure que le script s'arrête ici


$pokemons = [];

// Simplify the API response structure
if (is_array($response)) {
    foreach ($response as $pokemon) {
        $id = $pokemon['id'] ?? null;
        if ($id) {
            $pokemons[$id] = [
                'id'         => $pokemon['id'] ?? '',
                'generation' => $pokemon['generation'] ?? '',
                'category'   => $pokemon['category'] ?? '',
                'name'       => $pokemon['name']['fr'] ?? '',
                'image'      => $pokemon['sprites']['regular'] ?? '',
                'types'      => array_map(function ($type) {
                    return [
                        'name'  => $type['name'] ?? '',
                        'image' => $type['image'] ?? '',
                    ];
                }, $pokemon['types'] ?? []),
            ];
        }
    }
}


// Store the simplified Pokémon array in the session
$_SESSION['pokemons'] = $pokemons;

if (!isset($_POST['Nom']) || empty($_POST['Nom']) || !isset($_POST['Identifiant']) || empty($_POST['Identifiant'])) {
    header("Location: index.php?message=Veuillez remplir les deux champs !");
    exit();
}


while ($index < count($pokemons)) {
    if (strtolower($pokemons[$index]['name']) === strtolower($name)) {
        echo "Pokémon trouvé : ID = " . $pokemons[$index]['id'] . ", Nom = " . $pokemons[$index]['name'] . "\n";
        $id = $pokemons[$index]['id'];
        header("Location: index.php?id=" . $id);
        $found = true;
        break; // On arrête la boucle une fois trouvé
    }
    $index++;
}

// Print a success message with the count of Pokémon
echo "Pokémon data stored in session. Total Pokémon: " . count($pokemons);



?>