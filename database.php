<?php
$host = "database-1.ctowamwq4uaz.eu-north-1.rds.amazonaws.com";
$bdd = "Student";
$user = "admin";
$pwd = "admin#root123";


$connect = mysqli_connect($host, $user, $mdp, $dtb);

if ($connect->connect_error) {
    die("unsucsseful connexion : " . $connect->connect_error);
}
?>

