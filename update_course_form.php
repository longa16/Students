<link href="css/update_form.css" rel="stylesheet">


<?php
// Connexion à la base de données
$host = "database-1.ctowamwq4uaz.eu-north-1.rds.amazonaws.com";
$bdd = "Student";
$user = "admin";
$pwd = "admin#root123";
try {
    $connexion = new PDO("mysql:host=$host;dbname=$bdd", $user, $pwd);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Vérifier si un ID de cours est fourni pour modification
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Récupérer les informations du cours correspondant
    try {
        $stmt = $connexion->prepare("SELECT * FROM cours WHERE cours_id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $cours = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$cours) {
            die("Cours introuvable.");
        }
    } catch (PDOException $e) {
        die("Erreur lors de la récupération du cours : " . $e->getMessage());
    }

    // Si le formulaire est soumis pour mise à jour
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
        $intitule = $_POST['intitule'];
        $credits = $_POST['credits'];

        try {
            $stmt = $connexion->prepare("UPDATE cours SET cours_intitulé = :intitule, cours_credits = :credits WHERE cours_id = :id");
            $stmt->bindParam(':intitule', $intitule);
            $stmt->bindParam(':credits', $credits);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            echo "<p>Cours mis à jour avec succès.</p>";
            echo "<a href='main.php'>Retour à la liste des cours</a>";
            exit;
        } catch (PDOException $e) {
            echo "<p>Erreur lors de la mise à jour du cours : " . $e->getMessage() . "</p>";
        }
    }
} else {
    die("ID du cours non fourni.");
}

?>

<h2>Modifier un cours</h2>
<form method="post">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($cours['cours_id']); ?>">
    <label for="intitule">Intitulé :</label>
    <input type="text" id="intitule" name="intitule" value="<?php echo htmlspecialchars($cours['cours_intitulé']); ?>" required>
    <br>
    <label for="credits">Crédits :</label>
    <input type="number" id="credits" name="credits" value="<?php echo htmlspecialchars($cours['cours_credits']); ?>" required>
    <br>
    <button type="submit" name="update">Mettre à jour</button>
</form>

<a href="main.php">Annuler et retourner à la liste des cours</a>
