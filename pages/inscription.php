<?php
    require("../inc/fonction.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FAKEBOOK</title>
        <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
        <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <header>
            <h1>Inscrption</h1>
        </header>
        <main>
            <div class="container inscription d-flex justify-content-center align-items-center flex-column">
                <form action="../traitement/traitement_inscription.php" method="post">
                    <p>Nom : <input type="text" name="nom"></p>
                    <p>Date de naissance : <input type="date" name="date_naissance"></p>
                    <?php if(isset($_GET['error'])) { ?>
                        <p class="error">Votre email a déjà été utilisé</p>
                    <?php } ?>
                    <p>Email : <input type="text" name="email"></p>
                    <p>Mot de passe : <input type="password" name="mdp"></p>
                    <?php if(isset($_GET['errormdp'])) { ?>
                        <p>Veillez confirmer votre mot de passe</p>
                    <?php } ?>
                    <p>Confirmer mot de passe : <input type="password" name="mdpbis"></p>
                    <p><input type="submit" value="S'inscrire" class="btn btn-success"></p>
                </form>
                <p>Vous avez déjà un compte ? <a href="index.php" class="inscri text-primary">Se connecter</a></p>
            </div>
        </main>
    </body>
</html>