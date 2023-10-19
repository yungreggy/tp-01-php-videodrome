<?php
require_once './classe/CRUD.php';
require_once './vues/header.php';
$crud = new CRUD();

try {
    $genre_id = $_GET['id'];
    $genre = $crud->selectById('genres', 'id', $genre_id);

    if ($genre === false) {
        throw new Exception("Le genre demandé n'existe pas.");
    }

    $films = $crud->selectBy('films', 'genre', $genre_id);
} catch (Exception $e) {
    echo $e->getMessage();
    exit;
}
?>

<main>
    <aside>
        <h1>Films du genre
            <?php echo $genre['nom_genre']; ?>
        </h1>
        <a href="genres-modifier.php?id=<?php echo $genre['id']; ?>">Modifier</a>
        |
        <a href="genres-supprimer.php?id=<?php echo $genre['id']; ?>"
            onclick="return confirm('Es-tu sûr de vouloir supprimer ce genre ?');">Supprimer ce genre</a>
        <a href="index.php"></a>
    </aside>


    <div class="film-grid">
        <?php if (empty($films)): ?>
            <p>Aucun film n'est associé à ce genre.</p>
        <?php else: ?>
            <?php foreach ($films as $film): ?>
                <div class="film-card">
                    <a href="films-afficher.php?id=<?php echo $film['id']; ?>">
                        <?php
                        if (!empty($film['poster'])) {
                            echo '<img src="./assets/images/' . $film['poster_local'] . '" alt="' . $film['titre'] . '">';
                        } elseif (!empty($film['poster_url'])) {
                            echo '<img src="' . $film['poster_url'] . '" alt="' . $film['titre'] . '">';
                        } else {
                            echo $film['titre'];
                        }
                        ?>
                    </a>
                </div>
            <?php endforeach; ?>
            <div class="plus-icon">
                <a href="films-ajouter.php">
                    <img id="plus-icon" src="./assets/images/plus-icon.png" alt="Ajouter un film">
                </a>
            </div>
        <?php endif; ?>
    </div>
</main>

<a href="index.php">
    <img src="./assets/images/left-arrow.png" class="back-to-list">
</a>

<?php require_once './vues/footer.php'; ?>