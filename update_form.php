<link href="css/update_form.css" rel="stylesheet">

<?php
// Connexion à la base de données
$host = "localhost";
$bdd = "students";
$user = "root";
$pwd = "ROOT";

try {
    $connexion = new PDO("mysql:host=$host;dbname=$bdd", $user, $pwd);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Récupérer les informations de l'étudiant
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];

    try {
        $stmt = $connexion->prepare("SELECT * FROM etudiants WHERE etu_id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() === 1) {
            $student = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            echo "<p>Aucun étudiant trouvé avec cet ID.</p>";
            exit;
        }
    } catch (PDOException $e) {
        echo "<p>Erreur lors de la récupération des données : " . $e->getMessage() . "</p>";
        exit;
    }
} else {
    echo "<p>ID étudiant manquant ou méthode non autorisée.</p>";
    exit;
}

// Afficher le formulaire de mise à jour
?>

<h2>Modifier l'étudiant</h2>
<form method="post" action="">
    <input type="hidden" name="operation" value="update">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($student['etu_id']); ?>">

    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" value="<?php echo htmlspecialchars($student['etu_nom']); ?>" required>

    <label for="prenom">Prénom :</label>
    <input type="text" id="prenom" name="prenom" value="<?php echo htmlspecialchars($student['etu_prenom']); ?>" required>

    <label for="date_naissance">Date de naissance :</label>
    <input type="date" id="date_naissance" name="date_naissance" value="<?php echo htmlspecialchars($student['etu_date_naissance']); ?>" required>

    <button type="submit">Mettre à jour</button>
</form>

<?php
// Traitement de la mise à jour lors de la soumission du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['operation']) && $_POST['operation'] === 'update') {
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $date_naissance = $_POST['date_naissance'];

    try {
        $stmt = $connexion->prepare("UPDATE etudiants SET etu_nom = :nom, etu_prenom = :prenom, etu_date_naissance = :date_naissance WHERE etu_id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':date_naissance', $date_naissance);
        $stmt->execute();

        echo "<p>Étudiant mis à jour avec succès.</p>";
        echo "<a href='main.php'>Retour à la liste des étudiants</a>";
    } catch (PDOException $e) {
        echo "<p>Erreur lors de la mise à jour : " . $e->getMessage() . "</p>";
    }
}
?>
