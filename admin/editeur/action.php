<?php
    include '../config/config.php';
    include '../config/bdd.php';


    if (isset($_POST['btn_add_editor'])) {
        //je viens du formulaire add.php
        $denomination = htmlentities($_POST['denomination']);
        $siret = htmlentities($_POST['siret']);
        $adresse = htmlentities($_POST['adresse']);
        $ville = htmlentities($_POST['ville']);
        $code_postal = htmlentities($_POST['code_postal']);
        $mail = htmlentities($_POST['mail']);
        $numero_tel = htmlentities($_POST['numero_tel']);
        

        //traitement de données
        
        //création requête
        $sql = "INSERT INTO editeur VALUES (NULL, :denomination, :siret, :adresse, :ville, :code_postal, :mail, :numero_tel)";
        // var_dump($sql);
        
        $requete = $bdd->prepare($sql);
        // var_dump($requete);
        $data = array
        (':denomination' => $denomination, 
        ':siret' => $siret, 
        ':adresse' => $adresse,
         ':ville' => $ville, 
         ':code_postal' => $code_postal, 
         ':mail' => $mail, 
         ':numero_tel' => $numero_tel,
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
            $_SESSION['error_update_editor'] = false;
             header('location:index.php');
             die;
         }
        else {
            $_SESSION['error_update_editor'] = true;
            header('location:add.php');
            die;
        }

    }
        

    if (isset($_POST['btn_update_editor'])) {
        //protection des donnees envoyees par l'utilisateur
        $id = intval($_POST['id']);
        $denomination = htmlentities($_POST['denomination']);
        $siret = htmlentities($_POST['siret']);
        $adresse = htmlentities($_POST['adresse']);
        $ville = htmlentities($_POST['ville']);
        $code_postal = htmlentities($_POST['code_postal']);
        $mail = htmlentities($_POST['mail']);
        $numero_tel = htmlentities($_POST['numero_tel']);

        //requete sql pour la modif
        $sql = 'UPDATE editeur SET denomination = :denomination, siret = :siret, adresse = :adresse, ville = :ville, code_postal = :code_postal, mail = :mail, numero_tel = :numero_tel WHERE id = :id';
        //executer la requete
        $data = array (
            ':denomination' => $denomination,
            ':siret' => $siret,
            ':adresse' => $adresse,
            ':ville' => $ville,
            ':code_postal' => $code_postal,
            ':mail' => $mail,
            ':numero_tel' => $numero_tel,
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
                $sql = 'DELETE FROM editeur WHERE id = :id';
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
    