<?php
$titre = 'Filmographie de';
require_once './classe/CRUD.php';
require_once './vues/header.php';
$crud = new CRUD();

$realisateur_id = isset($_GET['id']) ? $_GET['id'] : null;

try {
    $realisateur = $crud->selectById('realisateurs', 'id', $realisateur_id);
    $films = $crud->selectBy('films', 'realisateur_id', $realisateur_id);
} catch (Exception $e) {
   
    echo "Une erreur s/'est produite: " . $e->getMessage();
}

?>
<main>
    <aside>
        <h1>Filmographie de
            <?php echo $realisateur['prenom'] . ' ' . $realisateur['nom']; ?>
        </h1>
        <a href="realisateurs-modifier.php?id=<?php echo $realisateur['id']; ?>">Modifier</a>
        <a href="realisateurs-supprimer.php?id=<?php echo $realisateur['id']; ?>">| Supprimer</a>
    </aside>

    <div class="film-grid">
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

    </div>
</main>

<a href="javascript:history.back()">
    <img src="./assets/images/left-arrow.png" class="back-to-list">
</a>
<?php require_once './vues/footer.php'; ?>