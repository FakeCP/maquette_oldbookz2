<?php 
// CONFIG 1ER CAR SESSION_START()
include '../config/config.php';
if (!isConnect()){
    header('location:' . URL_ADMIN . 'login.php');
    die; 
}
include PATH_ADMIN . 'config/bdd.php';

if (isset($_POST['btn_update_book'])){
        /**
     * Traitement des données du formulaire
     * 1) sécuriser les données en entrée
     * 2) validation des donées
     * 3) traitement de l'illustration (si l'utilisateur a changer d'illustration seulement)
     *      3.1) vérification du type de fichier
     *      3.2) vérification de la taille du fichier
     *      3.3) déplacement du fichier
     *      3.4) vérification du deplacement
     */

     /**
      * INTERACTION AVEC LA BDD
      * 1) Créer la requete SQL sous forme de chaine de caractères
      * 2) Préparer la requete si elles contient des données extérieur (sinon un query)
      * 3) Créer un tableau avec les données si la requete est envoyer avec prepare()
      * 4) Executer la requete (si prepare() est utiliser)
      * 5) Récuperer les données au format désirer avec un fetch(PDO::FETCH_ASSOC) ou fetchAll(PDO::FETCH_ASSOC)
      */
    $id = intval($_POST['id']);
    if ($id <= 0) {
        // erreur
        header('location:index.php');
        die;
    }
    $num_isbn = htmlentities($_POST['num_ISBN']);
    $titre = htmlentities($_POST['titre']);
    $resume = htmlentities($_POST['resume']);
    $prix = htmlentities($_POST['prix']);
    $nb_pages = htmlentities($_POST['nb_pages']);
    $disponibilite = htmlentities($_POST['disponibilite']);
    $date_achat = date_create($_POST['date_achat']);
    $date_achat = $date_achat->format('Y-m-d');
    $categories = $_POST['categorie'];
    // pour la modification on doit vérifier si l'utilisateur a ajouter une illustration, si il n'as pas changer l'image on doit garder l'ancien nom
    if (!empty($_FILES['illustration']['name'])){
        
        // si l'utilisateur souhaite changer l'illustration
        // on enregistre le nom de l'illustration
        $illustration = $_FILES['illustration']['name'];
        // on recupere le nom de l'illustration actuelle sauvegarder en bdd grace a une requete
        $sql = 'SELECT illustration FROM livre WHERE id = ?';
        $req = $bdd->prepare($sql);
        $req->execute([$id]);
        $hold_illustration = $req->fetch(PDO::FETCH_ASSOC);
        $hold_illustration = $hold_illustration['illustration'];
        $chemin_hold_illustration = PATH_ADMIN . 'images/' . $hold_illustration;
        // GESTION DE L'ANCIENNE ILLUSTRATION
        if (!is_file($chemin_hold_illustration)){
            // erreur le fichier enregistrer n'existe pas dans le dossier
            header('location:update.php?id=' . $id);
            die;
        }else{
            // si il existe alors on supprime l'ancienne illustration
            if (!unlink($chemin_hold_illustration)){
                // erreur dans la suppresion de l'illustration
                header('location:update.php?id=' . $id);
                die;
            }
        }
        // GESTION DE LA NOUVELLE ILLUSTRATION
        // on enregistre l'endroit ou est le fichier a récuperer
        $temp_file  = $_FILES['illustration']['tmp_name'];
        // on enregistre l'endroit de destination
        $dest_file  = PATH_ADMIN . 'images/' . $illustration;
        // var_dump($temp_file, $dest_file);
        if (!move_uploaded_file($dossier_temporaire, $dossier_destination)){
            // erreur le document n'as pas était correctement déplacé
            $_SESSION['error_update_illustration'] = true;
            header('location:add.php');
            die;
        }
        $sql = 'UPDATE livre SET num_ISBN = :num_isbn, titre = :titre, illustration = :illustration, resume = :resume, prix = :prix, nb_pages = :nb_pages, date_achat = :date_achat WHERE id = :id';
        $data = [
            ':num_isbn' => $num_isbn,
            ':titre' => $titre,
            ':illustration' => $illustration,
            ':resume' => $resume,
            ':prix' => $prix,
            ':nb_pages' => $nb_pages,
            ':date_achat' => $date_achat,
            ':id' => $id
        ];
    }else{
        $sql = 'UPDATE livre SET num_ISBN = :num_isbn, titre = :titre, resume = :resume, prix = :prix, nb_pages = :nb_pages, date_achat = :date_achat WHERE id = :id';
        $data = [
            ':num_isbn' => $num_isbn,
            ':titre' => $titre,
            ':resume' => $resume,
            ':prix' => $prix,
            ':nb_pages' => $nb_pages,
            ':date_achat' => $date_achat,
            ':id' => $id
        ];
    }
    $requete = $bdd->prepare($sql);
    if (!$requete->execute($data)){
        $_SESSION['error_update_livre'] = true;
        $_SESSION['error_form'] = $_POST;
        header('location:update.php?id='.$id);
        die;
    }

    // TRAITEMENT DES CATEGORIES
    $sql = "DELETE FROM categorie_livre WHERE id_livre = ?";
    $req = $bdd->prepare($sql);
    if (!$req->execute([$id])) {
        // erreur dans la suppr en bdd
        header('location:update.php?id='.$id);
        die;
    }
    foreach ($categories as $id_categorie) {
        $sql = "INSERT INTO categorie_livre VALUES (:id_categorie, :id_livre)";
        $data = [
            ':id_categorie' => $id_categorie,
            ':id_livre' => $id
        ];
        $req = $bdd->prepare($sql);
        if (!$req->execute($data)){
            // erreur
            header('location:update.php?id='.$id);
            die;
        }
    }
    $_SESSION['error_update_livre'] = false;
    header('location:index.php');
    die;
}

if (isset($_POST['btn_add_book'])){
    /**
     * Traitement des données du formulaire
     * 1) sécuriser les données en entrée
     * 2) validation des donées
     * 3) traitement de l'illustration
     *      3.1) vérification du type de fichier
     *      3.2) vérification de la taille du fichier
     *      3.3) déplacement du fichier
     *      3.4) vérification du deplacement
    */
    $num_isbn = htmlentities($_POST['num_ISBN']);
    $titre = htmlentities($_POST['titre']);
    $resume = $_POST['resume'];
    $prix = htmlentities($_POST['prix']);
    $nb_pages = htmlentities($_POST['nb_pages']);
    $date_achat = htmlentities($_POST['date_achat']);
    $illustration = $_FILES['illustration']['name'];

    // GESTION DE L'ILLUSTRATION
    // on enregistre l'endroit ou est le fichier a récuperer
    $dossier_temporaire  = $_FILES['illustration']['tmp_name'];
    // on enregistre l'endroit de destination
    $dossier_destination  = PATH_ADMIN . 'images/' . $illustration;
    if (!move_uploaded_file($dossier_temporaire, $dossier_destination)){
        // erreur le document n'as pas était correctement déplacé
        $_SESSION['error_illustration'] = true;
        header('location:add.php');
        die;
    }
     /**
      * INTERACTION AVEC LA BDD
      * 1) Créer la requete SQL sous forme de chaine de caractères
      * 2) Préparer la requete si elles contient des données extérieur (sinon un query)
      * 2.1) Créer un tableau avec les données si la requete est envoyer avec prepare()
      * 2.2) Executer la requete avec le tableau de données en parametre (si prepare() est utiliser)
      * 5) Récuperer les données au format désirer avec un fetch(PDO::FETCH_ASSOC) ou fetchAll(PDO::FETCH_ASSOC)
    */
    $sql = 'INSERT INTO livre VALUES (NULL, :num_isbn, :titre, :illustration, :resume, :prix, :nb_pages, :date_achat, 0)';
    $requete = $bdd->prepare($sql);
    $data = [
        ':num_isbn' => $num_isbn,
        ':titre' => $titre,
        ':illustration' => $illustration,
        ':resume' => $resume,
        ':prix' => $prix,
        ':nb_pages' => $nb_pages,
        ':date_achat' => $date_achat
    ];
    if (!$requete->execute($data)){
        // erreur dans l'ajout
        $_SESSION['error_add_livre'] = false;
        header('location:add.php');
        die;
    }
    // GESTION CATEGORIES
    // recup les id cat, + id livre
    $id_livre = $bdd->lastInsertId();
    foreach ($_POST['categorie'] as $id_categorie) {
        $sql = 'INSERT INTO categorie_livre VALUES (:id_categorie, :id_livre)';
        $req = $bdd->prepare($sql);
        $data = [
            ':id_categorie' => $id_categorie,
            ':id_livre' => $id_livre
        ];
        if (!$req->execute($data)){
            // erreur
            header('location:add.php');
            die;
        }
    }
    $_SESSION['error_add_livre'] = false;
    header('location:index.php');
    die;
}

if (isset($_GET['id'])){
    $id = intval($_GET['id']);
    if ($id <= 0){
        // erreur ID incorrect
        $_SESSION['error_delete_livre'] = true;
        header('location:index.php');
        die;
    }
    // pour supprimer un livre on doit gerer son illustration
    // on recupere le nom de l'illustration a supprimer
    $sql = "SELECT illustration FROM livre WHERE id = ?";
    $req = $bdd->prepare($sql);
    $req->execute([$id]);
    $nom_illustration = $req->fetch(PDO::FETCH_ASSOC);
    // on stock le nom de l'image apres avoir recuperer l'information en bdd
    $nom_illustration = $nom_illustration['illustration'];
    // on vérifie que l'image existe
    $chemin_illustration = PATH_ADMIN . 'img/illustration/' . $nom_illustration;
    if (!is_file($chemin_illustration)){
       // erreur l'illustration n'existe pas
       $_SESSION['error_delete_illustration'] = true;
       header('location:index.php'); 
       die;
    }
    if (!unlink($chemin_illustration)){
        // erreur l'illustration n'est pas supprimer
        $_SESSION['error_delete_illustration'] = true;
        header('location:index.php');
        die;
    }
    // on supprime le livre en BDD
    $sql = "DELETE FROM livre WHERE id = ?";
    $req = $bdd->prepare($sql);
    if (!$req->execute([$id])){
        // erreur le livre n'est pas supprimer
        $_SESSION['error_delete_livre'] = true;
        header('location:index.php');
        die;
    }
    $_SESSION['error_delete_livre'] = false;
    // le livre est bien supprimer
    header('location:index.php');
    die;
}
