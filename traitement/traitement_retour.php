<?php
require_once '../inc/connexion.php';
$connect = dbconnect();

$id_objet = $_POST['id_objet'];
$id_membre = $_POST['id_membre'];
$action = $_POST['action'];
$remarque = mysqli_real_escape_string($connect, $_POST['remarque'] ?? '');

if ($action === "confirmer") {
    // Supprime l'emprunt : rendu
    $sql = "DELETE FROM emprunt WHERE id_objet = $id_objet AND id_membre = $id_membre";
    mysqli_query($connect, $sql);
    header("Location: ../pages/membre.php?retour=confirme");
    exit;
} elseif ($action === "abime") {
    // Supprime aussi, mais tu peux archiver ou noter abîmé ailleurs
    $sql = "DELETE FROM emprunt WHERE id_objet = $id_objet AND id_membre = $id_membre";
    mysqli_query($connect, $sql);
    header("Location: ../pages/membre.php?retour=abime");
    exit;
} else {
    echo "Action non reconnue.";
}
