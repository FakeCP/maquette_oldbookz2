<?php
    include '../config/config.php';
    include '../config/bdd.php';


    if (isset($_POST['btn_add_user'])) {
        var_dump($_POST);
        //je viens du formulaire add.php
        $nom = htmlentities($_POST['nom']);
        $prenom = htmlentities($_POST['prenom']);
        $adresse = htmlentities($_POST['adresse']);
        $ville = htmlentities($_POST['ville']);
        $code_postal = htmlentities($_POST['code_postal']);
        $mail = htmlentities($_POST['mail']);
        
        //traitement de données
        
        //création requête
        $sql = "INSERT INTO usager VALUES (NULL, :nom, :prenom, :adresse, :ville, :code_postal, :mail)";
        var_dump($sql);
        
        $requete = $bdd->prepare($sql);
        var_dump($requete);
        $data = array
        ('nom' => $nom, 
        ':prenom' => $prenom, 
        ':adresse' => $adresse,
         ':ville' => $ville, 
         ':code_postal' => $code_postal, 
         ':mail' => $mail, 
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
        $_SESSION['error_update_client'] = false;
         header('location:index.php');
         die;
     }
    else {
        $_SESSION['error_update_client'] = true;
        header('location:add.php');
        die;
    }
}


if (isset($_POST['btn_update_client'])) {
//protection des donnees envoyees par l'utilisateur
$id = intval($_POST['id']);
$nom = htmlentities($_POST['nom']);
$prenom = htmlentities($_POST['prenom']);
$adresse = htmlentities($_POST['adresse']);
$ville = htmlentities($_POST['ville']);
$code_postal = htmlentities($_POST['code_postal']);
$mail = htmlentities($_POST['mail']);

var_dump($_POST);
//requete sql pour la modif
$sql = 'UPDATE usager SET nom = :nom, prenom = :prenom, adresse = :adresse, ville = :ville, code_postal = :code_postal, mail = :mail WHERE id = :id';
var_dump($sql);
//executer la requete
$data = array
(':id' => $id,
':nom' => $nom, 
':prenom' => $prenom, 
':adresse' => $adresse,
 ':ville' => $ville, 
 ':code_postal' => $code_postal, 
 ':mail' => $mail
);
var_dump($data);
$requete = $bdd->prepare($sql);
var_dump($requete);
// die;

// var_dump($requete->execute($data));
// var_dump($requete->errorInfo());
// die;

//verif si update est ok
if (!$requete->execute($data)) {
    //erreur dans la modif
    header('location:update.php?id='. $id);
    die;
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
        $sql = 'DELETE FROM usager WHERE id = :id';
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
