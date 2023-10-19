-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 19, 2023 at 04:57 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `videodrome`
--

-- --------------------------------------------------------

--
-- Table structure for table `films`
--

CREATE TABLE `films` (
  `id` int(11) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `genre` int(11) DEFAULT NULL,
  `annee_de_sortie` int(11) DEFAULT NULL,
  `realisateur_id` int(11) DEFAULT NULL,
  `resume` text DEFAULT NULL,
  `pays_d_origine` varchar(70) DEFAULT NULL,
  `poster_local` varchar(255) DEFAULT NULL,
  `poster_url` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `films`
--

INSERT INTO `films` (`id`, `titre`, `genre`, `annee_de_sortie`, `realisateur_id`, `resume`, `pays_d_origine`, `poster_local`, `poster_url`) VALUES
(1, 'The Thing', 14, 1982, 3, 'Une équipe de recherche en Antarctique découvre une entité extraterrestre pouvant prendre l\'apparence de ses victimes.', 'États-Unis', '', 'https://m.media-amazon.com/images/M/MV5BNGViZWZmM2EtNGYzZi00ZDAyLTk3ODMtNzIyZTBjN2Y1NmM1XkEyXkFqcGdeQXVyNTAyODkwOQ@@._V1_.jpg'),
(4, 'Night of the Living Dead', 14, 1968, 6, 'Sept personnes se retrouvent piégées dans une ferme de Pennsylvanie pendant une attaque de zombies.', 'États-Unis', '', 'https://m.media-amazon.com/images/I/61jkl3ML6DS._AC_UF1000,1000_QL80_.jpg'),
(5, 'Rosemary\'s Baby', 14, 1968, 7, 'Une jeune femme enceinte suspecte que son mari et ses voisins ont des plans sinistres pour elle et son bébé.', 'États-Unis', '', 'https://m.media-amazon.com/images/M/MV5BMTA5NWQwMmYtZjEyYS00Nzc2LTgwZjAtNTQ4NmFmZjNkNjg4XkEyXkFqcGdeQXVyMjUzOTY1NTc@._V1_FMjpg_UX1000_.jpg'),
(6, 'The Exorcist', 14, 1973, 8, 'L\'histoire d\'une jeune fille possédée et des efforts désespérés de sa mère et de deux prêtres pour la sauver.', 'États-Unis', '', 'https://m.media-amazon.com/images/I/71KnXY8ZfiL.__AC_SX300_SY300_QL70_ML2_.jpg'),
(8, 'Halloween', 14, 1978, 3, 'Un tueur échappé d\'un hôpital psychiatrique retourne dans sa ville natale pour continuer son carnage.', 'États-Unis', '', 'https://i.etsystatic.com/15375993/r/il/1ed997/1350030753/il_fullxfull.1350030753_pfyo.jpg'),
(10, 'Hellraiser', 14, 1987, 14, '', 'États-Unis', '', 'https://m.media-amazon.com/images/M/MV5BOGRlZTdhOGYtODc5NS00YmJkLTkzN2UtZDMyYmRhZWM1NTQwXkEyXkFqcGdeQXVyMzU4Nzk4MDI@._V1_.jpg'),
(11, 'Child\'s Play', 14, 1988, 28, 'Un tueur en série utilise la magie vaudou pour transférer son esprit dans une poupée et poursuivre son carnage.', 'États-Unis', '', 'https://www.themoviedb.org/t/p/original/kIME5nPt7Mwm2484lyCkLJXLD63.jpg'),
(12, 'Smooth Talk', 17, 1985, 31, 'Une adolescente se trouve attirée par un homme plus âgé, ce qui entraîne des conséquences inattendues.', 'États-Unis', '', 'https://s3.amazonaws.com/criterion-production/films/04bdc7db9ef66171408b30e21088e3a4/0JgPnY1xmPn5VypA7Gte0oES0bJYTh_large.jpg'),
(13, 'Le Salaire de la Peur', 1, 1953, 32, 'Dans un village d’Amérique latine, quatre hommes sont engagés pour transporter un chargement de nitroglycérine extrêmement volatile.', 'France', '', 'https://s3.amazonaws.com/criterion-production/films/2d3c65e2a96df118ecf3a20d12ae720a/vZCph6mUDbPoW4VN0IXuAaVXDhRjnE_large.jpg'),
(14, 'Donnie Darko', 18, 2001, 30, 'Un adolescent troublé, doté de pouvoirs surnaturels, est poussé par un lapin géant à commettre une série d\'actes qui affecteront le destin de l\'univers.', 'États-Unis', '', 'https://m.media-amazon.com/images/M/MV5BZjZlZDlkYTktMmU1My00ZDBiLWFlNjEtYTBhNjVhOTM4ZjJjXkEyXkFqcGdeQXVyMTMxODk2OTU@._V1_FMjpg_UX1000_.jpg'),
(15, 'Mysterious Skin', 16, 2004, 29, 'Deux jeunes hommes sont hantés par des événements survenus dans leur enfance et cherchent à comprendre ce qui leur est vraiment arrivé.', 'États-Unis', '', 'https://resizing.flixster.com/-XZAfHZM39UwaGJIFWKAE8fS0ak=/v3/t/assets/p88247_p_v8_aa.jpg'),
(16, 'The Doom Generation', 1, 1995, 29, 'Deux adolescents en fuite rencontrent un homme mystérieux et dangereux, ce qui les entraîne dans une série d\'événements de plus en plus violents.', 'États-Unis', '', 'https://images.squarespace-cdn.com/content/v1/5b5921b685ede10f49837a72/ab447264-1043-4e09-86a0-787a432198b6/doom_generation_poster_500x741.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `films_playlists`
--

CREATE TABLE `films_playlists` (
  `film_id` int(11) NOT NULL,
  `playlist_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `films_playlists`
--

INSERT INTO `films_playlists` (`film_id`, `playlist_id`) VALUES
(1, 1),
(4, 1),
(8, 1),
(11, 1),
(14, 1);

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `id` int(11) NOT NULL,
  `nom_genre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`id`, `nom_genre`) VALUES
(1, 'Action'),
(2, 'Animation'),
(3, 'Aventure'),
(4, 'Biographie'),
(5, 'Comédie'),
(6, 'Crime'),
(7, 'Documentaire'),
(8, 'Drame'),
(9, 'Famille'),
(10, 'Fantastique'),
(11, 'Film noir'),
(12, 'Guerre'),
(13, 'Histoire'),
(14, 'Horreur'),
(15, 'Musique'),
(16, 'Mystère'),
(17, 'Romantique'),
(18, 'Science-fiction'),
(19, 'Sport'),
(20, 'Thriller'),
(21, 'Western');

-- --------------------------------------------------------

--
-- Table structure for table `playlist`
--

CREATE TABLE `playlist` (
  `id` int(11) NOT NULL,
  `nom_playlist` varchar(100) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `playlist`
--

INSERT INTO `playlist` (`id`, `nom_playlist`, `description`) VALUES
(1, 'Mes favoris', 'Ma plus belle liste'),
(6, 'Mes favoris 3', '');

-- --------------------------------------------------------

--
-- Table structure for table `realisateurs`
--

CREATE TABLE `realisateurs` (
  `id` int(11) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `realisateurs`
--

INSERT INTO `realisateurs` (`id`, `prenom`, `nom`) VALUES
(1, 'Steven', 'Spielberg'),
(2, 'Luc', 'Besson'),
(3, 'John', 'Carpenter'),
(4, 'Bob', 'Clark'),
(5, 'Georges', 'Franju'),
(6, 'George A.', 'Romero'),
(7, 'Roman', 'Polanski'),
(8, 'William', 'Friedkin'),
(9, 'Woody', 'Allen'),
(10, 'David', 'Cronenberg'),
(11, 'Andrzej', 'Zulawski'),
(12, 'Gerald', 'Kargl'),
(13, 'John', 'McNaughton'),
(14, 'Clive', 'Barker'),
(15, 'Adrian', 'Lyne'),
(16, 'Mark L.', 'Lester'),
(17, 'John', 'Lafia'),
(18, 'Frank', 'Henenlotter'),
(19, 'Adam', 'Simon'),
(20, 'Rob', 'Reiner'),
(21, 'Ron', 'Underwood'),
(22, 'Tommy Lee', 'Wallace'),
(23, 'Wes', 'Craven'),
(24, 'Francis Ford', 'Coppola'),
(28, 'Tom', 'Holland'),
(29, 'Gregg', 'Araki'),
(30, 'Richard', 'Kelly'),
(31, 'Joyce', 'Chopra'),
(32, 'Henri-Georges', 'Clouzot');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `films`
--
ALTER TABLE `films`
  ADD PRIMARY KEY (`id`),
  ADD KEY `genre` (`genre`),
  ADD KEY `realisateur_id` (`realisateur_id`);

--
-- Indexes for table `films_playlists`
--
ALTER TABLE `films_playlists`
  ADD PRIMARY KEY (`film_id`,`playlist_id`),
  ADD KEY `playlist_id` (`playlist_id`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `playlist`
--
ALTER TABLE `playlist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `realisateurs`
--
ALTER TABLE `realisateurs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `films`
--
ALTER TABLE `films`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `playlist`
--
ALTER TABLE `playlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `realisateurs`
--
ALTER TABLE `realisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `films`
--
ALTER TABLE `films`
  ADD CONSTRAINT `films_ibfk_1` FOREIGN KEY (`genre`) REFERENCES `genres` (`id`),
  ADD CONSTRAINT `films_ibfk_2` FOREIGN KEY (`realisateur_id`) REFERENCES `realisateurs` (`id`);

--
-- Constraints for table `films_playlists`
--
ALTER TABLE `films_playlists`
  ADD CONSTRAINT `films_playlists_ibfk_1` FOREIGN KEY (`film_id`) REFERENCES `films` (`id`),
  ADD CONSTRAINT `films_playlists_ibfk_2` FOREIGN KEY (`playlist_id`) REFERENCES `playlist` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
