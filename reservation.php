<?php
session_start();
?>

<?php
include_once("includes/config.php");
include_once("session_check.php");

// variable pour les messages d’erreurs
$error_message = "";
$success_message = "";

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(!isConnected()){
        header("Location: login.php");
        exit();
    }
    else{
        if(!isset($_POST['id']) || empty($_POST['id'])) {
            $error_message = "ID de livre manquant.";
        }
        else{
            $book_id = $_POST['id'] ?? '';
            // Le livre existe normalement vu qu’il est sur la page web on passe donc à l’extraction des données nécessaires à la réservation
            $user_id = $_SESSION['id'];
            $stmt = $pdo-> prepare("INSERT INTO reservations (user_id, book_id, status) VALUES (?, ?, 'Demande en cours...')");
            if($stmt-> execute([$user_id, $book_id])){
                $success_message = "Réservation réussie !";
                /*
                header("Location: catalogue.php");
                exit(); // Redirection vers le catalogue après une réservation réussie
                */
            }
            else{
                $error_message = "Erreur lors de la réservation. Veuillez réessayer.";
            }
        }
    }
}
?>