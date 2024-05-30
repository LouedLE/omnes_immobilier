<?php
session_start();
include 'db_connect.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

// Vérifier si l'ID du rendez-vous est fourni
if (!isset($_POST['appointment_id'])) {
    header("Location: account.php");
    exit();
}

$appointment_id = $_POST['appointment_id'];

// Récupérer les détails du rendez-vous pour mettre à jour la disponibilité de l'agent
$query_appointment = "SELECT agent_id, jour, AMPM FROM appointments WHERE id = ?";
if ($stmt_appointment = $conn->prepare($query_appointment)) {
    $stmt_appointment->bind_param("i", $appointment_id);
    $stmt_appointment->execute();
    $stmt_appointment->bind_result($agent_id, $jour, $AMPM);
    $stmt_appointment->fetch();
    $stmt_appointment->close();

    // Déterminer le nom de la colonne de disponibilité
    $day_column = "";
    switch ($jour) {
        case 0: $day_column = "lundi"; break;
        case 1: $day_column = "mardi"; break;
        case 2: $day_column = "mercredi"; break;
        case 3: $day_column = "jeudi"; break;
        case 4: $day_column = "vendredi"; break;
        case 5: $day_column = "samedi"; break;
        case 6: $day_column = "dimanche"; break;
    }
    $availability_column = $day_column . ($AMPM == 0 ? "AM" : "PM");

    // Supprimer le rendez-vous
    $query_delete = "DELETE FROM appointments WHERE id = ?";
    if ($stmt_delete = $conn->prepare($query_delete)) {
        $stmt_delete->bind_param("i", $appointment_id);
        $stmt_delete->execute();
        $stmt_delete->close();
    } else {
        echo '<p class="text-danger text-center">Erreur lors de l\'annulation du rendez-vous.</p>';
        exit();
    }

    // Mettre à jour la disponibilité de l'agent
    $query_update_availability = "UPDATE availabilities SET $availability_column = 1 WHERE agent_id = ?";
    if ($stmt_update_availability = $conn->prepare($query_update_availability)) {
        $stmt_update_availability->bind_param("i", $agent_id);
        $stmt_update_availability->execute();
        $stmt_update_availability->close();
    } else {
        echo '<p class="text-danger text-center">Erreur lors de la mise à jour de la disponibilité.</p>';
        exit();
    }
    
    header("Location: account.php?message=Rendez-vous annulé avec succès");
} else {
    echo '<p class="text-danger text-center">Erreur lors de la récupération du rendez-vous.</p>';
    exit();
}
?>
