<?php
include '../config/config.php';
include '../config/bdd.php';
$sql = 'SELECT * FROM usager';

$requete = $bdd->query($sql);
$usagers = $requete->fetchAll(PDO::FETCH_ASSOC);

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
                        <h1 class="h3 mb-0 text-gray-800">Liste des usagers</h1>
                        <?= count($usagers) ?> clients répertoriés
                    </div>
                    <div class="pb-3">
                    <a href="<?= URL_ADMIN ?>client/add.php" class="btn btn-success">Créer une entrée</a>
                    </div>

                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nom</th>
                                <th scope="col">Prénom</th>
                                <th scope="col">Adresse</th>
                                <th scope="col">Ville</th>
                                <th scope="col">Code postal</th>
                                <th scope="col">Mail</th>
                                <th scope="col">Modifier</th>
                                <th scope="col">Supprimer</th>
                            </tr>

                        </thead>
                        <tbody>

                            <?php foreach ($usagers as $usager) : ?>
                                <tr>
                                    <!-- AFFICHAGE DES CHAMPS -->
                                    <th scope="row"><?= $usager['id'] ?></th>
                                    <td><?= $usager['nom'] ?></td>
                                    <td><?= $usager['prenom'] ?></td>
                                    <td><?= $usager['adresse'] ?></td>
                                    <td><?= $usager['ville'] ?></td>
                                    <td><?= $usager['code_postal'] ?></td>
                                    <td><?= $usager['mail'] ?></td>
                                    <td><a href="<?= URL_ADMIN ?>client/update.php?id=<?= $usager['id'] ?>" class="btn btn-warning">Modifier</a></td>
                                    <td><a href="<?= URL_ADMIN ?>client/action.php?id=<?= $usager['id'] ?>" class="btn btn-danger">Supprimer</a></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            </div>
            <!-- End of Main Content -->

            <?php
            include PATH_ADMIN . 'includes/footer.php';
            ?>

</body>

</html>