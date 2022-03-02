<?php
include '../config/config.php';
include '../config/bdd.php';

if (!isConnect()) {
    header('location:' . URL_ADMIN . 'login.php');
    die;
}
// ACCESIBLE SEULEMENT SI ADMINISTRATEUR
if (!isAdmin()) {
    header('location:' . URL_ADMIN . 'index.php');
    die;
}

$sql = "SELECT * FROM role";
$requete = $bdd->query($sql);
$roles = $requete->fetchAll(PDO::FETCH_ASSOC);
// var_dump($roles);
// die;
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
                        <h1 class="h3 mb-0 text-gray-800">Ajouter un utilisateur</h1>

                    </div>



                </div>

                <form action="action.php" method="POST" enctype="multipart/form-data">

                    <div class="container">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Nom</label>
                            <input type="text" name="nom" class="form-control" id="exampleFormControlInput1">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Prénom</label>
                            <input type="text" name="prenom" class="form-control" id="exampleFormControlInput1">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Pseudo</label>
                            <input type="text" name="pseudo" class="form-control" id="exampleFormControlInput1">
                        </div>
                        <label for="role" class="form-label mt-4">Rôles</label><br>
                        <select class="select-role w-25" name="role[]" id='role' multiple>
                            <?php foreach ($roles as $role) : ?>
                                <?php if (in_array($role['id'], $role_id)) {
                                    //si in-array trouve l'id du role dans le tableau role de mon utilisateur ($role-id)
                                    //ça veut dire que mon utilisateur a bien ce role
                                    $selected = "selected";
                                } else {
                                    $selected = "";
                                    //$selected = "" à l'intérieur car la variable n'a de portée qu'à l'intérieur de la fonction
                                } ?>
                                <option value="<?= $role['id'] ?>" <?= $selected ?>><?= $role['libelle'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <!-- //selected après "php categories id" -->
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Mail</label>
                            <input type="text" name="mail" class="form-control" id="exampleFormControlInput1">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Mot de passe</label>
                            <input type="password" name="mot_de_passe" class="form-control" id="exampleFormControlInput1">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Téléphone</label>
                            <input type="text" name="num_telephone" class="form-control" id="exampleFormControlInput1">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Adresse</label>
                            <input type="text" name="adresse" class="form-control" id="exampleFormControlInput1">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Ville</label>
                            <input type="text" name="ville" class="form-control" id="exampleFormControlInput1">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Code postal</label>
                            <input type="text" name="code_postal" class="form-control" id="exampleFormControlInput1">
                        </div>
                        <div class="mb-3">
                            <label for="avatar" class="form-label">Avatar</label>
                            <input type="file" name="avatar" class="form-control" id="avatar">
                        </div>
                        <div class="mb-3 text-center">
                            <label for="exampleFormControlInput1" class="form-label"></label>
                            <input type="submit" name="btn_add_utilisateur" class="btn btn-primary">
                            <a href="<?= URL_ADMIN ?>categorie/index.php" class="btn btn-warning">Annuler</a>
                        </div>
                    </div>

                </form>

            </div>
            <!-- End of Main Content -->

            <?php
            include PATH_ADMIN . 'includes/footer.php';
            ?>

            <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
            <script>
                $('.select-role').select2();
            </script>

</body>

</html>