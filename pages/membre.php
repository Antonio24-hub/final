<?php
require_once '../inc/fonction.php';
require_once '../inc/connexion.php';
$connect = dbconnect();
$sql = "
    SELECT m.id_membre, m.nom, m.date_naissance, m.email, m.ville, m.image_profil,
           o.nom_objet, e.date_emprunt, e.date_retour
    FROM membre m
    LEFT JOIN emprunt e ON m.id_membre = e.id_membre
    LEFT JOIN objet o ON e.id_objet = o.id_objet
    ORDER BY m.id_membre
";

$resultat = mysqli_query($connect, $sql);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des membres</title>
    <link rel="stylesheet" href="../assets/css/bootstrap/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <main class="container py-5">
        <h1 class="text-center mb-4 text-primary">Liste des membres</h1>

        <a href="home.php" class="btn btn-secondary mb-4">← Retour à l'accueil</a>

        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Date de naissance</th>
                    <th>Email</th>
                    <th>Ville</th>
                    <th>Image</th>
                    <th>Emprunts</th>

                </tr>
            </thead>
            <tbody>
            <?php
$current_id = null;
while ($row = mysqli_fetch_assoc($resultat)) :
    if ($current_id !== $row['id_membre']) {
        if ($current_id !== null) echo "</ul></td></tr>";
        $current_id = $row['id_membre'];
?>
    <tr>
        <td><?= $row['id_membre'] ?></td>
        <td><?= htmlspecialchars($row['nom']) ?></td>
        <td><?= htmlspecialchars($row['date_naissance']) ?></td>
        <td><?= htmlspecialchars($row['email']) ?></td>
        <td><?= htmlspecialchars($row['ville']) ?></td>
        <td>
            <?php if (!empty($row['image_profil'])) : ?>
                <img src="../images/<?= htmlspecialchars($row['image_profil']) ?>" alt="Profil" width="50" height="50" style="object-fit: cover; border-radius: 50%;">
            <?php else : ?>
                <span class="text-muted">Aucune</span>
            <?php endif; ?>
        </td>
        <td>
            <ul>
<?php
    }
    if ($row['nom_objet']) {
        echo "<li><strong>" . htmlspecialchars($row['nom_objet']) . "</strong> (du " . $row['date_emprunt'] . " au " . $row['date_retour'] . ")</li>";
    }
endwhile;
if ($current_id !== null) echo "</ul></td></tr>";
?>

            </tbody>
        </table>
    </main>
</body>
</html>
