<?php

require_once './classe/CRUD.php';
$crud = new CRUD();

// Récupérer le message d'erreur de l'URL
$message = isset($_GET['error']) ? urldecode($_GET['error']) : "Une erreur inconnue s'est produite.";

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Erreur de suppression</title>
    <link rel="stylesheet" href="./assets/css/styles.css">
</head>

<body>
    <header>
            <nav>
   <ul>
    <li><a href="index.php">Films</a>
        <ul>
            <li><a href="films-ajouter.php">Ajouter un film</a></li>
         
        </ul>
    </li>
    <li><a href="#">Réalisateurs</a>
        <ul>
            <li><a href="realisateurs-ajouter.php">Ajouter un réalisateur</a></li>
            <li><a href="realisateurs-liste.php">Liste des réalisateurs</a></li>
        </ul>
    </li>
    <li><a href="#">Genres</a>
        <ul>
            <li><a href="genres-ajouter.php">Ajouter un genre</a></li>
            <li><a href="genres-liste.php">Liste des genres</a></li>
        </ul>
    </li>
    <li><a href="#">Liste de lecture</a>
        <ul>
            <li><a href="playlist-ajouter.php">Créer une playlist</a></li>
            <li><a href="playlst-lis">Vos playlists</a></li>
        </ul>
    </li>
</ul>
    </header>
    <main>
    <?php
    if (!empty($message)) {
        echo "<div class='error-message'>" . $message . "</div>";
    }
    ?>

    </main>
        
</body>

</html>