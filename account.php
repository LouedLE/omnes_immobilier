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

// Requête pour récupérer les informations de l'utilisateur
$query_user_info = "SELECT id, nom, prenom, email, role, reste_a_payer FROM users WHERE id = ?";
if ($stmt_user_info = $conn->prepare($query_user_info)) {
    $stmt_user_info->bind_param("i", $user_id);
    $stmt_user_info->execute();
    $stmt_user_info->bind_result($id, $nom, $prenom, $email, $role, $reste_a_payer);
    $stmt_user_info->fetch();
    $stmt_user_info->close();
} else {
    echo '<p class="text-danger text-center">Erreur lors de la récupération des informations de l\'utilisateur.</p>';
    exit();
}

// Vérifier si les informations financières de l'utilisateur sont déjà présentes
$query_payment_info = "SELECT COUNT(*) FROM payment_info WHERE user_id = ?";
if ($stmt_payment_info = $conn->prepare($query_payment_info)) {
    $stmt_payment_info->bind_param("i", $user_id);
    $stmt_payment_info->execute();
    $stmt_payment_info->bind_result($payment_info_count);
    $stmt_payment_info->fetch();
    $stmt_payment_info->close();
} else {
    echo '<p class="text-danger text-center">Erreur lors de la vérification des informations de paiement.</p>';
    exit();
}

// Requête pour récupérer les rendez-vous de l'utilisateur avec les noms des agents
$query_appointments = "SELECT a.id, a.jour, a.AMPM, ag.nom FROM appointments a JOIN agents ag ON a.agent_id = ag.id WHERE client_id = ?";
$appointments = [];
if ($stmt_appointments = $conn->prepare($query_appointments)) {
    $stmt_appointments->bind_param("i", $user_id);
    $stmt_appointments->execute();
    $stmt_appointments->bind_result($appointment_id, $jour, $AMPM, $agent_nom);
    while ($stmt_appointments->fetch()) {
        $appointments[] = [
            'id' => $appointment_id,
            'jour' => $jour,
            'AMPM' => $AMPM,
            'agent_nom' => $agent_nom
        ];
    }
    $stmt_appointments->close();
} else {
    echo '<p class="text-danger text-center">Erreur lors de la récupération des rendez-vous.</p>';
    exit();
}

// Déterminer l'affichage en fonction de la présence des informations financières et du montant restant à payer
$show_payment_button = ($payment_info_count > 0 && $reste_a_payer > 0) ? false : true;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre Compte - Omnes Immobilier</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <main class="container mt-5">
        <h2 class="text-center mb-4">Votre Compte</h2>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Informations de l'utilisateur</h5>
                <p class="card-text"><strong>ID:</strong> <?php echo htmlspecialchars($id); ?></p>
                <p class="card-text"><strong>Nom:</strong> <?php echo htmlspecialchars($nom); ?></p>
                <p class="card-text"><strong>Prénom:</strong> <?php echo htmlspecialchars($prenom); ?></p>
                <p class="card-text"><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
                <p class="card-text"><strong>Rôle:</strong> <?php echo htmlspecialchars($role); ?></p>
            </div>
        </div>

        <div class="mt-4">
            <h4>Vos Rendez-vous</h4>
            <?php if (count($appointments) > 0): ?>
                <ul class="list-group">
                    <?php foreach ($appointments as $appointment): ?>
                        <li class="list-group-item">
                            <strong>Rendez-vous:</strong> 
                            <?php 
                            // Convertir le numéro du jour en nom du jour
                            $jours = ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche"];
                            $jour_nom = $jours[$appointment['jour']];
                            echo htmlspecialchars($jour_nom) . ' ' . htmlspecialchars($appointment['AMPM'] == 0 ? 'Matin' : 'Après-midi'); 
                            ?> 
                            avec agent: <?php echo htmlspecialchars($appointment['agent_nom']); ?>
                            <form action="annulerrdv.php" method="POST" style="display:inline;">
                                <input type="hidden" name="appointment_id" value="<?php echo htmlspecialchars($appointment['id']); ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Annuler</button>
                            </form>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p class="text-center">Vous n'avez pas de rendez-vous.</p>
            <?php endif; ?>
        </div>

        <div class="mt-4">
            <h4>Reste à Payer</h4>
            <p class="card-text"><strong>Montant à payer:</strong> <?php echo htmlspecialchars($reste_a_payer); ?> €</p>
        </div>

        <div class="mt-4">
            <?php if ($reste_a_payer > 0 && $show_payment_button): ?>
                <a href="payment_info.php" class="btn btn-primary">Ajouter Informations de Paiement</a>
            <?php endif; ?>
            <?php if ($reste_a_payer > 0 && !$show_payment_button): ?>
                <button onclick="reglerMontant()" class="btn btn-primary">Régler Montant</button>
            <?php endif; ?>
        </div>

        <div class="mt-4">
            <a href="messagerie.php" class="btn btn-primary">Messages</a>
        </div>

        <?php if ($role == 'agent' || $role == 'administrateur'): ?>
                <h4>Actions</h4>
                <ul>
                    <?php if ($role == 'agent'): ?>
                        <li><a href="add_property.php">Ajouter une propriété</a></li>
                    <?php endif; ?>
                    <?php if ($role == 'administrateur'): ?>
                        <li><a href="add_property.php">Ajouter une propriété</a></li>
                        <li><a href="add_agent.php">Ajouter un agent immobilier</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        <?php endif; ?>
    </main>
    <?php include 'footer.php'; ?>
    <script>
        function reglerMontant() {
            // Requête AJAX pour mettre à jour le montant dans la base de données
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'update_payment.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    // Réponse de la requête
                    alert(xhr.responseText);
                    // Recharger la page pour afficher le nouveau montant
                    window.location.reload();
                }
            };
            xhr.send();
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

