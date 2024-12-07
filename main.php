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

// Gestion des opérations CRUD
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $operation = $_POST['operation'];

    if ($operation === 'create') {
        // Créer un étudiant
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $date_naissance = $_POST['date_naissance'];

        try {
            $stmt = $connexion->prepare("INSERT INTO etudiants (etu_nom, etu_prenom, etu_date_naissance ) VALUES (:nom, :prenom, :date_naissance)");
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':date_naissance', $date_naissance);
            $stmt->execute();
            echo "<p>Étudiant ajouté avec succès.</p>";
        } catch (PDOException $e) {
            echo "<p>Erreur lors de l'ajout : " . $e->getMessage() . "</p>";
        }
    } elseif ($operation === 'update') {
        // Mettre à jour un étudiant
        $id = $_POST['id'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $date_naissance = $_POST['date_naissance'];

        try {
            $stmt = $connexion->prepare("UPDATE etudiants SET etu_nom = :nom, etu_prenom = :prenom, etu_date_naissance = :date_naissance WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':date_naissance', $date_naissance);
            $stmt->execute();
            echo "<p>Étudiant mis à jour avec succès.</p>";
        } catch (PDOException $e) {
            echo "<p>Erreur lors de la mise à jour : " . $e->getMessage() . "</p>";
        }
    } elseif ($operation === 'delete') {
        // Supprimer un étudiant
        $id = $_POST['id'];

        try {
            $stmt = $connexion->prepare("DELETE FROM etudiants WHERE etu_id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            echo "<p>Étudiant supprimé avec succès.</p>";
        } catch (PDOException $e) {
            echo "<p>Erreur lors de la suppression : " . $e->getMessage() . "</p>";
        }
    }
}

// Afficher tous les étudiants
try {
    $stmt = $connexion->query("SELECT * FROM etudiants");

    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Nom</th><th>Prénom</th><th>Date de naissance </th><th>Actions</th></tr>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['etu_id']) . "</td>";
        echo "<td>" . htmlspecialchars($row['etu_nom']) . "</td>";
        echo "<td>" . htmlspecialchars($row['etu_prenom']) . "</td>";
        echo "<td>" . htmlspecialchars($row['etu_date_naissance']) . "</td>";
        echo "<td>
                <form method='post' style='display:inline;'>
                    <input type='hidden' name='operation' value='delete'>
                    <input type='hidden' name='id' value='" . htmlspecialchars($row['etu_id']) . "'>
                    <button type='submit' class='rouge' >Supprimer</button>
                </form>
                <form method='post' action='update_form.php' style='display:inline;'>
                    <input type='hidden' name='id' value='" . htmlspecialchars($row['etu_id']) . "'>
                    <button type='submit'>Modifier</button>
                </form>
              </td>";
        echo "</tr>";
    }

    echo "</table>";
} catch (PDOException $e) {
    echo "<p>Erreur lors de la récupération des étudiants : " . $e->getMessage() . "</p>";
}

// Formulaire pour ajouter un étudiant
?>

<h2>Ajouter un étudiant</h2>
<form method="post">
    <input type="hidden" name="operation" value="create">
    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" required>
    <label for="prenom">Prénom :</label>
    <input type="text" id="prenom" name="prenom" required>
    <label for="date_naissance">date_naissance :</label>
    <input type="date" id="date_naissance" name="date_naissance" required>
    <button type="submit">Ajouter</button>
</form>


<?php
// Gestion des opérations CRUD pour les cours
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $operation = $_POST['operation'];

    if ($operation === 'creation') {
        // Créer un cours
        $intitule = $_POST['intitule'];
        $credits = $_POST['credits'];

        try {
            $stmt = $connexion->prepare("INSERT INTO cours (cours_intitulé, cours_credits) VALUES (:intitule, :credits)");
            $stmt->bindParam(':intitule', $intitule);
            $stmt->bindParam(':credits', $credits);
            $stmt->execute();
            echo "<p>Cours ajouté avec succès.</p>";
        } catch (PDOException $e) {
            echo "<p>Erreur lors de l'ajout : " . $e->getMessage() . "</p>";
        }
    } elseif ($operation === 'miseajour') {
        // Mettre à jour un cours
        $id = $_POST['id'];
        $intitule = $_POST['intitule'];
        $credits = $_POST['credits'];

        try {
            $stmt = $connexion->prepare("UPDATE cours SET cours_intitulé = :intitule, cours_credits = :credits WHERE cours_id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':intitule', $intitule);
            $stmt->bindParam(':credits', $credits);
            $stmt->execute();
            echo "<p>Cours mis à jour avec succès.</p>";
        } catch (PDOException $e) {
            echo "<p>Erreur lors de la mise à jour : " . $e->getMessage() . "</p>";
        }
    } elseif ($operation === 'supprimer') {
        // Supprimer un cours
        $id = $_POST['id'];

        try {
            $stmt = $connexion->prepare("DELETE FROM cours WHERE cours_id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            echo "<p>Cours supprimé avec succès.</p>";
        } catch (PDOException $e) {
            echo "<p>Erreur lors de la suppression : " . $e->getMessage() . "</p>";
        }
    }
}

// Afficher tous les cours
try {
    $stmt = $connexion->query("SELECT * FROM cours");

    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Intitulé</th><th>Crédits</th><th>Actions</th></tr>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['cours_id']) . "</td>";
        echo "<td>" . htmlspecialchars($row['cours_intitulé']) . "</td>";
        echo "<td>" . htmlspecialchars($row['cours_credits']) . "</td>";
        echo "<td>
                <form method='post' style='display:inline;'>
                    <input type='hidden' name='operation' value='supprimer'>
                    <input type='hidden' name='id' value='" . htmlspecialchars($row['cours_id']) . "'>
                    <button type='submit' class='rouge'>Supprimer</button>
                </form>
                <form method='post' action='update_course_form.php' style='display:inline;'>
                    <input type='hidden' name='id' value='" . htmlspecialchars($row['cours_id']) . "'>
                    <button type='submit'>Modifier</button>
                </form>
              </td>";
        echo "</tr>";
    }

    echo "</table>";
} catch (PDOException $e) {
    echo "<p>Erreur lors de la récupération des cours : " . $e->getMessage() . "</p>";
}

// Formulaire pour ajouter un cours
?>

<h2>Ajouter un cours</h2>
<form method="post">
    <input type="hidden" name="operation" value="creation">
    <label for="intitule">Intitulé :</label>
    <input type="text" id="intitule" name="intitule" required>
    <label for="credits">Crédits :</label>
    <input type="number" id="credits" name="credits" required>
    <button type="submit">Ajouter</button>
</form>

<a href="inscription.php"><button>Vers les notes</button></a>

