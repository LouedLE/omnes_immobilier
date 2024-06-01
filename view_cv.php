<?php
if (isset($_GET['id'])) {
    $agent_id = $_GET['id'];

    // Chargement du fichier XML
    $xml = simplexml_load_file('agent_details.xml');
    $agent_details = $xml->xpath("//agent[@id='$agent_id']")[0];

    if ($agent_details) {
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>CV de <?php echo htmlspecialchars($agent_details->prenom . ' ' . $agent_details->nom); ?></title>
            <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
            <link rel="stylesheet" href="styles.css">
        </head>
        <body>
            <main class="container mt-5">
                <h1>CV de <?php echo htmlspecialchars($agent_details->prenom . ' ' . $agent_details->nom); ?></h1>
                <div class="cv-section">
                    <h2>Informations Personnelles</h2>
                    <p><strong>Nom:</strong> <?php echo htmlspecialchars($agent_details->nom); ?></p>
                    <p><strong>Prénom:</strong> <?php echo htmlspecialchars($agent_details->prenom); ?></p>
                    <p><strong>Age:</strong> <?php echo htmlspecialchars($agent_details->age); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($agent_details->email); ?></p>
                    <p><strong>Coordonnées:</strong> <?php echo htmlspecialchars($agent_details->coordonnees); ?></p>
                </div>
                <div class="cv-section">
                    <h2>Formations</h2>
                    <?php foreach ($agent_details->formations->formation as $formation) { ?>
                        <div class="formation">
                            <p><strong>Titre:</strong> <?php echo htmlspecialchars($formation->titre); ?></p>
                            <p><strong>Établissement:</strong> <?php echo htmlspecialchars($formation->etablissement); ?></p>
                            <p><strong>Année:</strong> <?php echo htmlspecialchars($formation->annee); ?></p>
                        </div>
                    <?php } ?>
                </div>
                <div class="cv-section">
                    <h2>Expériences Professionnelles</h2>
                    <?php foreach ($agent_details->experiences->experience as $experience) { ?>
                        <div class="experience">
                            <p><strong>Poste:</strong> <?php echo htmlspecialchars($experience->poste); ?></p>
                            <p><strong>Entreprise:</strong> <?php echo htmlspecialchars($experience->entreprise); ?></p>
                            <p><strong>Durée:</strong> <?php echo htmlspecialchars($experience->annees); ?></p>
                            <p><strong>Description:</strong> <?php echo htmlspecialchars($experience->description); ?></p>
                        </div>
                    <?php } ?>
                </div>
            </main>
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        </body>
        </html>
        <?php
    } else {
        echo "<p class='text-center'>Agent non trouvé</p>";
    }
} else {
    echo "<p class='text-center'>Aucun agent spécifié</p>";
}
?>
