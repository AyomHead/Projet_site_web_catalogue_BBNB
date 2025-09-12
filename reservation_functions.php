<?php
session_start();
include_once("includes/config.php");
include_once("session_check.php");

$error_message = "";

// Fonction pour mettre à jour le statut et la date d'une réservation
function updateReservationStatus($pdo, $id, $status) {
    date_default_timezone_set('Africa/Cotonou');
    if ($status === 'Approuvée') {
        // la date d’approbation
        $approved_at = date('Y-m-d H:i:s');

        $stmt = $pdo->prepare("UPDATE reservations SET status = ?, approved_at = ? WHERE id = ?");
        $stmt->execute([$status, $approved_at, $id]);
    } else {
        // autre statut : seule la colonne status est mise à jour
        $stmt = $pdo->prepare("UPDATE reservations SET status = ? WHERE id = ?");
        $stmt->execute([$status, $id]);
    }
}


// Fonction pour récupérer l'email de l'utilisateur lié à une réservation
function getUserEmailByReservation($pdo, $reservation_id) {
    $stmt = $pdo->prepare("SELECT user_id FROM reservations WHERE id = ?");
    $stmt->execute([$reservation_id]);
    $user = $stmt->fetch();
    if ($user) {
        $stmt = $pdo->prepare("SELECT email FROM users WHERE id = ?");
        $stmt->execute([$user['user_id']]);
        $user_info = $stmt->fetch();
        return $user_info ? $user_info['email'] : null;
    }
    return null;
}

/* // Fonction pour envoyer un email de notification
function notifyUser($to, $status, $pickup_deadline = null, $return_deadline = null) {
    // S’assurer que le fuseau horaire est béninois
    date_default_timezone_set('Africa', 'Cotonou');

    $subject = "Mise à jour de votre réservation";
    if ($status === 'Approuvée') {
        $message = "Bonjour,\n\nVotre réservation a été approuvée.\nVous avez jusqu'au " . date('d/m/Y H:i', strtotime($pickup_deadline)) . " pour récupérer le livre.\nLa date limite de retour est le " . date('d/m/Y H:i', strtotime($return_deadline)) . ".\n\nCordialement,\nL'équipe de la bibliothèque.";
    } else {
        $message = "Bonjour,\n\nVotre réservation a été $status.\n\nCordialement,\nL'équipe de la bibliothèque.";
    }
    mail($to, $subject, $message);
} */

// Fonction pour calculer les dates limites
function setReservationDates($pdo, $reservation_id) {
    date_default_timezone_set('Africa/Cotonou');
    $approved_at = date('Y-m-d H:i:s');
    // Délai pour récupérer le livre 3 jours
    $pickup_deadline = date('Y-m-d H:i:s', strtotime('+3 days', strtotime($approved_at)));
    // Délai pour rendre le livre 7 jours après la date de récupération
    $return_deadline = date('Y-m-d H:i:s', strtotime('+7 days', strtotime($pickup_deadline)));

    $stmt = $pdo->prepare("UPDATE reservations SET pickup_deadline = ?, return_deadline = ? WHERE id = ?");
    $stmt->execute([$pickup_deadline, $return_deadline, $reservation_id]);
}


// Fonction pour annuler automatiquement les réservations non récupérées
function autoCancelReservations($pdo) {
    $stmt = $pdo->prepare("UPDATE reservations SET status = 'Annulée' WHERE status = 'Approuvée' AND picked_up_at IS NULL AND pickup_deadline < NOW()");
    $stmt->execute();
}
?>