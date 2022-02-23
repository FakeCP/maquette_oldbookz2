<?php
include '../config/config.php';
include '../config/bdd.php'
?>

<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

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
                        <h1 class="h3 mb-0 text-gray-800">Ajouter un livre</h1>

                    </div>

                </div>

                <?php
                        if (isset($_SESSION['error_update_book']) && ($_SESSION['error_update_book'] == true)) {
                            alert('danger', 'Erreur de saisie : livre non-ajouté à la base de données');
                            unset($_SESSION['error_update_book']);
                        }

                        ?>

                <form action="action.php" method="POST" enctype="multipart/form-data">

                    <div class="container">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Numéro ISBN</label>
                            <input type="text" name="num_ISBN" class="form-control" id="exampleFormControlInput1">
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Titre</label>
                            <input type="text" name="titre" class="form-control" id="exampleFormControlInput1">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Illustration</label>
                            <input type="file" name="illustration" class="form-control" id="exampleFormControlInput1">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Résumé</label>
                            <textarea type="form-control" name="resume" class="form-control" id="exampleFormControlInput1"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Prix</label>
                            <input type="text" name="prix" class="form-control" id="exampleFormControlInput1">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Nombre de pages</label>
                            <input type="text" name="nb_pages" class="form-control" id="exampleFormControlInput1">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Date d'achat</label>
                            <input type="date" name="date_achat" class="form-control" id="exampleFormControlInput1" placeholder="aaaa-mm-dd hh:mm:ss">
                        </div>
                        <div class="mb-3 text-center">
                            <label for="exampleFormControlInput1" class="form-label"></label>
                            <input type="submit" name="btn_add_book" class="btn btn-primary">
                            <a href="<?= URL_ADMIN ?>livres/index.php" class="btn btn-warning">Annuler</a>
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