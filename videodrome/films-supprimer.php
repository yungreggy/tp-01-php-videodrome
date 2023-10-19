<?php
require_once './classe/CRUD.php';
$crud = new CRUD();

$film_id = isset($_GET['id']) ? $_GET['id'] : null;

try {
    $result = $crud->delete('films', $film_id);

    if ($result) {
        header("Location: index.php?success=1");
        exit;
    } else {
        header("Location: error.php");
        exit;
    }
} catch (Exception $e) {
    header("Location: error.php");
    exit;
}
?>

