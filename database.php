<?php
$host = "localhost";
$bdd = "students";
$user = "root";
$pwd = "ROOT";

$connect = mysqli_connect($host, $user, $mdp, $dtb);

if ($connect->connect_error) {
    die("unsucsseful connexion : " . $connect->connect_error);
}
?>

