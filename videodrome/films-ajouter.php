<?php
$titre = 'Ajouter un film';
require_once './classe/CRUD.php';
require_once './vues/header.php';

$crud = new CRUD();

$genres = $crud->select('genres');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $realisateurId = $crud->insertIfNotExist(
            'realisateurs',
            ['prenom', 'nom'],
            [$_POST['prenom_realisateur'], $_POST['nom_realisateur']]
        );

        $newFilm = [
            'titre' => $_POST['titre'],
            'annee_de_sortie' => $_POST['annee_de_sortie'],
            'realisateur_id' => $realisateurId,
            'pays_d_origine' => $_POST['pays_d_origine'],
            'genre' => $_POST['genre'],
            'poster_url' => $_POST['poster'],
            'resume' => $_POST['resume'],
        ];
        
        if ($crud->insert('films', $newFilm)) {
            $lastFilmId = $crud->lastInsertId();
            header("Location: films-afficher.php?id=$lastFilmId&success=1");
            exit;
        }
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>
<main>
    <aside class="aside-title">
        <h1>Ajouter un nouveau film</h1>
    </aside>
    <div class="form-container">
        <form action="films-ajouter.php" method="post">
            <label for="titre">Titre:</label>
            <input type="text" id="titre" name="titre">

            <label for="annee">Année de sortie:</label>
            <input type="number" id="annee" name="annee_de_sortie">

            <label for="nom_realisateur">Prénom du réalisateur:</label>
            <input type="text" id="nom_realisateur" name="nom_realisateur">

            <label for="prenom_realisateur">Nom du réalisateur:</label>
            <input type="text" id="prenom_realisateur" name="prenom_realisateur">

            <label for="genre">Genre:</label>
            <select id="genre" name="genre">
                <?php foreach ($genres as $genre): ?>
                    <option value="<?php echo $genre['id']; ?>">
                        <?php echo $genre['nom_genre']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <label for="pays_d_origine">Pays</label>
            <select id="pays_d_origine" name="pays_d_origine">
                <option value="États-Unis">États-Unis</option>
                <option value="Afrique du Sud">Afrique du Sud</option>
                <option value="Allemagne">Allemagne</option>
                <option value="Arabie Saoudite">Arabie Saoudite</option>
                <option value="Argentine">Argentine</option>
                <option value="Australie">Australie</option>
                <option value="Autriche">Autriche</option>
                <option value="Belgique">Belgique</option>
                <option value="Brésil">Brésil</option>
                <option value="Canada">Canada</option>
                <option value="Chili">Chili</option>
                <option value="Chine">Chine</option>
                <option value="Colombie">Colombie</option>
                <option value="Corée du Sud">Corée du Sud</option>
                <option value="Cuba">Cuba</option>
                <option value="Danemark">Danemark</option>
                <option value="Égypte">Égypte</option>
                <option value="Espagne">Espagne</option>
                <option value="Finlande">Finlande</option>
                <option value="France">France</option>
                <option value="Grèce">Grèce</option>
                <option value="Hong Kong">Hong Kong</option>
                <option value="Hongrie">Hongrie</option>
                <option value="Inde">Inde</option>
                <option value="Indonésie">Indonésie</option>
                <option value="Iran">Iran</option>
                <option value="Irlande">Irlande</option>
                <option value="Israël">Israël</option>
                <option value="Italie">Italie</option>
                <option value="Japon">Japon</option>
                <option value="Mexique">Mexique</option>
                <option value="Nigeria">Nigeria</option>
                <option value="Norvège">Norvège</option>
                <option value="Nouvelle-Zélande">Nouvelle-Zélande</option>
                <option value="Pays-Bas">Pays-Bas</option>
                <option value="Philippines">Philippines</option>
                <option value="Pologne">Pologne</option>
                <option value="Portugal">Portugal</option>
                <option value="République tchèque">République tchèque</option>
                <option value="Roumanie">Roumanie</option>
                <option value="Royaume-Uni">Royaume-Uni</option>
                <option value="Russie">Russie</option>
                <option value="Singapour">Singapour</option>
                <option value="Suède">Suède</option>
                <option value="Suisse">Suisse</option>
                <option value="Taïwan">Taïwan</option>
                <option value="Thaïlande">Thaïlande</option>
                <option value="Turquie">Turquie</option>
                <option value="Ukraine">Ukraine</option>
                <option value="Venezuela">Venezuela</option>
            </select>
            <label for="resume">Résumé</label>
            <textarea id="resume" name="resume"></textarea>
            <label for="poster">Poster URL:</label>
            <input type="text" id="poster" name="poster">
            <input type="submit" value="Ajouter">
        </form>
    </div>
</main>

<a href="index.php">
    <img src="./assets/images/left-arrow.png" class="back-to-list">
</a>

<?php
if (isset($_GET['success']) && $_GET['success'] == 1) {
    echo '<div class="success-message">Film ajouté avec succès!</div>';
}
?>

<?php require_once './vues/footer.php'; ?>