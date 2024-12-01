<?php

if(isset($_POST["confirm"])) {
    $pseudo = htmlspecialchars($_POST['email']);
    $password = sha1($_POST['password']);

    echo $pseudo;
    echo $password;

}

