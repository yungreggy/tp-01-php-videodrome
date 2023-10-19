<?php

require_once './classe/CRUD.php';
$crud = new CRUD();

$genre_id = isset($_GET['id']) ? $_GET['id'] : null;

try {
    $result = $crud->delete('genres', $genre_id);

    if ($result === true) {
        header("Location: index.php?success=1");
        exit;
    } else {
        if ($result == "23000") { // Code d'erreur PDO pour violation de contrainte de clé étrangère
            $message = "Ce genre ne peut pas être supprimé car il est associé à un ou plusieurs films.";
        } else {
            $message = "Une erreur s'est produite lors de la tentative de suppression.";
        }
        header("Location: error.php?error=" . urlencode($message));
        exit;
    }
} catch (Exception $e) {
    $message = "Une erreur s'est produite lors de la tentative de suppression: " . $e->getMessage();
    header("Location: error.php?error=" . urlencode($message));
    exit;
}

