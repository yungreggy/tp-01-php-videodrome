<?php

$titre = 'Vidéodrôme - Liste de films';
require_once './classe/CRUD.php';
require_once './vues/header.php';

$crud = new CRUD();

try {
    $films = $crud->select('films');

    $genres = $crud->select('genres');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $recherche = $_POST['recherche'];
        if (!empty($recherche)) {
            $films = $crud->search($recherche);
            if (count($films) == 0) {
                $message = 'Aucun film trouvé pour cette recherche.';
            }
        } else {
            $message = 'Veuillez entrer un mot-clé pour la recherche.';
        }
    }
} catch (Exception $e) {
    $message = 'Une erreur est survenue: ' . $e->getMessage();
}

?>

<main>
    <aside>
        <ul class="aside-genres">
            <?php foreach ($genres as $genre): ?>
                <li>
                    <a href="genres-afficher.php?id=<?php echo $genre['id']; ?>">
                        <?php echo $genre['nom_genre']; ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </aside>

    <div class="film-grid">
        <?php foreach ($films as $film): ?>
            <div class="film-card">
                <a href="films-afficher.php?id=<?php echo $film['id']; ?>">
                    <?php
                    if (!empty($film['poster'])) {
                        echo '<img src="./assets/images/' . $film['poster'] . '" alt="' . $film['titre'] . '">';
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
    </div>
</main>

<?php require_once './vues/footer.php'; ?>