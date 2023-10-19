<?php
$titre = 'Détails';
require_once './classe/CRUD.php';
require_once './vues/header.php';
$crud = new CRUD();

if (isset($_POST['filmId']) && isset($_POST['playlistId'])) {
    $filmId = $_POST['filmId'];
    $playlistId = $_POST['playlistId'];

    $data = [
        'film_id' => $filmId,
        'playlist_id' => $playlistId
    ];

    $result = $crud->insert('films_playlists', $data);

    if ($result) {
        echo "Film ajouté à la playlist avec succès!";
    } else {
        echo "Erreur lors de l'ajout du film à la playlist.";
    }
}
?>


