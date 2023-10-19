<?php
$titre = 'Modifier un film';
require_once './classe/CRUD.php';
require_once './vues/header.php';
$crud = new CRUD();

try {
    if (!isset($_GET['id']) || empty($_GET['id'])) {
        throw new Exception("Aucun ID de film fourni");
    }

    $film_id = $_GET['id'];
    $column_name = 'id'; 
    $film = $crud->selectById('films', $film_id, $column_name);

} catch (Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}


$film_id = isset($_GET['id']) ? $_GET['id'] : null;
$film = $crud->selectById('films', 'id', $film_id);
$realisateurs = $crud->select('realisateurs');
$genres = $crud->select('genres');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $updated_film = [
        'titre' => $_POST['titre'],
        'annee_de_sortie' => $_POST['annee_de_sortie'],
        'realisateur_id' => $_POST['realisateur_id'],
        'genre' => $_POST['genre'],
        'resume' => $_POST['resume'],
        'pays_d_origine' => $_POST['pays_d_origine'],
        'poster_local' => $_POST['poster_local'],
        'poster_url' => $_POST['poster_url']
    ];

    $crud->update('films', $updated_film, ['id' => $film_id]);

    header('Location: films-afficher.php?id=' . $film_id);

}
?>

<main>
    <aside class="aside-title">
        <h1>Modifier un Film</h1>
    </aside>
    <div class="form-container">
        <form action="films-modifier.php?id=<?php echo $film_id; ?>" method="post">
            <label for="titre">Titre</label>
            <input type="text" id="titre" name="titre" value="<?php echo $film['titre']; ?>">

            <label for="annee">Année de sortie</label>
            <input type="number" id="annee" name="annee_de_sortie" value="<?php echo $film['annee_de_sortie']; ?>">

            <label for="realisateur">Réalisateur</label>
            <select id="realisateur" name="realisateur_id">
                <?php foreach ($realisateurs as $realisateur): ?>
                    <option value="<?php echo $realisateur['id']; ?>" <?php if ($film['realisateur_id'] == $realisateur['id'])
                           echo 'selected'; ?>>
                        <?php echo $realisateur['prenom'] . ' ' . $realisateur['nom']; ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="genre">Genre</label>
            <select id="genre" name="genre">
                <?php foreach ($genres as $genre): ?>
                    <option value="<?php echo $genre['id']; ?>" <?php if ($film['genre'] == $genre['id'])
                           echo 'selected'; ?>>
                        <?php echo $genre['nom_genre']; ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="resume">Résumé</label>
            <textarea id="resume" name="resume"><?php echo $film['resume']; ?></textarea>

            <label for="pays_d_origine">Pays d'origine:</label>
            <select id="pays_d_origine" name="pays_d_origine">
                <?php
                $paysListe = [
                    "États-Unis",
                    "Afrique du Sud",
                    "Allemagne",
                    "Arabie Saoudite",
                    "Argentine",
                    "Australie",
                    "Autriche",
                    "Belgique",
                    "Brésil",
                    "Canada",
                    "Chili",
                    "Chine",
                    "Colombie",
                    "Corée du Sud",
                    "Cuba",
                    "Danemark",
                    "Égypte",
                    "Espagne",
                    "Finlande",
                    "France",
                    "Grèce",
                    "Hong Kong",
                    "Hongrie",
                    "Inde",
                    "Indonésie",
                    "Iran",
                    "Irlande",
                    "Israël",
                    "Italie",
                    "Japon",
                    "Mexique",
                    "Nigeria",
                    "Norvège",
                    "Nouvelle-Zélande",
                    "Pays-Bas",
                    "Philippines",
                    "Pologne",
                    "Portugal",
                    "République tchèque",
                    "Roumanie",
                    "Royaume-Uni",
                    "Russie",
                    "Singapour",
                    "Suède",
                    "Suisse",
                    "Taïwan",
                    "Thaïlande",
                    "Turquie",
                    "Ukraine",
                    "Venezuela"
                ];

                foreach ($paysListe as $pays) {
                    $selected = ($film['pays_d_origine'] == $pays) ? 'selected' : '';
                    echo "<option value='$pays' $selected>$pays</option>";
                }
                ?>
            </select>



            <label for="poster_local">Poster (local)</label>
            <input type="text" id="poster" name="poster_local" value="<?php echo $film['poster_local']; ?>">

            <label for="poster_url">URL du Poster</label>
            <input type="text" id="poster_url" name="poster_url" value="<?php echo $film['poster_url']; ?>">

            <input type="submit" value="Modifier">
        </form>
        <div>
            <p>
                Le réalisateur que tu cherches n'est pas dans la liste ? Pas de soucis,
                <a href="realisateurs-ajouter.php">ajoute-le ici</a>.
            </p>

            <br>
            <a href="index.php">
                <img src="./assets/images/left-arrow.png" class="back-to-list">
            </a>
        </div>
    </div>

</main>
<?php require_once './vues/footer.php'; ?>