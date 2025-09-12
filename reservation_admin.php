<?php
session_start();
?>

<?php
include_once("includes/config.php");
include_once("session_check.php");
include_once("reservation_functions.php");

// Traitement principal
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isConnected()) {
        header("Location: login.php");
        exit();
    }
    if (!isset($_POST['id']) || empty($_POST['id'])) {
        $error_message = "ID de réservation manquant.";
    } else {
        $reservation_id = $_POST['id'];
        $action = $_POST['action'] ?? '';
        if ($action === 'approve') {
            updateReservationStatus($pdo, $reservation_id, 'Approuvée');
            setReservationDates($pdo, $reservation_id);
            /* $user_email = getUserEmailByReservation($pdo, $reservation_id);
            if ($user_email) notifyUser($user_email, 'Approuvée', $pickup_deadline, $return_deadline); */
        } elseif ($action === 'reject') {
            updateReservationStatus($pdo, $reservation_id, 'Rejetée');
            /* $user_email = getUserEmailByReservation($pdo, $reservation_id);
            /* if ($user_email) notifyUser($user_email, 'Rejetée'); */ 
        } else {
            $error_message = "Action invalide.";
        }
    }
    // autoCancelReservations($pdo); ã appeler périodiquement pour la gestion des éventuelles annulations
}
?>