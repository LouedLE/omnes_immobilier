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

// Vérifier si l'utilisateur est un agent
$query_check_role = "SELECT role FROM users WHERE id = ?";
if ($stmt_check_role = $conn->prepare($query_check_role)) {
    $stmt_check_role->bind_param("i", $user_id);
    $stmt_check_role->execute();
    $stmt_check_role->bind_result($role);
    $stmt_check_role->fetch();
    $stmt_check_role->close();
    
    if ($role !== 'agent') {
        echo '<p class="text-danger text-center">Accès non autorisé.</p>';
        exit();
    }
} else {
    echo '<p class="text-danger text-center">Erreur lors de la vérification du rôle de l\'utilisateur.</p>';
    exit();
}

// Récupérer l'ID de l'agent
$query_agent_info = "SELECT id, telephone, cv, photo, specialite, specialite2, specialite3 FROM agents WHERE user_id = ?";
if ($stmt_agent_info = $conn->prepare($query_agent_info)) {
    $stmt_agent_info->bind_param("i", $user_id);
    $stmt_agent_info->execute();
    $stmt_agent_info->bind_result($agent_id, $telephone, $cv, $photo, $specialite, $specialite2, $specialite3);
    $stmt_agent_info->fetch();
    $stmt_agent_info->close();
} else {
    echo '<p class="text-danger text-center">Erreur lors de la récupération des informations de l\'agent.</p>';
    exit();
}

// Si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $telephone = $_POST['telephone'];
    $cv = $_POST['cv'];
    $photo = $_POST['photo'];
    $specialite = $_POST['specialite'];
    $specialite2 = $_POST['specialite2'];
    $specialite3 = $_POST['specialite3'];

    // Mettre à jour les informations de l'agent dans la base de données
    $query_update_agent = "UPDATE agents SET telephone = ?, cv = ?, photo = ?, specialite = ?, specialite2 = ?, specialite3 = ? WHERE id = ?";
    if ($stmt_update_agent = $conn->prepare($query_update_agent)) {
        $stmt_update_agent->bind_param("ssssssi", $telephone, $cv, $photo, $specialite, $specialite2, $specialite3, $agent_id);
        if ($stmt_update_agent->execute()) {
            echo '<p class="text-success text-center">Informations mises à jour avec succès.</p>';
        } else {
            echo '<p class="text-danger text-center">Erreur lors de la mise à jour des informations.</p>';
        }
        $stmt_update_agent->close();
    } else {
        echo '<p class="text-danger text-center">Erreur lors de la préparation de la mise à jour des informations.</p>';
    }
}

// Remplacer les valeurs nulles par des chaînes vides avant d'utiliser htmlspecialchars
$telephone = $telephone ?? '';
$cv = $cv ?? '';
$photo = $photo ?? '';
$specialite = $specialite ?? '';
$specialite2 = $specialite2 ?? '';
$specialite3 = $specialite3 ?? '';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compléter Mes Informations - Omnes Immobilier</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <main class="container mt-5">
        <h2 class="text-center mb-4">Compléter Mes Informations</h2>
        <form method="POST" action="completer_informations.php">
            <div class="form-group">
                <label for="telephone">Téléphone</label>
                <input type="text" class="form-control" id="telephone" name="telephone" value="<?php echo htmlspecialchars($telephone); ?>" required>
            </div>
            <div class="form-group">
                <label for="cv">CV (Lien)</label>
                <input type="text" class="form-control" id="cv" name="cv" value="<?php echo htmlspecialchars($cv); ?>" required>
            </div>
            <div class="form-group">
                <label for="photo">Photo (Lien)</label>
                <input type="text" class="form-control" id="photo" name="photo" value="<?php echo htmlspecialchars($photo); ?>" required>
            </div>
            <div class="form-group">
                <label for="specialite">Spécialité</label>
                <select class="form-control" id="specialite" name="specialite" required>
                    <option value="Immobilier résidentiel" <?php if ($specialite == 'Immobilier résidentiel') echo 'selected'; ?>>Immobilier résidentiel</option>
                    <option value="Immobilier commercial" <?php if ($specialite == 'Immobilier commercial') echo 'selected'; ?>>Immobilier commercial</option>
                    <option value="Terrain" <?php if ($specialite == 'Terrain') echo 'selected'; ?>>Terrain</option>
                    <option value="Appartement à louer" <?php if ($specialite == 'Appartement à louer') echo 'selected'; ?>>Appartement à louer</option>
                </select>
            </div>
            <div class="form-group">
                <label for="specialite2">Spécialité 2</label>
                <select class="form-control" id="specialite2" name="specialite2" required>
                    <option value="Immobilier résidentiel" <?php if ($specialite2 == 'Immobilier résidentiel') echo 'selected'; ?>>Immobilier résidentiel</option>
                    <option value="Immobilier commercial" <?php if ($specialite2 == 'Immobilier commercial') echo 'selected'; ?>>Immobilier commercial</option>
                    <option value="Terrain" <?php if ($specialite2 == 'Terrain') echo 'selected'; ?>>Terrain</option>
                    <option value="Appartement à louer" <?php if ($specialite2 == 'Appartement à louer') echo 'selected'; ?>>Appartement à louer</option>
                </select>
            </div>
            <div class="form-group">
                <label for="specialite3">Spécialité 3</label>
                <select class="form-control" id="specialite3" name="specialite3" required>
                    <option value="0" <?php if ($specialite3 == '0') echo 'selected'; ?>>0</option>
                    <option value="Immobilier résidentiel" <?php if ($specialite3 == 'Immobilier résidentiel') echo 'selected'; ?>>Immobilier résidentiel</option>
                    <option value="Immobilier commercial" <?php if ($specialite3 == 'Immobilier commercial') echo 'selected'; ?>>Immobilier commercial</option>
                    <option value="Terrain" <?php if ($specialite3 == 'Terrain') echo 'selected'; ?>>Terrain</option>
                    <option value="Appartement à louer" <?php if ($specialite3 == 'Appartement à louer') echo 'selected'; ?>>Appartement à louer</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Soumettre</button>
        </form>
    </main>
    <?php include 'footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
