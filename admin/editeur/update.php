<?php 
include '../config/config.php';
include '../config/bdd.php';

if (isset($_SESSION['error_update_editor']) && ($_SESSION['error_update_editor'] == true )) {
                        alert('danger', 'Editeur non ajouté');
                        unset($_SESSION['error_update_editeur']);
                    }

        //modifier une prise de contact
            if (isset($_GET['id'])) {
                $id = intval($_GET['id']);
                if ($id > 0) {
                    //requete sql pour recuperer le contact en bdd
                $sql = "SELECT * FROM editeur WHERE id = ?";
//executer la requete
                $requete = $bdd-> prepare($sql);
                $requete -> execute(array($id));
//recuperer les infos
                $editeurs = $requete->fetch(PDO::FETCH_ASSOC);
                } else {
                    header('location:index.php');
                    die;
                }
            }


                        ?>


<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Modifier un éditeur</title>

    <!-- Custom fonts for this template-->
    <link href="<?= URL_ADMIN ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= URL_ADMIN ?>css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php
        include PATH_ADMIN . 'includes/sidebar.php';
        ?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php
                include PATH_ADMIN . 'includes/topbar.php';
                ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Modifier un éditeur</h1>

                    </div>

                </div>

                <?php
                        if (isset($_SESSION['error_update_editor']) && ($_SESSION['error_update_editor'] == true)) {
                            alert('danger', 'Erreur de saisie : Editeur non-ajouté à la base de données');
                            unset($_SESSION['editor_update_editor']);
                        }

                        ?>

                <form action="action.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $editeurs['id'] ?>">
                    <div class="container">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Dénomination</label>
                            <input type="text" name="denomination" class="form-control" id="exampleFormControlInput1" value="<?= $editeurs['denomination']?>">
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">SIRET</label>
                            <input type="text" name="siret" class="form-control" id="exampleFormControlInput1" value="<?= $editeurs['siret']?>">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Adresse</label>
                            <input type="text" name="adresse" class="form-control" id="exampleFormControlInput1" value="<?= $editeurs['adresse']?>">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Ville</label>
                            <input type="text" name="ville" class="form-control" id="exampleFormControlInput1" value="<?= $editeurs['ville']?>">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Code Postal</label>
                            <input type="text" name="code_postal" class="form-control" id="exampleFormControlInput1" value="<?= $editeurs['code_postal']?>">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Mail</label>
                            <input type="text" name="mail" class="form-control" id="exampleFormControlInput1" value="<?= $editeurs['mail']?>">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Numéro de tel</label>
                            <input type="text" name="numero_tel" class="form-control" id="exampleFormControlInput1" value="<?= $editeurs['numero_tel']?>">
                        </div>
                        <div class="mb-3 text-center">
                            <label for="exampleFormControlInput1" class="form-label"></label>
                            <input type="submit" name="btn_update_editor" class="btn btn-primary" value="Enregistrer">
                            <a href="<?= URL_ADMIN ?>editeur/index.php" class="btn btn-warning">Annuler</a>
                        </div>
                    </div>

                </form>

            </div>
            <!-- End of Main Content -->

            <?php
            include PATH_ADMIN . 'includes/footer.php';
            ?>

</body>

</html>
