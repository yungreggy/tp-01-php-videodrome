<?php
$titre = 'Créer une playlist';
require_once 'classe/CRUD.php';
require_once './vues/header.php';

$crud = new CRUD();
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nom_playlist'])) {
        $nom_playlist = $_POST['nom_playlist'];
        $description = $_POST['description'];

        $existingPlaylist = $crud->selectBy('playlist', 'nom_playlist', $nom_playlist);

        if ($existingPlaylist) {
            $message = "Cette playlist existe déjà dans la base de données.";
        } else {
            try {
                $result = $crud->insert('playlist', ['nom_playlist' => $nom_playlist, 'description' => $description]);

                if ($result) {
                    $message = "Playlist ajoutée avec succès!";
                    header("Location: playlist-liste.php");
                } else {
                    $message = "Une erreur s'est produite lors de la création de la playlist.";
                }
            } catch (Exception $e) {
                $message = "Une erreur s'est produite lors de la création de la playlist: " . $e->getMessage();
            }
        }
    } else {
        $message = "Le nom de la playlist est requis.";
    }
}
?>

<main>
    <aside class="aside-title">
        <h1>Ajouter une nouvelle Playlist</h1>
        <a href="playlist-liste.php">
            <img src="./assets/images/left-arrow.png" class="back-to-list">
        </a>
    </aside>

    <form action="playlist-ajouter.php" method="post">
        <label for="nom_playlist">Nom de la Playlist:</label>
        <input type="text" id="nom" name="nom_playlist" required><br>

        <label for="description">Description:</label>
        <textarea id="description" name="description"></textarea><br>

        <input type="submit" name="ajouter" value="Ajouter">
    </form>
</main>

<?php require_once './vues/footer.php'; ?>