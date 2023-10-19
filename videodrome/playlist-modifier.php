<?php
require_once 'classe/CRUD.php';
require_once './vues/header.php';

$crud = new CRUD();
$playlistId = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $nouveau_titre = $_POST['titre'];
        $nouvelle_description = $_POST['description'];

        $sql = "UPDATE playlist SET nom_playlist = :titre, description = :description WHERE id = :id";
        $stmt = $crud->prepare($sql);
        $stmt->bindParam(':titre', $nouveau_titre);
        $stmt->bindParam(':description', $nouvelle_description);
        $stmt->bindParam(':id', $playlistId);

        $stmt->execute();
        header('Location: playlist-afficher.php?id=' . $playlistId);
    } catch (PDOException $e) {
        // Handle the exception here, for example:
        echo "Une erreur s/'est produite: " . $e->getMessage();
    }
}

$playlist = $crud->selectById('playlist', 'id', $playlistId);
?>

<h1>Modifier les infos de la liste</h1>
<form action="" method="POST">
    <label for="titre">Titre:</label>
    <input type="text" id="titre" name="titre" value="<?= $playlist['nom_playlist'] ?>"><br>

    <label for="description">Description:</label>
    <textarea id="description" name="description"><?= $playlist['description'] ?></textarea><br>

    <input type="submit" value="Modifier">
</form>

<?php require_once './vues/footer.php'; ?>