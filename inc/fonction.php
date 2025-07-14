<?php
function add_new_member($email, $mdp, $nom, $ddns){
        $sql = "INSERT INTO membre (nom, date_naissance, mdp, ville) VALUES ('%s', '%s', '%s', '%s')";
        $sql = sprintf($sql, $email, $mdp, $nom, $ddns);
        mysqli_query(dbconnect(), $sql);
    }

    function listerObjetsAvecEmprunt($connect) {
        $sql = "
            SELECT o.id_objet, o.nom_objet, c.nom_categorie, m.nom AS proprietaire,
                   e.date_emprunt, e.date_retour
            FROM objet o
            JOIN membre m ON o.id_membre = m.id_membre
            JOIN categorie_objet c ON o.id_categorie = c.id_categorie
            LEFT JOIN emprunt e ON o.id_objet = e.id_objet
            ORDER BY o.id_objet
        ";
    
        $resultat = mysqli_query($connect, $sql);
    
        if (!$resultat) {
            echo "Erreur dans la requête : " . mysqli_error($connect);
            return;
        }
    }
    function verify_inscription($email){
        $sql = "SELECT * FROM membre WHERE email = '%s'";
        $sql = sprintf($sql, $email);
        $result = mysqli_query(dbconnect(), $sql);

        return mysqli_num_rows($result);
    }
    function verify_password($mdp, $mdpbis){
        if($mdp == $mdpbis){
            return true;
        }
        else{
            return false;
        }
    }
 ?>   