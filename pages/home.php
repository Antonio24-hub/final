<?php
require_once '../inc/fonction.php';
require_once '../inc/connexion.php';
$connect = dbconnect();

$resultat = listerObjetsAvecEmprunt($connect);

if (!$resultat) {
    echo "Erreur lors de la récupération des objets.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <main>
        <header>
            <h1 class="mb-4 text-center text-primary">Liste des objets</h1>
        </header>
<table>
    <tr>
        <th>ID</th>
        <th>Objet</th>
        <th>Catégorie</th>
        <th>Propriétaire</th>
        <th>Date d’emprunt</th>
        <th>Date de retour</th>
        <th>Statut</th>
    </tr>

<?php while ($row = mysqli_fetch_assoc($resultat)): ?>
    <tr>
        <td><?= $row['id_objet'] ?></td>
        <td><?= $row['nom_objet'] ?></td>
        <td><?= $row['nom_categorie'] ?></td>
        <td><?= $row['proprietaire'] ?></td>
        <td><?= $row['date_emprunt'] ?? '-' ?></td>
        <td><?= $row['date_retour'] ?? '-' ?></td>
        <td><?= ($row['date_emprunt'] && (!$row['date_retour'] || $row['date_retour'] >= date('Y-m-d'))) ? "Emprunté" : "Disponible" ?></td>
    </tr>
<?php endwhile; ?>
</table>
</main>
</body>
</html>

