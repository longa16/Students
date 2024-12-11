<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="public/assets/index.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Sign Up</title>
</head>
<body>
<form action="" method="post">
    <div class="row g-3 align-items-center">
        <div class="col-auto">
            <label for="inputEmail" class="col-form-label">Email</label>
            <div class="col-auto">
                <input type="email" id="inputEmail" name="email" class="form-control" aria-describedby="emailHelpInline">
            </div>
        </div>
        <div class="col-auto">
            <label for="inputPassword" class="col-form-label">Password</label>
            <div class="col-auto">
                <input type="password" id="inputPassword" name="password" class="form-control" aria-describedby="passwordHelpInline">
            </div>
        </div>
        <button type="submit" name="confirm" class="btn btn-dark">Valider</button>
    </div>
</form>

<?php
session_start();

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

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupération des données du formulaire
    $username = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

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
                    header("Location: main.php");
                    exit;
                } else {
                    // Mot de passe incorrect
                    echo '<p class="error-message">Votre mot de passe est incorrect.</p>';
                }
            } else {
                // Aucun utilisateur trouvé avec ce pseudo
                echo '<p class="error-message">Votre nom d\'utilisateur/email est incorrect.</p>';
            }
        } catch (PDOException $e) {
            echo '<p class="error-message">Une erreur est survenue : ' . $e->getMessage() . '</p>';
        }
    } else {
        echo '<p class="error-message">Veuillez remplir tous les champs.</p>';
    }
}
?>

</body>
</html>
