<?php
session_start();
require_once '../inc/connexion.php';

$connect = dbconnect();

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    die("Vous devez être connecté pour effectuer un emprunt.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $id_objet = intval($_POST['objet_id']);
    $id_membre = $_SESSION['id'];
    $nb_jours = intval($_POST['nb_jours']);

    
    if ($id_objet <= 0 || $nb_jours <= 0) {
        die("Valeurs invalides.");
    }

    
    $date_emprunt = date('Y-m-d');
    $date_retour = date('Y-m-d', strtotime("+$nb_jours days"));

    $sql = "INSERT INTO emprunt (id_objet, id_membre, date_emprunt, date_retour)
            VALUES ('$id_objet', '$id_membre', '$date_emprunt', '$date_retour')";

    if (mysqli_query($connect, $sql)) {
        header("Location: ../pages/home.php?message=emprunt_reussi");
        exit;
    } else {
        echo "Erreur lors de l'enregistrement : " . mysqli_error($connect);
    }
} else {
    echo "Méthode non autorisée.";
}
?>
