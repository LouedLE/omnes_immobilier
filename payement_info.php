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

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom_prenom = $_POST['nom_prenom'];
    $adresse_ligne1 = $_POST['adresse_ligne1'];
    $adresse_ligne2 = $_POST['adresse_ligne2'];
    $ville = $_POST['ville'];
    $code_postal = $_POST['code_postal'];
    $pays = $_POST['pays'];
    $numero_telephone = $_POST['numero_telephone'];
    $type_carte = $_POST['type_carte'];
    $numero_carte = $_POST['numero_carte'];
    $nom_carte = $_POST['nom_carte'];
    $date_expiration = $_POST['date_expiration'];
    $code_securite = $_POST['code_securite'];

    // Requête pour insérer les informations de paiement dans la base de données
    $query = "INSERT INTO payment_info (user_id, nom_prenom, adresse_ligne1, adresse_ligne2, ville, code_postal, pays, numero_telephone, type_carte, numero_carte, nom_carte, date_expiration, code_securite) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("isssssissssss", $user_id, $nom_prenom, $adresse_ligne1, $adresse_ligne2, $ville, $code_postal, $pays, $numero_telephone, $type_carte, $numero_carte, $nom_carte, $date_expiration, $code_securite);
        if ($stmt->execute()) {
            header("Location: account.php");
            exit();
        } else {
            echo '<p class="text-danger text-center">Erreur lors de l\'enregistrement des informations de paiement.</p>';
        }
        $stmt->close();
    } else {
        echo '<p class="text-danger text-center">Erreur lors de la préparation de la requête.</p>';
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informations de Paiement - Omnes Immobilier</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <main class="container mt-5">
        <h2 class="text-center mb-4">Informations de Paiement</h2>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="nom_prenom">Nom et Prénom:</label>
                <input type="text" class="form-control" id="nom_prenom" name="nom_prenom" required>
            </div>
            <div class="form-group">
                <label for="adresse_ligne1">Adresse Ligne 1:</label>
                <input type="text" class="form-control" id="adresse_ligne1" name="adresse_ligne1" required>
            </div>
            <div class="form-group">
                <label for="adresse_ligne2">Adresse Ligne 2:</label>
                <input type="text" class="form-control" id="adresse_ligne2" name="adresse_ligne2">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="ville">Ville:</label>
                    <input type="text" class="form-control" id="ville" name="ville" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="code_postal">Code Postal:</label>
                    <input type="text" class="form-control" id="code_postal" name="code_postal" required>
                </div>
            </div>
            <div class="form-group">
                <label for="pays">Pays:</label>
                <input type="text" class="form-control" id="pays" name="pays" required>
            </div>
            <div class="form-group">
                <label for="numero_telephone">Numéro de Téléphone:</label>
                <input type="text" class="form-control" id="numero_telephone" name="numero_telephone" required>
            </div>
            <div class="form-group">
    <label for="type_carte">Type de Carte:</label>
    <select class="form-control" id="type_carte" name="type_carte" required>
        <option value="Visa">Visa</option>
        <option value="MasterCard">MasterCard</option>
        <option value="American Express">American Express</option>
        <option value="PayPal">PayPal</option>
    </select>
</div>

            <div class="form-group">
                <label for="numero_carte">Numéro de Carte:</label>
                <input type="text" class="form-control" id="numero_carte" name="numero_carte" required>
            </div>
            <div class="form-group">
                <label for="nom_carte">Nom sur la Carte:</label>
                <input type="text" class="form-control" id="nom_carte" name="nom_carte" required>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="date_expiration">Date d'Expiration:</label>
                    <input type="text" class="form-control" id="date_expiration" name="date_expiration" placeholder="MM/AA" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="code_securite">Code de Sécurité:</label>
                    <input type="text" class="form-control" id="code_securite" name="code_securite" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Valider</button>
        </form>
    </main>
    <?php include 'footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
