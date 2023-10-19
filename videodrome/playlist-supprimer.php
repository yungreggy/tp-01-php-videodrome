<?php
require_once 'classe/CRUD.php';
$crud = new CRUD();

if (isset($_GET['id'])) {
    $playlistId = $_GET['id'];

    try {
        $sql = "DELETE FROM playlist WHERE id = :id";
        $stmt = $crud->prepare($sql);
        $stmt->bindParam(':id', $playlistId, PDO::PARAM_INT);

        if ($stmt->execute()) {
            header("Location: playlist-liste.php");
            exit;
        } else {
            echo "Échec de la suppression";
        }
    } catch (PDOException $e) {
        echo "Une erreur s'est produite: " . $e->getMessage();
    }
} else {
    echo "Aucun ID de playlist fourni";
    exit;
}
?>