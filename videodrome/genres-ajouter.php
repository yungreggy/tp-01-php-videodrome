<?php
$titre = 'Ajouter un genre';

require_once './classe/CRUD.php';
require_once './vues/header.php';
$crud = new CRUD();


$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $nom_genre = $_POST['nom_genre'];
        $existingGenre = $crud->selectBy('genres', 'nom_genre', $nom_genre);

        if ($existingGenre) {
            $message = "Ce genre existe déjà dans la base de données.";
        } else {
            $result = $crud->insert('genres', ['nom_genre' => $nom_genre]);

            if ($result) {
                $message = "Genre ajouté avec succès!";
            } else {
                $message = "Une erreur s'est produite lors de l'ajout du genre.";
            }
        }
    } catch (Exception $e) {
        $message = "Une erreur s'est produite: " . $e->getMessage();
    }
}
?>

<main>
    <aside class="aside-title">
        <h1>Ajouter un nouveau genre</h1>
    </aside>

    <?php if (!empty($message)): ?>
        <p>
            <?php echo $message; ?>
        </p>
    <?php endif; ?>
    <div class="form-container">
        <form action="genres-ajouter.php" method="post">
            <label for="nom_genre">Nom du genre:</label>
            <input type="text" id="nom_genre" name="nom_genre" required>
            <input type="submit" value="Ajouter">
        </form>
    </div>
</main>
<a href="index.php">
    <img src="./assets/images/left-arrow.png" class="back-to-list">
</a>

<?php require_once './vues/footer.php'; ?>


