<?php
$host = "localhost";
$bdd = "Students";
$user = "root";
$pwd = "ROOT";

try {
    $connexion = new PDO("mysql:host=$host;dbname=$bdd", $user, $pwd);
} catch (Exception $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

echo "hello world";

