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

// Récupérer la liste des utilisateurs avec le rôle "agent" ou "administrateur" pour le formulaire de sélection
$query_users = "SELECT id, nom, prenom FROM users WHERE id != ? AND (role = 'agent' OR role = 'administrateur')";
$users = [];
if ($stmt_users = $conn->prepare($query_users)) {
    $stmt_users->bind_param("i", $user_id);
    $stmt_users->execute();
    $result_users = $stmt_users->get_result();
    while ($user = $result_users->fetch_assoc()) {
        $users[] = $user;
    }
    $stmt_users->close();
}

// Envoi de message
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['receiver_id'], $_POST['message'])) {
    $receiver_id = $_POST['receiver_id'];
    $message = $_POST['message'];

    $query_send = "INSERT INTO messages (sender_id, receiver_id, message) VALUES (?, ?, ?)";
    if ($stmt_send = $conn->prepare($query_send)) {
        $stmt_send->bind_param("iis", $user_id, $receiver_id, $message);
        $stmt_send->execute();
        $stmt_send->close();
        $success_message = "Message envoyé avec succès.";
    } else {
        $error_message = "Erreur lors de l'envoi du message.";
    }
}

// Récupérer les messages reçus et envoyés par l'utilisateur
$query_messages = "
    SELECT m.id, m.sender_id, m.receiver_id, m.message, u.nom, u.prenom 
    FROM messages m
    JOIN users u ON m.sender_id = u.id
    WHERE m.receiver_id = ? OR m.sender_id = ?
    ORDER BY m.id DESC";
$messages = [];
if ($stmt_messages = $conn->prepare($query_messages)) {
    $stmt_messages->bind_param("ii", $user_id, $user_id);
    $stmt_messages->execute();
    $result_messages = $stmt_messages->get_result();
    while ($message = $result_messages->fetch_assoc()) {
        $messages[] = $message;
    }
    $stmt_messages->close();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messagerie - Omnes Immobilier</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <main class="container mt-5">
        <h2 class="text-center mb-4">Messagerie</h2>

        <?php if (isset($success_message)): ?>
            <div class="alert alert-success"><?php echo $success_message; ?></div>
        <?php endif; ?>
        <?php if (isset($error_message)): ?>
            <div class="alert alert-danger"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Envoyer un message</h5>
                <form method="POST" action="messagerie.php">
                    <div class="form-group">
                        <label for="receiver_id">Destinataire</label>
                        <select class="form-control" id="receiver_id" name="receiver_id" required>
                            <?php foreach ($users as $user): ?>
                                <option value="<?php echo htmlspecialchars($user['id']); ?>">
                                    <?php echo htmlspecialchars($user['prenom'] . ' ' . $user['nom']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </form>
            </div>
        </div>

        <div class="mt-4">
            <h4>Vos Messages</h4>
            <?php if (count($messages) > 0): ?>
                <ul class="list-group">
                    <?php foreach ($messages as $msg): ?>
                        <li class="list-group-item">
                            <strong><?php echo htmlspecialchars($msg['prenom'] . ' ' . $msg['nom']); ?>:</strong>
                            <?php echo htmlspecialchars($msg['message']); ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p class="text-center">Vous n'avez pas de messages.</p>
            <?php endif; ?>
        </div>
    </main>
    <?php include 'footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
