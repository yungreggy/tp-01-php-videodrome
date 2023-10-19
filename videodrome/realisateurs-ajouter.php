<?php
$titre = 'Ajouter un réalisateur';

require_once './classe/CRUD.php';
require_once './vues/header.php';
$crud = new CRUD();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_realisateur = [
        'nom' => $_POST['nom'],
        'prenom' => $_POST['prenom']
    ];

    try {
        if ($crud->insert('realisateurs', $new_realisateur)) {
            header("Location: realisateurs-ajouter.php?success=1");
            exit;
        }
    } catch (Exception $e) {
      
        echo "Une erreur s/'est produite: " . $e->getMessage();
    }
}

?>

<main>
    <aside class="aside-title">
        <h1>Ajouter un nouveau réalisateur</h1>
    </aside>

    <form class="form-container" action="realisateurs-ajouter.php" method="post">
        <label for="prenom">Prénom:</label>
        <input type="text" id="prenom" name="prenom">
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom">

        <input type="submit" value="Ajouter">
    </form>

    <?php
    if (isset($_GET['success']) && $_GET['success'] == 1) {
        echo '<div class="success-message">Réalisateur ajouté avec succès!</div>';
    }
    ?>
</main>

<div>
    <a href="index.php">
        <img src="./assets/images/left-arrow.png" class="back-to-list">
    </a>
</div>

<?php require_once './vues/footer.php'; ?>