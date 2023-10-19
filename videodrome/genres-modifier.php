<?php
$titre = 'Modifier un genre';

require_once './classe/CRUD.php';
require_once './vues/header.php';
$crud = new CRUD();
$genre_id = isset($_GET['id']) ? $_GET['id'] : null;
$genre = $crud->selectById('genres', 'id', $genre_id);

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nom_genre = $_POST['nom_genre'];

        $result = $crud->update('genres', $genre_id, ['nom_genre' => $nom_genre]);

        if ($result) {
            header("Location: genres-liste.php?success=1");
            exit;
        } else {
            throw new Exception("Erreur lors de la modification.");
        }
    }
} catch (Exception $e) {
    $message = $e->getMessage();
}

?>

<main>
    <aside class="aside-title">
        <h1>Modifier le genre :
            <?php echo $genre['nom_genre']; ?>
        </h1>
    </aside>
    <div class="form-container">
        <form action="" method="post">
            <label for="nom_genre">Nom du genre :</label>
            <input type="text" id="nom_genre" name="nom_genre" value="<?php echo $genre['nom_genre']; ?>">
            <input type="submit" value="Modifier">
        </form>
    </div>

    <?php if (isset($message)): ?>
        <p>
            <?php echo $message; ?>
        </p>
    <?php endif; ?>
</main>

</body>
<a href="index.php">
    <img src="./assets/images/left-arrow.png" class="back-to-list">
</a>

<?php require_once './vues/footer.php'; ?>