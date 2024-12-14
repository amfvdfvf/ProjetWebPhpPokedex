<?php

session_start(); 
var_dump($_POST);
$pokemons = [];

$curl_request = curl_init();
    $api_url = 'https://tyradex.vercel.app/api/v1/pokemon';
    $connectionTimeout = 15; // en secondes

    curl_setopt_array($curl_request, [
        CURLOPT_URL            => $api_url,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_CONNECTTIMEOUT => $connectionTimeout,
    ]);
    // récupération de la réponse (au format json)
    $response = curl_exec($curl_request);
    // conversion de la réponse sous forme de tableau php
    $response = json_decode($response, true);

// Simplify the API response structure
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

// Store the simplified Pokémon array in the session
$_SESSION['pokemons'] = $pokemons;

// Vérification des champs POST
if (!isset($_POST['Nom']) || empty($_POST['Nom']) || !isset($_POST['Identifiant']) || empty($_POST['Identifiant'])) {
    header("Location: index.php?message=Veuillez remplir l'un des deux champs !");
    exit();
}

// Initialisation des variables nécessaires
$index = 0;
$name = $_POST['Nom'] ?? ''; 
$found = false;

// Recherche dans les Pokémons
while ($index < count($pokemons)) {
    if (strtolower($pokemons[$index]['name']) == strtolower($name)) {
        echo "Pokémon trouvé : ID = " . $pokemons[$index]['id'] . ", Nom = " . $pokemons[$index]['name'] . "\n";
        $id = $pokemons[$index]['id'];
        header("Location: index.php?id=" . $id);
        $found = true;
        break; // On arrête la boucle une fois trouvé
    }
    $index++;
}

// Si aucun Pokémon trouvé, afficher un message
if (!$found) {
    echo "Aucun Pokémon correspondant trouvé.";
}

// Print a success message with the count of Pokémon
echo "Pokémon data stored in session. Total Pokémon: " . count($pokemons);

?>
