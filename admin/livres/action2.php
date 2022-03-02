<?php
include '../config/config.php';
include '../config/bdd.php';

if (!isConnect()) {
    header('location:' . URL_ADMIN . 'login.php');
    die;
}
// ACCESIBLE SEULEMENT SI ADMINISTRATEUR

if (isset($_POST['btn_add_book'])) {
    // var_dump($_POST, $_FILES);
    // die;
    //je viens du formulaire add.php
    $num_ISBN = htmlentities($_POST['num_ISBN']);
    $titre = htmlentities($_POST['titre']);
    $illustration = htmlentities($_FILES['illustration']['name']);
    $resume = htmlentities($_POST['resume']);
    // $prix = doubleval($_POST['prix']);
    $prix = $_POST['prix'];
    $nb_pages = intval($_POST['nb_pages']);
    $date_achat = htmlentities($_POST['date_achat']);
    $disponibilite = 0;

    //traitement de données

    //création requête
    $sql = "INSERT INTO livre VALUES (NULL, :num_ISBN, :titre, :illustration, :resume, :prix, :nb_pages, :date_achat, :disponibilite)";
    var_dump($sql);

    $requete = $bdd->prepare($sql);
    var_dump($requete);
    $data = array(
        ':num_ISBN' => $num_ISBN,
        ':titre' => $titre,
        ':illustration' => $illustration,
        ':resume' => $resume,
        ':prix' => $prix,
        ':nb_pages' => $nb_pages,
        ':date_achat' => $date_achat,
        ':disponibilite' => $disponibilite,
    );
    if ($requete->execute($data)) {
        $_SESSION['error_update_book'] = false;
        header('location:index.php');
        die;
    } else {
        $_SESSION['error_update_book'] = true;
        header('location:add.php');
        die;
    }
}

if (isset($_POST['btn_update_book'])) {
    //protection des donnees envoyees par l'utilisateur
    $id = intval($_POST['id']);
    $num_ISBN = htmlentities($_POST['num_ISBN']);
    $titre = htmlentities($_POST['titre']);
    $illustration = htmlentities($_FILES['illustration']['name']);
    $resume = htmlentities($_POST['resume']);
    // $prix = doubleval($_POST['prix']);
    $prix = $_POST['prix'];
    $nb_pages = intval($_POST['nb_pages']);
    $date_achat = htmlentities($_POST['date_achat']);

    //requete sql pour la modif
    $sql = 'UPDATE livre SET num_ISBN = :num_ISBN, titre = :titre, illustration = :illustration, resume = :resume, prix = :prix, nb_pages = :nb_pages, date_achat = :date_achat WHERE id = :id';
    //executer la requete
    $data = array(
        ':num_ISBN' => $num_ISBN,
        ':titre' => $titre,
        ':illustration' => $illustration,
        ':resume' => $resume,
        ':prix' => $prix,
        ':nb_pages' => $nb_pages,
        ':date_achat' => $date_achat,
        ':id' => $id
    );

    $requete = $bdd->prepare($sql);


    //verif si update est ok
    if (!$requete->execute($data)) {
        //erreur dans la modif
        header('location:update.php?id=' . $id);
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
        $sql = 'DELETE FROM livre WHERE id = :id';
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

// pour la modification on doit vérifier si l'utilisateur a ajouté une illustration, si il n'as pas changé l'image on doit garder l'ancien nom
if (!empty($_FILES['illustration']['name'])) {
    // si l'utilisateur souhaite changer l'illustration
    // on enregistre le nom de l'illustration
    $illustration = $_FILES['illustration']['name'];
    // on recupere le nom de l'illustration actuelle sauvegardée en bdd grace a une requete
    $sql = 'SELECT illustration FROM livre WHERE id = ?';
    $req = $bdd->prepare($sql);
    $req->execute([$id]);
    $hold_illustration = $req->fetch(PDO::FETCH_ASSOC);
    $hold_illustration = $hold_illustration['illustration'];
    $chemin_hold_illustration = PATH_ADMIN . 'images/' . $hold_illustration;
}

// GESTION DE L'ANCIENNE ILLUSTRATION
if (!is_file($chemin_hold_illustration)) {
    // erreur le fichier enregistré n'existe pas dans le dossier
    header('location:update.php?id=' . $id);
    die;
} else {
    // si il existe alors on supprime l'ancienne illustration
    if (!unlink($chemin_hold_illustration)) {
        // erreur dans la suppresion de l'illustration
        header('location:update.php?id=' . $id);
        die;
    }
}
