<?php
$titre = 'Liste des films';

require_once './classe/CRUD.php';
require_once './vues/header.php';
$crud = new CRUD();
$realisateurs = null;

try {
    $realisateurs = $crud->select('realisateurs');
} catch (Exception $e) {
   
    echo "Une erreur s/'est produite: " . $e->getMessage();
}

?>

<h1>Liste des Réalisateurs</h1>
<main>
    <table>
        <thead>
            <tr>


            </tr>
        </thead>
        <tbody>
            <?php foreach ($realisateurs as $realisateur): ?>
                <tr>
                    <td>
                        <a class="realisateurs" href="realisateurs-afficher.php?id=<?php echo $realisateur['id']; ?>">
                            <?php echo $realisateur['prenom'] . ' ' . $realisateur['nom']; ?>
                        </a>
                    </td>
                    <td>
                        <a href="realisateurs-modifier.php?id=<?php echo $realisateur['id']; ?>">Modifier</a>
                        <a href="realisateurs-supprimer.php?id=<?php echo $realisateur['id']; ?>">| Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>

<a href="index.php">
    <img src="./assets/images/left-arrow.png" class="back-to-list">
</a>

<?php require_once './vues/footer.php'; ?>