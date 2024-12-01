<?php
// Démarrer la session avant tout autre contenu
session_start();

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

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupération des données du formulaire
    $username = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    echo $username;
    echo $password;

      
    if (!empty($username) && !empty($password)) {
        try {
            // Préparer la requête SQL pour éviter les injections
            $stmt = $connexion->prepare("SELECT * FROM user WHERE user_pseudo = :username");
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();

            if ($stmt->rowCount() === 1) {
                // Récupérer les informations de l'utilisateur
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if (sha1($password) == $row['user_mdp']) {
                    // Informations de connexion valides
                    $_SESSION['email'] = $username;
                    header("Location: ../main.php");
                    exit;
                } else {
                    // Mot de passe incorrect
                    echo "<p>Votre mot de passe est incorrect. <a href='../connect.php'>Réessayez</a></p>";
                }
            } else {
                // Aucun utilisateur trouvé avec ce pseudo
                echo "<p>Votre nom d'utilisateur/email est incorrect. <a href='../connect.php'>Réessayez</a></p>";
            }
        } catch (PDOException $e) {
            echo "<p>Une erreur est survenue : " . $e->getMessage() . "</p>";
        }
    } else {
        echo "<p>Veuillez remplir tous les champs. <a href='../connect.php'>Réessayez</a></p>";
    }
} else {
    echo "<p>Méthode non autorisée.</p>";
}
?> 