<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Omnes Immobilier</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header class="bg-dark text-white text-center py-4">
        <h1>Omnes Immobilier</h1>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="pageacceuil.php">Omnes Immobilier</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="pageacceuil.php">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="properties.php">Tout Parcourir</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="search.php">Recherche</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="appointments.html">Rendez-vous</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="account.php">Votre Compte</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main class="container mt-5">
        <h2 class="text-center mb-4">Inscription</h2>
        <form action="register.php" method="post">
            <div class="form-group">
                <label for="nom">Nom:</label>
                <input type="text" id="nom" name="nom" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="prenom">Prénom:</label>
                <input type="text" id="prenom" name="prenom" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="mot_de_passe">Mot de passe:</label>
                <input type="password" id="mot_de_passe" name="mot_de_passe" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="role">Rôle:</label>
                <select id="role" name="role" class="form-control">
                    <option value="client">Client</option>
                    <option value="agent">Agent Immobilier</option>
                    <option value="administrateur">Administrateur</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-block">S'inscrire</button>
        </form>
    </main>
    <footer class="bg-dark text-white text-center py-3">
        <p>Contactez-nous: <a href="mailto:info@omnesimmobilier.fr" class="text-white">info@omnesimmobilier.fr</a></p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
