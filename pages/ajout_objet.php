<?php
session_start();
if (!isset($_SESSION['id'])) {
    die("Vous devez être connecté pour accéder à cette page.");
}

$id_membre = $_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="../assets/css/bootstrap/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container d-flex justify-content-center align-items-center mt-4">
            <form action="../traitement/traitement_ajout_objet.php" method="post" enctype="multipart/form-data" class="mb-5">
                <div class="mb-3">
                    <label for="fichier" class="form-label">Choisir un fichier :</label>
                    <input type="file" class="form-control" name="fichier" id="fichier" required>
                </div>
                <button type="submit" class="btn btn-primary"><i class="bi bi-upload"></i> Uploader</button>
            </form>
        </div>
    </body>
</html>