<?php

$titre = 'Détails de la playlist';
require_once 'classe/CRUD.php';
require_once './vues/header.php';

$crud = new CRUD();
$duplicateMessage = "";

$films = [];
$playlist = [];
$prefix = "";

try {
    if (isset($_GET['id'])) {
        $playlistId = $_GET['id'];
        $playlist = $crud->selectById('playlist', 'id', $playlistId);
        $films = $crud->selectByJoin('films', 'films_playlists', 'id', 'film_id', 'playlist_id', $playlistId);
    } else {
        throw new Exception("Aucun ID de playlist fourni");
    }
} catch (Exception $e) {
    echo "Erreur: " . $e->getMessage();
    exit;
}

// Fonction de recherche de films par préfixe
function search($prefix, $crud)
{
    $sql = "SELECT * FROM films WHERE titre LIKE :prefix";
    $stmt = $crud->prepare($sql);
    $stmt->bindValue(':prefix', '%' . $prefix . '%', PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
if (isset($_POST['supprimer_du_playlist'])) {
    $film_id = $_POST['film_id'];
    $playlist_id = $_POST['playlist_id'];
    deleteFromPlaylist($crud, $film_id, $playlist_id);
}
function deleteFromPlaylist($crud, $film_id, $playlist_id)
{
    $sql = "DELETE FROM films_playlists WHERE film_id = :film_id AND playlist_id = :playlist_id";
    $stmt = $crud->prepare($sql);
    $stmt->bindParam(':film_id', $film_id);
    $stmt->bindParam(':playlist_id', $playlist_id);
    $stmt->execute();

}

$searchResults = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['search'])) {
        // Recherche
        $search = '%' . $_POST['search'] . '%';
        $searchResults = $crud->search($search);

        error_log("Search results: " . print_r($searchResults, true));
    } elseif (isset($_POST['supprimer_du_playlist'])) {

        // Suppression du film de la playlist
        $film_id = $_POST['film_id'];
        $playlist_id = $_POST['playlist_id'];
        error_log("Deleting film with ID: " . $film_id . " from playlist with ID: " . $playlist_id);
        deleteFromPlaylist($crud, $film_id, $playlist_id);

        // Recharger les films de la playlist pour mettre à jour l'affichage
        $films = $crud->selectByJoin('films', 'films_playlists', 'id', 'film_id', 'playlist_id', $playlist_id);
        error_log("Film deleted from playlist. Updated playlist: " . print_r($films, true));
    } elseif (isset($_POST['ajouter_a_la_playlist'])) {

        // Ajout du film à la playlist
        $filmId = $_POST['film_id'];
        $playlistId = $_POST['playlist_id'];
        error_log("Adding film with ID: " . $filmId . " to playlist with ID: " . $playlistId);

        // Requête SQL pour ajouter le film à la playlist
        $sql = "INSERT INTO films_playlists (playlist_id, film_id) VALUES (:playlist_id, :film_id)";
        $stmt = $crud->prepare($sql);
        $stmt->bindParam(':playlist_id', $playlistId, PDO::PARAM_INT);
        $stmt->bindParam(':film_id', $filmId, PDO::PARAM_INT);

        if ($stmt->execute()) {
            error_log("Successfully added film to playlist");

        } else {
            error_log("Failed to add film to playlist");

        }
    }

}


?>
<section class="afficher-liste">
    <h1>
        <?= $playlist['nom_playlist'] ?>
    </h1>
    <p>Description :
        <?= $playlist['description'] ?>
    </p>
    <div class="container">
        <form action="playlist-supprimer.php" method="REQUEST">
            <input type="hidden" name="id" value="<?= $playlistId ?>">
            <button class="bouton" type="submit"
                onclick="return confirm('Es-tu sûr de vouloir supprimer cette playlist ?');">Supprimer la liste</button>
        </form>
        <a href="playlist-modifier.php?id=<?= $playlistId ?>">
            <button class="bouton-modifier">Modifier</button>
        </a>
    </div>


    <?php if (empty($films)): ?>
        <p>Aucun film n'a été ajouté à cette playlist.</p>
    <?php else: ?>
        <table class="film-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Titre</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($films as $index => $film): ?>
                    <tr>
                        <td>
                            <?= $index + 1 ?>
                        </td>
                        <td>
                            <a href="films-afficher.php?id=<?= $film['id'] ?>">
                                <?= $film['titre'] ?>
                            </a>
                        </td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="film_id" value="<?= $film['id'] ?>">
                                <input type="hidden" name="playlist_id" value="<?= $playlistId ?>">
                                <button type="submit" name="supprimer_du_playlist">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
    </div>
    </div>


    <div class="form-container">
        <form action="" method="post" id="search-form">
            <input type="text" name="search" id="search-input" placeholder="Chercher un film...">
            <input type="submit" value="Chercher">
        </form>

        <div class="search-results">
            <h2>Résultats de la recherche</h2>
            <div class="film-grid">
                <?php foreach ($searchResults as $film): ?>
                    <div class="film-card add-to-playlist" data-film-id="<?= $film['id'] ?>"
                        data-playlist-id="<?= $playlistId ?>">
                        <img src="<?= $film['poster_url'] ?>" alt="<?= $film['titre'] ?>">
                        <p>
                            <?= $film['titre'] ?>
                        </p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <?php if (!empty($searchResults)): ?>
        <script type="text/javascript">
            var searchResults = <?php echo json_encode($searchResults); ?>;
        </script>
    <?php endif; ?>
</section>

<?php require_once './vues/footer.php'; ?>