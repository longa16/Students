<?php
$host = 'mysql';
$user = 'root';
$mdp = 'ROOT';
$dtb = 'students';


$connect = mysqli_connect($host, $user, $mdp, $dtb);

if ($connect->connect_error) {
    die("unsucsseful connexion : " . $connect->connect_error);
}
?>

