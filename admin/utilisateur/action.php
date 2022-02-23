<?php

include '../config/config.php';
include '../config/bdd.php';

if (!isConnect()){
    header('location:' . URL_ADMIN . 'login.php');
    die; 
}
// ACCESIBLE SEULEMENT SI ADMINISTRATEUR
if (!isAdmin()){
    header('location:' . URL_ADMIN . 'index.php');
    die; 
}

    if (isset($_POST['btn_add_utilisateur'])) {

        $nom = htmlentities($_POST['nom']);
        $prenom = htmlentities($_POST['prenom']);
        $pseudo = htmlentities($_POST['pseudo']);
        $mail = htmlentities($_POST['mail']);
        $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);
        $num_telephone = htmlentities($_POST['num_telephone']);
        $adresse = htmlentities($_POST['adresse']);
        $ville = htmlentities($_POST['ville']);
        $code_postal = htmlentities($_POST['code_postal']);
        $avatar = $_FILES['avatar']['name'];
        $temp_file = $_FILES['avatar']['tmp_name'];
        $dest_file = PATH_ADMIN . 'images/avatar/' . $avatar;

        if (!move_uploaded_file($temp_file, $dest_file)) {
            //erreur dans déplacement du fichier
            die('Erreur dans le déplacement du fichier');
        }

            //gestion de bdd
        $sql = "INSERT INTO utilisateur (id, nom, prenom, pseudo, mail, mot_de_passe, num_telephone, adresse, ville, code_postal, avatar) 
            VALUES (NULL, :nom, :prenom, :pseudo, :mail, :mot_de_passe, :num_telephone, :adresse, :ville, :code_postal, :avatar)";
        $requete = $bdd-> prepare($sql);
        $data = array(
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':pseudo' => $pseudo,
            ':mail' => $mail,
            ':mot_de_passe' => $mot_de_passe,
            ':num_telephone' => $num_telephone,
            ':adresse' => $adresse,
            ':ville' => $ville,
            ':code_postal' => $code_postal,
            ':avatar' => $avatar
        );
        
        if (!$requete->execute($data)) {
            //erreur en bdd
            header('location:add.php');
            die;
        } 
            header('location:index.php');
            die;

    }

    ?>