<?php
session_start();
include 'db_connect.php';


// Requête pour récupérer tous les agents
$query_agents = "SELECT id, nom, prenom FROM agents";
$agents = [];
if ($result = $conn->query($query_agents)) {
    while ($row = $result->fetch_assoc()) {
        $agents[] = $row;
    }
} else {
    echo '<p class="text-danger text-center">Erreur lors de la récupération des agents.</p>';
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choisir un Agent - Omnes Immobilier</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <main class="container mt-5">
        <h2 class="text-center mb-4">Choisir un Agent</h2>
        <form action="modifieredt.php" method="GET">
            <div class="form-group">
                <label for="agent">Sélectionnez un agent:</label>
                <select name="agent_id" id="agent" class="form-control" required>
                    <?php foreach ($agents as $agent): ?>
                        <option value="<?php echo htmlspecialchars($agent['id']); ?>">
                            <?php echo htmlspecialchars($agent['nom'] . ' ' . htmlspecialchars($agent['prenom'])); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Modifier Emploi du Temps</button>
        </form>
    </main>
    <?php include 'footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
