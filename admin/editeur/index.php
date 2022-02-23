<?php
    include '../config/config.php';
    include '../config/bdd.php';

    $sql = 'SELECT * FROM editeur';

$requete = $bdd->query($sql);
$editeurs = $requete->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Editeurs</title>

    <!-- Custom fonts for this template-->
    <link href="<?= URL_ADMIN ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

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
                        <h1 class="h3 mb-0 text-gray-800">Liste des éditeurs</h1>
                        <?= count($editeurs) ?> éditeurs répertoriés
                    </div>
                    <div class="pb-3">
                    <a href="<?= URL_ADMIN ?>editeur/add.php" class="btn btn-success">Créer une entrée</a>
                    </div>

                    <?php
                        if (isset($_SESSION['error_update_editor']) && ($_SESSION['error_update_editor'] == false)) {
                            alert('success', 'L éditeur a bien été ajouté à la base de données');
                            unset($_SESSION['error_update_editor']);
                        }
                        
                        ?>

                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Dénomination</th>
                                <th scope="col">SIRET</th>
                                <th scope="col">Adresse</th>
                                <th scope="col">Ville</th>
                                <th scope="col">Code Postal</th>
                                <th scope="col">Mail</th>
                                <th scope="col">Numéro de tel</th>
                                <th scope="col">Modifier</th>
                                <th scope="col">Supprimer</th>
                            </tr>

                        </thead>
                        <tbody>

                            <?php foreach ($editeurs as $editeur) : ?>
                                <tr>
                                    <!-- AFFICHAGE DES CHAMPS -->
                                    <th scope="row"><?= $editeur['id'] ?></th>
                                    <td><?= $editeur['denomination'] ?></td>
                                    <td><?= $editeur['siret'] ?></td>
                                    <td><?= $editeur['adresse'] ?></td>
                                    <td><?= $editeur['ville'] ?></td>
                                    <td><?= $editeur['code_postal'] ?></td>
                                    <td><?= $editeur['mail'] ?></td>
                                    <td><?= $editeur['numero_tel'] ?></td>
                                    <td><a href="<?= URL_ADMIN ?>editeur/update.php?id=<?= $editeur['id'] ?>" class="btn btn-warning">Modifier</a></td>
                                    <td><a href="<?= URL_ADMIN ?>editeur/action.php?id=<?= $editeur['id'] ?>" class="btn btn-danger">Supprimer</a></td>
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