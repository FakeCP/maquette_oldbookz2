<?php

include '../config/config.php';
include '../config/bdd.php';

if (!isConnect()){
    header('location:' . URL_ADMIN . 'login.php');
    die; 
}
// ACCESSIBLE SEULEMENT SI ADMINISTRATEUR
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
        $dossier_temporaire = $_FILES['avatar']['tmp_name'];
        $dossier_destination = PATH_ADMIN . 'images/avatar/' . $avatar;

        if (!move_uploaded_file($dossier_temporaire, $dossier_destination)) {
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

        //gestion roles
    //recupérer role utilisateur + id utilisateur
    $id_utilisateur = $bdd->lastInsertId();
    // var_dump($id_utilisateur);
    foreach ($_POST['role'] as $id_role) {
        $sql ='INSERT INTO role_utilisateur VALUES (:id_role, :id_utilisateur)';
        $requete = $bdd->prepare($sql);
        $data = [
            ':id_role' => $id_role,
            ':id_utilisateur' => $id_utilisateur
        ];
        if (!$requete->execute($data)) {
            //erreur
             header('location:add.php');
            die;
        }
    }
        $_SESSION['error_add_utilisateur'] = false;
        header('location:index.php');
        die;

    }

    if(isset($_GET['id'])){
        $id = intval($_GET['id']);
        if ($id <= 0){
            // erreur
            header('location:index.php');
            die;
        }

        /**
         * SUPPRESSION DE l'USER EN BDD
         */
        $sql = "DELETE FROM utilisateur WHERE id = ?";
        $requete = $bdd->prepare($sql);
        if (!$requete->execute([$id])){
            // erreur dans la suppression en bdd
            $_SESSION['error_delete_utilisateur'] = true;
            header('location:index.php');
            die;
    
       /**
        * GESTION DE L'ILLUSTRATION 
         * 1) recuperer le nom de l'avatar user
         * 2) vérifier si il existe dans le dossier
         * 3) le supprimer
        */
        $sql = "SELECT avatar FROM utilisateur WHERE id = ?";
        $requete = $bdd->prepare($sql);
        $requete->execute([$id]);
        $hold_avatar = $requete->fetch(PDO::FETCH_ASSOC);
        $hold_avatar = $hold_avatar['avatar'];
        var_dump($hold_avatar);
        $dossier_avatar = PATH_ADMIN . 'images/avatar/' . $hold_avatar;
        if (!is_file($dossier_avatar)){
            // erreur l'avatar n'existe pas ou plus dans le dossier
            header('location:index.php');
            die;
        }
        if (!unlink($dossier_avatar)){
            // erreur l'avatar est impossible a supprimer
            header('location:index.php');
            die;
        }
        
    }
    
    if (isset($_POST['btn_update_utilisateur'])) {
        $id = intval($_POST['id']);
        if ($id <= 0) {
            header('location:index.php');
        }

        $nom = htmlentities($_POST['nom']);
        $prenom = htmlentities($_POST['prenom']);
        $pseudo = htmlentities($_POST['pseudo']);
        $mail = htmlentities($_POST['mail']);
        // $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);
        $num_telephone = htmlentities($_POST['num_telephone']);
        $adresse = htmlentities($_POST['adresse']);
        $ville = htmlentities($_POST['ville']);
        $code_postal = htmlentities($_POST['code_postal']);
        // $avatar = $_FILES['avatar']['name'];
        $roles = $_POST['role'];

        if(!empty($_FILES['avatar']['name'])){
            //si l'utilisateur souhaite changer l'illustration
            //on enregistre le nom de l'illustration
            $avatar = $_FILES['avatar']['name'];
            $sql = 'SELECT avatar FROM utilisateur WHERE id = ?';
            $requete = $bdd->prepare($sql);
            $requete->execute([$id]);
            $dossier_avatar = $requete->fetch(PDO::FETCH_ASSOC);
            $dossier_avatar = $dossier_avatar['avatar'];
            $chemin_dossier_avatar = PATH_ADMIN . 'images/avatar/' . $dossier_avatar;
            
            //gestion de l'ancienne avatar
            if (!is_file($chemin_dossier_avatar)){
                //erreur le fichier n'existe pas dans le dossier
                header('location:update.php?id=' . $id);
                die;
            }else{
            // si il existe alors on supprime l'ancienne avatar
                if (!unlink($chemin_dossier_avatar)){
                    // erreur dans la suppresion de l'avatar
                    //si il existe alors on supprime l'ancienne avatar
                    header('location:update.php?id=' . $id);
                    die;
                }
            }
    
        $dossier_temporaire = $_FILES['avatar']['tmp_name'];
        $dossier_destination = PATH_ADMIN . 'images/avatar/' . $avatar;
        // if ($_FILES['avatar']['size'] > 20000) {
        //     # code...
        // }
    
        if (!move_uploaded_file($dossier_temporaire, $dossier_destination)) {
            //!-> si cette fonction renvoie faux alors erreur dans le déplacement du fichier
            die('erreur dans le déplacement du fichier');
        }
        // die('ok, bien copier/coller');
    
    
        $sql = 'UPDATE utilisateur SET nom = :nom, prenom = :prenom, pseudo = :pseudo, mail = :mail, num_telephone = :num_telephone, avatar = :avatar, adresse = :adresse, ville = :ville, code_postal = :code_postal WHERE id = :id';
        
    
        $data = [
            ":nom" => $nom,
            ":prenom" => $prenom,
            ":pseudo" => $pseudo,
            ":mail" => $mail,
            // ":mot_de_passe" => $mot_de_passe,
            ":num_telephone" => $num_telephone,
            ":avatar" => $avatar,
            ":adresse" => $adresse,
            ":ville" => $ville,
            ":code_postal" => $code_postal,
            ":id" => $id
        ];
    }else{
        $sql = 'UPDATE utilisateur SET nom = :nom, prenom = :prenom, pseudo = :pseudo, mail = :mail, num_telephone = :num_telephone, adresse = :adresse, ville = :ville, code_postal = :code_postal WHERE id = :id';
    
        $data = [
            ":nom" => $nom,
            ":prenom" => $prenom,
            ":pseudo" => $pseudo,
            ":mail" => $mail,
            // ":mot_de_passe" => $mot_de_passe,
            ":num_telephone" => $num_telephone,
            // ":avatar" => $avatar,
            ":adresse" => $adresse,
            ":ville" => $ville,
            ":code_postal" => $code_postal,
            ":id" => $id
        ];
    
    }
    
        $requete = $bdd->prepare($sql);
        
        if (!$requete->execute($data)) {
            // $requete->errorInfo();
            // var_dump($requete->errorInfo());
            //ou var_dump(debugDumpParams);
            // die;
            $_SESSION['error_update_utilisateur'] = true;
            $_SESSION['error_form'] = $_POST;
            header('location:update.php?id=' . $id);
            die;
        }
    
        //Traitement des roles
        $sql = "DELETE FROM role_utilisateur WHERE id_utilisateur = ? ";
        $requete = $bdd->prepare($sql);
        if(!$requete->execute([$id])){
            //erreur  suppresssion en bdd
            header('location:update.php?=id'. $id);
            die;
        }
        foreach ($roles as $id_role) {
            $sql = "INSERT INTO role_utilisateur VALUES (:id_role, :id_utilisateur)";
            $data = [
                ':id_role' => $id_role,
                ':id_utilisateur' => $id
            ];
            $requete = $bdd->prepare($sql);
            if(!$requete->execute($data)) {
                // erreur
                header('location:update.php?id=' . $id);
                die;
            }
        }
    
            // die('ok');
            $_SESSION['error_update_utilisateur'] = false;
            header('location:index.php');
            die;
        
    
    }
}