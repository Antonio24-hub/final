<?php
require_once '../inc/connexion.php';
require_once '../inc/fonction.php';
require_once '../traitement/traitement_retour.php';

$id_objet = $_POST['id_objet'] ?? null;
$id_membre = $_POST['id_membre'] ?? null;
$nom_objet = $_POST['nom_objet'] ?? 'Inconnu';

if (!$id_objet || !$id_membre) {
    echo "Informations manquantes.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Retour d'objet</title>
    <link rel="stylesheet" href="../assets/css/bootstrap/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="card">
        <div class="card-body">
            <h2>Retour de l'objet : <?= htmlspecialchars($nom_objet) ?></h2>
            <form action="../traitement/traitement_retour.php" method="post">
                <input type="hidden" name="id_objet" value="<?= $id_objet ?>">
                <input type="hidden" name="id_membre" value="<?= $id_membre ?>">

                <div class="mb-3">
                    <label for="remarque" class="form-label">Remarque :</label>
                    <textarea name="remarque" id="remarque" class="form-control"></textarea>
                </div>

                <button type="submit" name="action" value="confirmer" class="btn btn-success">OK (Confirmé)</button>
                <button type="submit" name="action" value="abime" class="btn btn-danger">Abîmé</button>
                <a href="membre.php" class="btn btn-secondary">Annuler</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>
