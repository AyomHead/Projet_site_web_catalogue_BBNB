<?php
session_start();

include_once("includes/config.php");
include_once("session_check.php");

if(!isConnected()){
    header("Location: login.php");
    exit();
}
else{
    // Paasont à la récupération des objets livres dans la base données
    $stmt = $pdo -> prepare("SELECT title, author, cover_image FROM books");
    $stmt -> execute();
    $books = $stmt -> fetchAll(PDO::FETCH_ASSOC);

    foreach($books as $book){
        // Ici devrait rester le code php + HTML pour l’affichage des choses comme il se doit !
    }

}
?>