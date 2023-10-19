<?php
$titre = 'Modifier un réalisateur';

require_once './classe/CRUD.php';
require_once './vues/header.php';
$crud = new CRUD();

$realisateur_id = isset($_GET['id']) ? $_GET['id'] : null;

try {
    $realisateur = $crud->selectById('realisateurs', 'id', $realisateur_id);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $updated_realisateur = [
            'prenom' => $_POST['prenom'],
            'nom' => $_POST['nom'],
        ];

        $crud->update('realisateurs', $updated_realisateur, ['id' => $realisateur_id]);

        header("Location: realisateurs-liste.php?success=1");
        exit;
    }
} catch (Exception $e) {
    echo "Une erreur s/'est produite: " . $e->getMessage();
}
?>

<main>
    <aside class="aside-title">
        <h1>Modifier un Réalisateur</h1>
    </aside>

    <form action="realisateurs-modifier.php?id=<?php echo $realisateur_id; ?>" method="post">
        <label for="nom">Prénom:</label>
        <input type="text" id="nom" name="nom" value="<?php echo $realisateur['nom']; ?>">
        <label for="prenom">Nom:</label>
        <input type="text" id="prenom" name="prenom" value="<?php echo $realisateur['prenom']; ?>">
        <input type="submit" value="Modifier">
    </form>
</main>

<a href="index.php">
    <img src="./assets/images/left-arrow.png" class="back-to-list">
</a>

<?php require_once './vues/footer.php'; ?>