<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

    session_start();
    include("../inc/connexion.php");
    include("../inc/fonction.php");
    $nom = $_POST['nom'];
    $nom = mysqli_real_escape_string(dbconnect(), $nom);
    $ddns = $_POST['date_naissance']?? NULL;
    $email = $_POST['email'];
    $email = mysqli_real_escape_string(dbconnect(), $email);
    
    if(verify_inscription($email) > 0){
        header('Location: ../pages/index.php?error=0');
        exit;
    }
    $_SESSION['email'] = $email;
    if(verify_password($_POST['mdp'] ,$_POST['mdpbis']) == true){
        $mdp = $_POST['mdp'];
    }
    else{
        header('Location: ../pages/index.php?errormdp=0');
        exit;
    }
    $_SESSION['mdp'] = $mdp;
    add_new_member($email, $mdp, $nom, $ddns);
    header('Location: ../pages/home.php');
?>