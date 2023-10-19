<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./assets/css/styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./assets/scripts/main.js"></script>

    <title><?= $titre; ?></title>

</head>

<body>
    <header>
        <h1>
            <a id="logo" href="index.php">VIDÉODRÔME !</a>
        </h1>
        <nav>
            <ul>
                <li><a href="">Films</a>
                    <ul>
                        <li><a href="films-ajouter.php">Ajouter un film</a></li>
                        <li><a href="index.php">Afficher les films</a></li>
                    </ul>
                </li>
                <li><a href="#">Réalisateurs</a>
                    <ul>
                        <li><a href="realisateurs-ajouter.php">Ajouter un réalisateur</a></li>
                        <li><a href="realisateurs-liste.php">Liste des réalisateurs</a></li>
                    </ul>
                </li>
                <li><a href="#">Genres</a>
                    <ul>
                        <li><a href="genres-ajouter.php">Ajouter un genre</a></li>

                    </ul>
                </li>
                <li><a href="#">Liste de lecture</a>
                    <ul>
                        <li><a href="playlist-ajouter.php">Créer une playlist</a></li>
                        <li><a href="playlist-liste.php">Vos playlists</a></li>
                    </ul>
                </li>
            </ul>

            <section class="recherche-container"></section>

            <div class="recherche">
                <form action="index.php" method="get">
                    <input type="text" name="recherche" placeholder="Rechercher un film...">
                    <input type="submit" value="Rechercher">
                </form>
            </div>
            </section>
        </nav>

    </header>