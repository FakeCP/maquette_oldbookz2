<?php
include '../config/config.php';
include '../config/bdd.php';
$sql = 'SELECT * FROM livre';

$requete = $bdd->query($sql);
$livres = $requete->fetchAll(PDO::FETCH_ASSOC);

// $sql2 = 'SELECT * FROM etat_livre
// INNER JOIN livre ON livre.id = etat_livre.id_livre
// WHERE etat_livre.id_etat = 1';
// $requete2 = $bdd->query($sql2);
// $etat_neuf = $requete2->fetchAll(PDO::FETCH_ASSOC);


// var_dump($etat_neuf);
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
                        <h1 class="h3 mb-0 text-gray-800">Liste des livres</h1>
                        <?= count($livres) ?> livres répertoriés
                    </div>
                    <div class="pb-3">
                    <a href="<?= URL_ADMIN ?>livres/add.php" class="btn btn-success">Créer une entrée</a>
                    </div>

                    <?php
                        if (isset($_SESSION['error_update_book']) && ($_SESSION['error_update_book'] == false)) {
                            alert('success', 'Le livre a bien été ajouté à la base de données');
                            unset($_SESSION['error_update_book']);
                        }
                        
                        ?>

                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">ISBN</th>
                                <th scope="col">Titre</th>
                                <th scope="col">Illustration</th>
                                <th scope="col">Résumé</th>
                                <th scope="col">Prix</th>
                                <th scope="col">Nombre pages</th>
                                <th scope="col">Date achat</th>
                                <th scope="col">Disponibilité</th>
                                <th scope="col">Voir</th>
                                <th scope="col">Modifier</th>
                                <th scope="col">Supprimer</th>
                            </tr>

                        </thead>
                        <tbody>

                            <?php foreach ($livres as $livre) : ?>
                                <tr>
                                    <!-- AFFICHAGE DES CHAMPS -->
                                    <th scope="row"><?= $livre['id'] ?></th>
                                    <td><?= $livre['num_ISBN'] ?></td>
                                    <td><?= $livre['titre'] ?></td>
                                    <td><img width="70px" height="100px" src="<?= URL_ADMIN ?>images/<?=$livre['illustration']?>"</td>
                                    <td><?= substr($livre['resume'], 0, 75 ) ?> [...]</td>
                                    <td><?= $livre['prix'] ?></td>
                                    <td><?= $livre['nb_pages'] ?></td>
                                    <td><?= $livre['date_achat'] ?></td>
                                    <td><?= $livre['disponibilite'] ?></td>
                                    <td><a href="<?= URL_ADMIN ?>livres/single.php?id=<?= $livre['id'] ?>" class="btn btn-primary">Voir</a></td>
                                    <td><a href="<?= URL_ADMIN ?>livres/update.php?id=<?= $livre['id'] ?>" class="btn btn-warning">Modifier</a></td>
                                    <td><a href="<?= URL_ADMIN ?>livres/action.php?id=<?= $livre['id'] ?>" class="btn btn-danger">Supprimer</a></td>
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