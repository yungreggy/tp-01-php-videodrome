<?php
$titre = 'Liste des playlists';
require_once 'classe/CRUD.php';
require_once './vues/header.php';

try {
    $crud = new CRUD();

    $playlists = $crud->select('playlist');
} catch (Exception $e) {
    echo "Une erreur s/'est produite:" . $e->getMessage();
}
?>
<main>
    <aside class="aside-title">
        <h1>Liste des Playlists</h1>
        <ul>
            <?php foreach ($playlists as $playlist): ?>
                <li>
                    <a href="playlist-afficher.php?id=<?= $playlist['id'] ?>">
                        <?= $playlist['nom_playlist'] ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </aside>
</main>

<?php require_once './vues/footer.php'; ?>