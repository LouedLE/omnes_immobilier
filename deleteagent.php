<?php
include 'db_connect.php';

// Requête pour récupérer tous les agents
$query_agents = "SELECT * FROM agents";
$result_agents = $conn->query($query_agents);

// Vérifier s'il y a des agents
if ($result_agents->num_rows > 0) {
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Supprimer Agent - Omnes Immobilier</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <header class="bg-blue text-white text-center py-4">
            <h1>Omnes Immobilier</h1>
            <nav class="navbar navbar-expand-lg navbar-dark bg-blue">
                <div class="container">
                    <a class="navbar-brand" href="#">Omnes Immobilier</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="pageacceuil.php">Accueil</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="agents.php">Agents</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="properties.php">Propriétés</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="appointments.php">Rendez-vous</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="account.php">Votre Compte</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <div class="container mt-5">
            <h2 class="text-center mb-4">Supprimer Agent</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Utilisateur ID</th>
                        <th>Téléphone</th>
                        <th>CV</th>
                        <th>Photo</th>
                        <th>Spécialité</th>
                        <th>Spécialité 2</th>
                        <th>Spécialité 3</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result_agents->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['nom']); ?></td>
                            <td><?php echo htmlspecialchars($row['prenom']); ?></td>
                            <td><?php echo htmlspecialchars($row['user_id']); ?></td>
                            <td><?php echo htmlspecialchars($row['telephone']); ?></td>
                            <td><?php echo htmlspecialchars($row['cv']); ?></td>
                            <td><?php echo htmlspecialchars($row['photo']); ?></td>
                            <td><?php echo htmlspecialchars($row['specialite']); ?></td>
                            <td><?php echo htmlspecialchars($row['specialite2']); ?></td>
                            <td><?php echo htmlspecialchars($row['specialite3']); ?></td>
                            <td>
                                <form action="delete_agent_process.php" method="POST">
                                    <input type="hidden" name="agent_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <footer class="bg-blue text-white text-center py-3 mt-5">
            <p>Contactez-nous: <a href="mailto:info@omnesimmobilier.fr" class="text-white">info@omnesimmobilier.fr</a></p>
            <p>Téléphone: +33 01 23 45 67 89</p>
            <div id="map" class="container-fluid mt-4"></div>
        </footer>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap" async defer></script>
        <script src="scripts.js"></script>
    </body>
    </html>
    <?php
} else {
    echo "<p class='text-center'>Aucun agent à afficher.</p>";
}

// Fermer la connexion
$conn->close();
?>
