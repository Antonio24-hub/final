<?php
require_once '../inc/connexion.php';

function getIdLoged($email){
    $donnee = get_loged_membre($email);
    $idMembre = $donnee['IdMembre'];
    return $idMembre;
}
function get_loged_membre($email){
    $sql = "SELECT * FROM membre WHERE email = '%s'";
    $sql = sprintf($sql, $email);
    $result = mysqli_query(dbconnect(), $sql);
    if ($result) {
        return mysqli_fetch_assoc($result);
    } else {
        return null;
    }
}
function add_new_member($nom, $ddns, $mdp, $email, $ville){
    $sql = "INSERT INTO membre (nom, date_naissance, email, ville, mdp) VALUES ('%s', '%s', '%s', '%s', '%s')";
    $sql = sprintf($sql, $nom, $ddns, $email, $ville, $mdp);
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

    
    function to_log($email, $mdp){
        $sql = "SELECT * FROM membre WHERE email = '%s' AND mdp = '%s'";
        $sql = sprintf($sql, $email, $mdp);
        $result = mysqli_query(dbconnect(), $sql);

        return mysqli_num_rows($result);
    }
 ?>   