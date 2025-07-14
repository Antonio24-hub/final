<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require("../inc/connexion.php");
$connect = dbconnect();
$uploadDir = "../images/";
$maxSize = 5 * 1024 * 1024; // 5 Mo max
$allowedMimeTypes = ['image/jpeg', 'image/png'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom_objet = $_POST['nom_objet'];
    $id_categorie = $_POST['id_categorie'];
    $id_membre = $_SESSION['id'];

    if (empty($nom_objet) || empty($id_categorie) || !isset($_FILES['image'])) {
        die("Tous les champs sont obligatoires.");
    }

    $file = $_FILES['image'];
    if ($file['error'] !== UPLOAD_ERR_OK) {
        die("Erreur d'upload : " . $file['error']);
    }

    if ($file['size'] > $maxSize) {
        die("Image trop volumineuse.");
    }

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);

    if (!in_array($mime, $allowedMimeTypes)) {
        die("Type de fichier non autorisé.");
    }

    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $nom_image = uniqid('objet_', true) . "." . $extension;

    if (!move_uploaded_file($file['tmp_name'], $uploadDir . $nom_image)) {
        die("Erreur lors du déplacement de l'image.");
    }

    // Insertion de l'objet
    $sql_objet = "INSERT INTO objet (nom_objet, id_categorie, id_membre)
                  VALUES ('$nom_objet', $id_categorie, $id_membre)";
    mysqli_query($connect, $sql_objet) or die("Erreur insertion objet : " . mysqli_error($connect));

    $id_objet = mysqli_insert_id($connect);

    // Insertion de l'image
    $sql_image = "INSERT INTO images_objet (id_objet, nom_image)
                  VALUES ($id_objet, '$nom_image')";
    mysqli_query($connect, $sql_image) or die("Erreur insertion image : " . mysqli_error($connect));

    header("Location: ../pages/home.php");
    exit;
} else {
    echo "Formulaire non soumis.";
}
