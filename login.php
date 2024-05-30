<?php
session_start();
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    $query = "SELECT id, mot_de_passe FROM users WHERE email = ?";
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($id, $hashed_password);
        if ($stmt->fetch() && password_verify($mot_de_passe, $hashed_password)) {
            $_SESSION['user_id'] = $id;
            header("Location: account.php");
            exit();
        } else {
            echo '<p class="text-danger text-center">Email ou mot de passe incorrect.</p>';
        }
        $stmt->close();
    }
}
$conn->close();
?>
