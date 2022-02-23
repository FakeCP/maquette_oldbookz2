<?php
    include '../config/config.php';
    include '../config/bdd.php';


    if (isset($_POST['btn_add_author'])) {
        //je viens du formulaire add.php
        $nom = htmlentities($_POST['nom']);
        $prenom = htmlentities($_POST['prenom']);
        $nom_de_plume = htmlentities($_POST['nom_de_plume']);
        $adresse = htmlentities($_POST['adresse']);
        $ville = htmlentities($_POST['ville']);
        $code_postal = htmlentities($_POST['code_postal']);
        $mail = htmlentities($_POST['mail']);
        $numero = htmlentities($_POST['numero']);
        $photo = htmlentities($_POST['photo']);
        

        //traitement de données
        
        //création requête
        $sql = "INSERT INTO auteur VALUES (NULL, :nom, :prenom, :nom_de_plume, :adresse, :ville, :code_postal, :mail, :numero, :photo)";
        // var_dump($sql);
        
        $requete = $bdd->prepare($sql);
        // var_dump($requete);
        $data = array
        (':nom' => $nom, 
        ':prenom' => $prenom, 
        ':nom_de_plume' => $nom_de_plume,
        ':adresse' => $adresse,
         ':ville' => $ville, 
         ':code_postal' => $code_postal, 
         ':mail' => $mail, 
         ':numero' => $numero,
         ':photo' => $photo
    );
         if ($requete-> execute($data)) {
             header('location:index.php');
             die;
         }
        else {
            header('location:add.php');
            die;
        }
        if ($requete->execute($data)) {
            $_SESSION['error_update_author'] = false;
             header('location:index.php');
             die;
         }
        else {
            $_SESSION['error_update_author'] = true;
            header('location:add.php');
            die;
    }
}

if (isset($_POST['btn_update_author'])) {
    //protection des donnees envoyees par l'utilisateur
    $id = intval($_POST['id']);
    $nom = htmlentities($_POST['nom']);
    $prenom = htmlentities($_POST['prenom']);
    $nom_de_plume = htmlentities($_POST['nom_de_plume']);
    $adresse = htmlentities($_POST['adresse']);
    $ville = htmlentities($_POST['ville']);
    $code_postal = htmlentities($_POST['code_postal']);
    $mail = htmlentities($_POST['mail']);
    $numero = htmlentities($_POST['numero']);
    $photo = ($_FILES['photo']['name']);

    //requete sql pour la modif
    $sql = 'UPDATE auteur SET nom = :nom, prenom = :prenom, nom_de_plume = :nom_de_plume, adresse = :adresse, ville = :ville, code_postal = :code_postal, mail = :mail, numero = :numero, photo =:photo WHERE id = :id';
    //executer la requete
    $data = array
    (':nom' => $nom, 
    ':prenom' => $prenom, 
    ':nom_de_plume' => $nom_de_plume,
    ':adresse' => $adresse,
     ':ville' => $ville, 
     ':code_postal' => $code_postal, 
     ':mail' => $mail, 
     ':numero' => $numero,
     ':photo' => $photo,
     ':id' => $id
);

    $requete = $bdd->prepare($sql);
    

    //verif si update est ok
    if (!$requete -> execute($data)) {
        //erreur dans la modif
        header('location:update.php?id='. $id);
    } else {
        header('location:index.php');
        die;
    }

}

    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        if ($id > 0) {
            //on peut delete
            //requete sql pour delete
            $sql = 'DELETE FROM auteur WHERE id = :id';
            //execute le requete
            $requete = $bdd->prepare($sql);
            //verif 
            if (!$requete->execute(array(':id' => $id))) {
            //erreur
                header('location:index.php');
                die;
            } else {
                header('location:index.php');
                die;
            }
            
        }
    }
    