
<?php
include("../inc/connexion.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
require_once '../inc/fonction.php';
$connect = dbconnect();
$liste = listerObjetsAvecEmprunt($connect);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des objets</title>
    <style>
        table { border-collapse: collapse; width: 90%; margin: auto; }
        th, td { border: 1px solid #aaa; padding: 8px; text-align: center; }
        th { background-color: #eee; }
    </style>
</head>
<body>
    <h1 style="text-align:center;">Objets et emprunts</h1>

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

        <?php while ($row = mysqli_fetch_assoc($liste)): ?>
            <tr>
                <td><?= $row['id_objet'] ?></td>
                <td><?= $row['nom_objet'] ?></td>
                <td><?= $row['nom_categorie'] ?></td>
                <td><?= $row['proprietaire'] ?></td>
                <td><?= $row['date_emprunt'] ?? '-' ?></td>
                <td><?= $row['date_retour'] ?? '-' ?></td>
                <td>
                    <?php
                    if ($row['date_emprunt'] && (!$row['date_retour'] || $row['date_retour'] >= date('Y-m-d'))) {
                        echo "Emprunté";
                    } else {
                        echo "Disponible";
                    }
                    ?>
                </td>
            </tr>
        <?php endwhile; ?>

    </table>
</body>
</html>

</body>
</html>