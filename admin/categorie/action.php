<?php
    include '../config/config.php';
    include '../config/bdd.php';


    if (isset($_POST['btn_add_cat'])) {
        //je viens du formulaire add.php
        $libelle = htmlentities($_POST['libelle']);
        
        
        //traitement de données
        
        //création requête
        $sql = "INSERT INTO categorie VALUES (NULL, :libelle)";
        var_dump($sql);
        
        $requete = $bdd->prepare($sql);
        var_dump($requete);
        $data = array
        ('libelle' => $libelle);
         if ($requete-> execute($data)) {
             header('location:index.php');
             die;
         }
        else {
            header('location:add.php');
            die;
        }
    }

    if (isset($_POST['btn_update_cat'])) {
        //protection des donnees envoyees par l'utilisateur
        $libelle = htmlentities($_POST['libelle']);
        

        //requete sql pour la modif
        $sql = 'UPDATE categorie SET libelle = :libelle';
        //executer la requete
        $data = array (
            ':libelle' => $libelle
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
                $sql = 'DELETE FROM categorie WHERE id = :id';
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
    