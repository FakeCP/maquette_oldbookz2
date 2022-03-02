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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

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
                        if (isset($_SESSION['error_update_livre']) && $_SESSION['error_update_livre'] == false) {
                            alert('success', 'Le livre a bien été modifié !');
                            unset($_SESSION['error_update_livre']);
                        }
                        if (isset($_SESSION['error_add_livre']) && $_SESSION['error_add_livre'] == false){
                            alert('success', 'Livre bien ajouté en base de données');
                            unset($_SESSION['error_add_livre']);
                        }
                        if (isset($_SESSION['error_delete_livre']) && $_SESSION['error_delete_livre'] == false){
                            alert('success', 'Le livre a bien été supprimé');
                            unset($_SESSION['error_delete_livre']);
                        }
                        if (isset($_SESSION['error_delete_livre']) && $_SESSION['error_delete_livre'] == true){
                            alert('danger', 'Le livre n\'a pas été supprimé');
                            unset($_SESSION['error_delete_livre']);
                        }
                        if (isset($_SESSION['error_delete_illustration']) && $_SESSION['error_delete_illustration'] == true){
                            alert('danger', 'L\'illustration ne peut être supprimée');
                            unset($_SESSION['error_delete_illustration']);
                        }
                    ?>

                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">ISBN</th>
                                <th scope="col">Titre</th>
                                <th scope="col">Illustration</th>
                                <th scope="col">Catégorie</th>
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
                                    <td><?= getCategories($livre['id'], $bdd); ?></td>
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