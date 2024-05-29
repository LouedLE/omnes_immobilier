<?php
include 'db_connect.php';

$query = "SELECT id, titre, description, type, prix, adresse, ville, code_postal, surface, nombre_pieces, nombre_chambres, agent_id, image1, image2, image3 FROM properties";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Toutes les Propriétés - Omnes Immobilier</title>
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
            <section id="properties" class="row">
                <?php
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <a href="afficherproperties.php?id=<?php echo $row['id']; ?>">
                                <div id="carouselProperty<?php echo $row['id']; ?>" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img src="<?php echo $row['image1']; ?>" class="d-block w-100" alt="Propriété <?php echo $row['id']; ?> - Image 1">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="<?php echo $row['image2']; ?>" class="d-block w-100" alt="Propriété <?php echo $row['id']; ?> - Image 2">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="<?php echo $row['image3']; ?>" class="d-block w-100" alt="Propriété <?php echo $row['id']; ?> - Image 3">
                                        </div>
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselProperty<?php echo $row['id']; ?>" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Précédent</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselProperty<?php echo $row['id']; ?>" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Suivant</span>
                                    </a>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $row['titre']; ?></h5>
                                    <p class="card-text"><?php echo $row['description']; ?></p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </section>
        </main>
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
    echo "<p class='text-center'>Aucune propriété n'est disponible pour le moment.</p>";
}
$conn->close();
?>
