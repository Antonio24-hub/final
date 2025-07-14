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
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Objets disponibles ou empruntés</title>
    <link rel="stylesheet" href="../assets/css/bootstrap/css/bootstrap.min.css">
</head>
<body class="bg-light">
<main class="container py-5">
    <header>
        <h1 class="mb-4 text-center text-primary">Objets disponibles ou empruntés</h1>
    </header>
    
    <section class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <?php while ($row = mysqli_fetch_assoc($resultat)) : ?>
            <article class="col">
                <div class="card h-100 shadow-sm">
                    <?php 
                        // Image selon l'id_objet
                        $img_path = "../images/" . $row["id_objet"] . ".jpg";
                        if (file_exists($img_path)) : ?>
                            <img src="<?php echo $img_path; ?>" class="card-img-top" alt="Photo de l'objet" style="height: 400px; object-fit: cover;">
                        <?php else : ?>
                            <img src="../images/placeholder.jpg" class="card-img-top" alt="Image non disponible" style="height: 200px; object-fit: cover;">
                        <?php endif; ?>
                    
                    <section class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($row["nom_objet"]); ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted"><?php echo htmlspecialchars($row["nom_categorie"]); ?></h6>
                        <p class="card-text">
                            <strong>Propriétaire :</strong> <?php echo htmlspecialchars($row["proprietaire"]); ?><br>
                            <strong>État :</strong> 
                            <?php
                                $statut = ($row["date_emprunt"] && (!$row["date_retour"] || $row["date_retour"] >= date('Y-m-d'))) ? "Emprunté" : "Disponible";
                                echo $statut;
                            ?>
                            <?php if ($row["date_retour"]) : ?>
                                <br><strong>Retour prévu :</strong> <?php echo $row["date_retour"]; ?>
                            <?php endif; ?>
                        </p>
                        <a href="#" class="btn btn-outline-primary">Voir détails</a>
                    </section>
                </div>
            </article>
        <?php endwhile; ?>
    </section>
</main>

<script src="../assets/css/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
