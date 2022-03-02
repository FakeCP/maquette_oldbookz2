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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

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
                        if (isset($_SESSION['error_illustration']) && $_SESSION['error_illustration'] == true){
                            alert('danger', 'L\'illustration n\'est pas correctement déplacer ou n\'est pas valide');
                            unset($_SESSION['error_illustration']);
                        }
                        if (isset($_SESSION['error_add_livre']) && $_SESSION['error_add_livre'] == true){
                            alert('danger', 'Le livre n\'a pas été ajouté correctement');
                            unset($_SESSION['error_add_livre']);
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

            <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
            <script src="//cdn.ckeditor.com/4.17.2/standard/ckeditor.js"></script>
            <script>
                $('.select-cat').select2();
                CKEDITOR.replace('resume');
            </script>

</body>

</html>