<link href="css/inscription.css" rel="stylesheet">


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

// Gestion des inscriptions et notes
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $operation = $_POST['operation'];

    if ($operation === 'inscription') {
        // Inscrire un étudiant à un cours
        $etudiant_id = $_POST['etudiant_id'];
        $cours_id = $_POST['cours_id'];

        try {
            $stmt = $connexion->prepare("INSERT INTO inscription (etu_id, cours_id, note) VALUES (:etudiant_id, :cours_id, 0)");
            $stmt->bindParam(':etudiant_id', $etudiant_id);
            $stmt->bindParam(':cours_id', $cours_id);
            $stmt->execute();
            echo "<p>Étudiant inscrit au cours avec succès.</p>";
        } catch (PDOException $e) {
            echo "<p>Erreur lors de l'inscription : " . $e->getMessage() . "</p>";
        }
    } elseif ($operation === 'ajouter_note') {
        // Ajouter une note pour un étudiant dans un cours
        $etudiant_id = $_POST['etudiant_id'];
        $cours_id = $_POST['cours_id'];
        $note = $_POST['note'];

        try {
            $stmt = $connexion->prepare("UPDATE inscription SET note = :note WHERE etu_id = :etudiant_id AND cours_id = :cours_id");
            $stmt->bindParam(':etudiant_id', $etudiant_id);
            $stmt->bindParam(':cours_id', $cours_id);
            $stmt->bindParam(':note', $note);
            $stmt->execute();
            echo "<p>Note ajoutée avec succès.</p>";
        } catch (PDOException $e) {
            echo "<p>Erreur lors de l'ajout de la note : " . $e->getMessage() . "</p>";
        }
    } elseif ($operation === 'calculer_moyenne') {
        // Calculer la moyenne des notes pour un étudiant
        $etudiant_id = $_POST['etudiant_id'];

        try {
            $stmt = $connexion->prepare("SELECT AVG(note) AS moyenne FROM inscription WHERE etu_id = :etudiant_id AND note IS NOT NULL");
            $stmt->bindParam(':etudiant_id', $etudiant_id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $moyenne = $result['moyenne'];
            echo "<p>La moyenne de l'étudiant est : " . ($moyenne ? number_format($moyenne, 2) : "Etudiant introuvable") . ".</p>";
        } catch (PDOException $e) {
            echo "<p>Erreur lors du calcul de la moyenne : " . $e->getMessage() . "</p>";
        }
    }
}
?>

<a href="inscriretudiant.php">inscrire un etudiant à un cours</a>
<a href="ajouternote.php">Attribuer une note</a>


<h2>Calculer la moyenne</h2>
<form method="post">
    <input type="hidden" name="operation" value="calculer_moyenne">
    <label for="etudiant_id">ID Étudiant :</label>
    <input type="number" id="etudiant_id" name="etudiant_id" required>
    <button type="submit">Calculer</button>
</form>


<h2>Liste des cours, des étudiants inscrits et leurs notes</h2>
<?php
try {
    $stmt = $connexion->query("
        SELECT 
            cours.cours_id, 
            cours.cours_intitulé, 
            etudiants.etu_id, 
            etudiants.etu_nom, 
            etudiants.etu_prenom, 
            inscription.note
        FROM inscription
        INNER JOIN cours ON inscription.cours_id = cours.cours_id
        INNER JOIN etudiants ON inscription.etu_id = etudiants.etu_id
        ORDER BY cours.cours_id, etudiants.etu_nom
    ");

    echo "<table border='1'>";
    echo "<tr><th>ID Cours</th><th>Intitulé</th><th>ID Étudiant</th><th>Nom Étudiant</th><th>Prénom Étudiant</th><th>Note</th></tr>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['cours_id']) . "</td>";
        echo "<td>" . htmlspecialchars($row['cours_intitulé']) . "</td>";
        echo "<td>" . htmlspecialchars($row['etu_id']) . "</td>";
        echo "<td>" . htmlspecialchars($row['etu_nom']) . "</td>";
        echo "<td>" . htmlspecialchars($row['etu_prenom']) . "</td>";
        echo "<td>" . (isset($row['note']) ? htmlspecialchars($row['note']) : "Non noté") . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} catch (PDOException $e) {
    echo "<p>Erreur lors de la récupération des inscriptions : " . $e->getMessage() . "</p>";
}
?>
<a href="main.php"><button>Vers les étudiants </button></a>
