<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Omnes Immobilier</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header class="bg-blue text-white text-center py-4 homepage-nav">
        <h1>Omnes Immobilier</h1>
        <nav class="navbar navbar-expand-lg navbar-dark bg-blue">
            <div class="container">
                <a class="navbar-brand" href="#">Omnes Immobilier</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="pageacceuil.php">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="properties.php">Tout Parcourir</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="search.php">Recherche</a>
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
    <main class="container mt-5">
        <?php
        if (isset($_GET['message'])) {
            echo '<div class="alert alert-success text-center">' . htmlspecialchars($_GET['message']) . '</div>';
        }
        ?>
        <section id="welcome" class="text-center mb-5">
            <h2>Bienvenue chez Omnes Immobilier</h2>
            <p class="lead">Au service des besoins immobiliers de la communauté Omnes.</p>
        </section>
        <section id="event" class="text-center mb-5">
            <h2>Évènement de la semaine</h2>
            <p class="lead">Visite libre à la maison de campagne ce week-end!</p>
        </section>
        <section id="carouselExampleIndicators" class="carousel slide mb-5" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="property1.jpg" class="d-block w-100" alt="Propriété 1">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Appartement à Paris</h5>
                        <p>Bel appartement plein sud</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="property2.jpg" class="d-block w-100" alt="Propriété 2">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Maison avec piscine</h5>
                        <p>Belle maison rénovée luxueuse avec piscine</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="property3.jpg" class="d-block w-100" alt="Propriété 3">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Bureau</h5>
                        <p>Bureau à la défense</p>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Précédent</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Suivant</span>
            </a>
        </section>
    </main>
    <footer class="bg-blue text-white text-center py-3 homepage-footer">
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
