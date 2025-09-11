<?php
session_start();

include_once("includes/config.php");

//varibale pour les messages d’erreurs
$error_message = "";

if($_SESSION['REQUEST_METHODE'] === 'POST'){
    if(!isset($_POST['id']) || empty($_POST['id'])) {
        $error_message = "ID de livre manquant.";
    }
    else {
        $book_id = $_POST['id'];

        $stmt = $pdo-> prepare("SELECT title, author, status, cover_image, description FROM books WHERE id = ?");
        $stmt-> execute([$book_id]);
        $book = $stmt->fetch(PDO::FETCH_ASSOC);
        if(!$book) {
            $error_message = "Livre non trouvé.";
        }
        else{
            // On peut afficher les détails du livre ici
        }
    }
}
?>