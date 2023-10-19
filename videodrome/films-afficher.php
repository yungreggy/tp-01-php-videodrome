<?php
$titre = 'Détails';
require_once './classe/CRUD.php';
require_once './vues/header.php';

$crud = new CRUD();

try {
    if (!isset($_GET['id']) || empty($_GET['id'])) {
        throw new Exception("Aucun ID de film fourni");
    }

} catch (Exception $e) {
    echo $e->getMessage();
    exit;
}

$film_id = $_GET['id'];

$sql = "SELECT films.*, realisateurs.nom AS realisateur_nom, realisateurs.prenom AS realisateur_prenom, genres.nom_genre 
        FROM films 
        LEFT JOIN realisateurs ON films.realisateur_id = realisateurs.id 
        LEFT JOIN genres ON films.genre = genres.id 
        WHERE films.id = :id";

$stmt = $crud->prepare($sql);
$stmt->bindParam(':id', $film_id);
$stmt->execute();

$film = $stmt->fetch(PDO::FETCH_ASSOC);

if ($film === false) {
    echo "Le film n'a pas été trouvé";
    exit;
}

$realisateur_nom_complet = $film['realisateur_prenom'] . ' ' . $film['realisateur_nom'];
$genre = $crud->selectById('genres', 'id', $film['genre']);

// Gérer les posters
$filmPosterLocal = !empty($film['poster_local']) ? "./assets/images/{$film['poster_local']}" : null;
$filmPosterUrl = !empty($film['poster_url']) ? $film['poster_url'] : null;
$finalPoster = $filmPosterLocal ?? $filmPosterUrl;
?>


<main>
    <a href="index.php">
        <img src="./assets/images/left-arrow.png" class="back-to-list">
    </a>
    <section id="film-details">
        <h1 class="film-titre">
            <?= ucfirst($film['titre']); ?>
        </h1>
        <?php if ($film): ?>
            <div class="film-info">
                <?php
                if (!empty($film['poster_local'])) {
                    echo '<img src="./assets/images/' . $film['poster'] . '" alt="' . $film['titre'] . ' poster" class="film-poster-details">';
                } elseif (!empty($film['poster_url'])) {
                    echo '<img src="' . $film['poster_url'] . '" alt="' . $film['titre'] . ' poster" class="film-poster-details">';
                } else {
                    echo '<p>Aucun poster disponible</p>';
                }
                ?>
                <div class="film-text">
                    <?php
                    echo <<<HTML
<p><strong>Année:</strong> {$film['annee_de_sortie']}</p>
<p><strong>Réalisateur:</strong> <a href="realisateurs-afficher.php?id={$film['realisateur_id']}">{$realisateur_nom_complet}</a></p>
<p><strong>Genre:</strong> <a href="genres-afficher.php?id={$film['genre']}">{$film['nom_genre']}</a></p>
<p><strong>Pays d'origine:</strong> {$film['pays_d_origine']}</p>
<p><strong>Résumé:</strong> {$film['resume']}</p>
HTML;
                    ?>
                </div>
            </div>
            <div class="actions">
                <a href="films-modifier.php?id=<?= $film['id']; ?>" class="action-link">Modifier</a>
                |
                <a href="films-supprimer.php?id=<?= $film['id']; ?>" class="action-link"
                    onclick="return confirm('Es-tu sûr de vouloir supprimer ce film ?');">Supprimer</a>
            </div>
        <?php else: ?>
            <p>Aucun détail trouvé.</p>
        <?php endif; ?>
    </section>
</main>
<?php require_once './vues/footer.php'; ?>