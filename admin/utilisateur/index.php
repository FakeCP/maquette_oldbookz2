<?php

include '../config/config.php';
include '../config/bdd.php';

if (!isConnect()) {
    header('location:login.php');
    die;
}

if (!isAdmin()) {
    header('location:' . URL_ADMIN . 'index.php');
    die;
}

$sql = 'SELECT utilisateur.id AS id_utilisateur, utilisateur.nom, utilisateur.prenom,
utilisateur.mail, utilisateur.num_telephone, utilisateur.pseudo,
utilisateur.nom, utilisateur.avatar, utilisateur.adresse,
utilisateur.ville, utilisateur.code_postal, role.libelle 
FROM role_utilisateur 
INNER JOIN role 
ON role_utilisateur.id_role = role.id
INNER JOIN utilisateur 
ON role_utilisateur.id_utilisateur = utilisateur.id';

$requete = $bdd->query($sql);
$utilisateurs = $requete->fetchAll(PDO::FETCH_ASSOC);
// var_dump($utilisateurs);

?>

<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Liste des utilisateurs</title>

    <!-- Custom fonts for this template-->
    <link href="<?= URL_ADMIN ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= URL_ADMIN ?>css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?= URL_ADMIN ?>css/style.css" rel="stylesheet">

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
                        <h1 class="h3 mb-0 text-gray-800">Liste des utilisateurs</h1>
                        <?= count($utilisateurs) ?> utilisateurs répertoriés
                    </div>



                </div>
                <a href="add.php" class="btn btn-success ml-2">Créer un utilisateur</a>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Rôle</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Prénom</th>
                            <th scope="col">Pseudo</th>
                            <th scope="col">Mail</th>
                            <th scope="col">Téléphone</th>
                            <th scope="col">Adresse</th>
                            <th scope="col">Ville</th>
                            <th scope="col">Code postal</th>
                            <th scope="col">Avatar</th>
                            <th scope="col">Modifier</th>
                            <th scope="col">Supprimer</th>
                        </tr>

                    </thead>
                    <tbody>

                        <?php foreach ($utilisateurs as $utilisateur) : ?>
                            <tr>
                                <!-- AFFICHAGE DES CHAMPS -->
                                <td><?= $utilisateur['id_utilisateur'] ?></td>
                                <td><?php if ($utilisateur['libelle'] == 'admin') {
                                
                                echo '<div style="color: red; font-weight: bold">' . $utilisateur['libelle'] .'</div>';
                                    } else {
                                echo '<div style="color: green; font-weight: bold">' . $utilisateur['libelle'] .'</div>';
                                    } ?></td>
                                <td><?= $utilisateur['nom'] ?></td>
                                <td><?= $utilisateur['prenom'] ?></td>
                                <td><?= $utilisateur['pseudo'] ?></td>
                                <td><?= $utilisateur['mail'] ?></td>
                                <td><?= $utilisateur['num_telephone'] ?></td>
                                <td><?= $utilisateur['adresse'] ?></td>
                                <td><?= $utilisateur['ville'] ?></td>
                                <td><?= $utilisateur['code_postal'] ?></td>
                                <td><img width="70px" height="70px" src="<?= URL_ADMIN ?>images/avatar/<?= $utilisateur['avatar'] ?>" </td>
                                <td><a href="<?= URL_ADMIN ?>utilisateur/update.php?id=<?= $utilisateur['id_utilisateur'] ?>" class="btn btn-warning">Modifier</a></td>
                                <td><a href="<?= URL_ADMIN ?>utilisateur/action.php?id=<?= $utilisateur['id_utilisateur'] ?>" class="btn btn-danger">Supprimer</a></td>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                < </div>
                    <!-- End of Main Content -->

                    <?php
                    include PATH_ADMIN . 'includes/footer.php';
                    ?>

</body>

</html>