<?php
session_start();
include 'db_connect.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

// Récupérer l'ID de l'utilisateur connecté
$user_id = $_SESSION['user_id'];

// Requête pour mettre à jour le montant à payer à 0 dans la table "users"
$query_update_payment = "UPDATE users SET reste_a_payer = 0 WHERE id = ?";
if ($stmt_update_payment = $conn->prepare($query_update_payment)) {
    $stmt_update_payment->bind_param("i", $user_id);
    if ($stmt_update_payment->execute()) {
        echo "Montant réglé avec succès";
    } else {
        echo "Erreur lors de la mise à jour du montant";
    }
    $stmt_update_payment->close();
} else {
    echo "Erreur lors de la préparation de la requête de mise à jour";
}

// Fermer la connexion à la base de données
$conn->close();
?>
