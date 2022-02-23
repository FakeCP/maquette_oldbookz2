<?php
include '../config/config.php';
include '../config/bdd.php';

if (!isConnect()) {
    header('location:' . URL_ADMIN . 'login.php');
    die;
}

if (isset($_SESSION['error_update_book']) && ($_SESSION['error_update_book'] == true)) {
    alert('danger', 'Erreur dans la modification');
    unset($_SESSION['error_update_book']);
}

//modifier une prise de contact
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    if ($id > 0) {
        //requete sql pour recuperer le contact en bdd
        $sql = "SELECT * FROM livre WHERE id = ?";
        //executer la requete
        $requete = $bdd->prepare($sql);
        $requete->execute(array($id));
        //recuperer les infos
        $livres = $requete->fetch(PDO::FETCH_ASSOC);
    } else {
        header('location:index.php');
        die;
    }
}

$sql = "SELECT * FROM categorie";
$req = $bdd->query($sql);
$categories = $req->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT id_categorie FROM categorie_livre WHERE id_livre = ?";
$req = $bdd->prepare($sql);
$req->execute([$id]);
$categorie_livre = $req->fetchAll(PDO::FETCH_NUM);
$categorie_id = [];
if (count($categorie_livre) >= 1) {
    // stocker toutes les valeurs reçus dans 1 seul tableau
    foreach ($categorie_livre as $id_categorie) {
        $categorie_id[] = implode('', $id_categorie);
    }
} else {
    $categorie_id = $categorie_livre[0];
}
// var_dump($categorie_id);


?>


<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Modifier un livre</title>

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
                        <h1 class="h3 mb-0 text-gray-800">Modifier "<?= $livres['titre'] ?>" </h1>

                    </div>

                </div>

                <?php
                if (isset($_SESSION['error_update_book']) && ($_SESSION['error_update_book'] == true)) {
                    alert('danger', 'Erreur de saisie : livre non-ajouté à la base de données');
                    unset($_SESSION['error_update_book']);
                }

                ?>

                <form action="action.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $livres['id'] ?>">
                    <div class="container">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Numéro ISBN</label>
                            <input type="text" name="num_ISBN" class="form-control" id="exampleFormControlInput1" value="<?= $livres['num_ISBN'] ?>">
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Titre</label>
                            <input type="text" name="titre" class="form-control" id="exampleFormControlInput1" value="<?= $livres['titre'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Résumé</label>
                            <textarea type="form-control" name="resume" class="form-control" id="exampleFormControlInput1"><?= $livres['resume'] ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Prix</label>
                            <input type="text" name="prix" class="form-control" id="exampleFormControlInput1" value="<?= $livres['prix'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Nombre de pages</label>
                            <input type="text" name="nb_pages" class="form-control" id="exampleFormControlInput1" value="<?= $livres['nb_pages'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="disponibilite" class="form-label">Disponibilité :</label>
                            <input type="text" name="nb_pages" class="form-control" id="disponibilite" value="<?= $livres['disponibilite'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Date d'achat</label>
                            <input type="text" name="date_achat" class="form-control" id="exampleFormControlInput1" placeholder="aaaa-mm-dd hh:mm:ss" value="<?= $livres['date_achat'] ?>">
                        </div>
                        <div class="mb-3 row">
                            <div class="mb-3 col">
                                <label for="illustration" class="form-label">Illustration :</label>
                                <input type="file" name="illustration" class="form-control" id="illustration">
                                <label for="categorie" class="form-label mt-4">Catégories :</label><br>
                                <select name="categorie[]" id="categorie" multiple class="mt-1 select-cat">
                                    <?php foreach($categories as $categorie) : ?>
                                        <?php if (in_array($categorie['id'], $categorie_id)) {
                                            $selected = "selected";
                                        }else{
                                            $selected = "";
                                        } ?>
                                            <option value="<?= $categorie['id'] ?>" <?= $selected ?>><?= $categorie['libelle'] ?></option>
                                        
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3 col">
                                <p>Illustration actuelle :</p>
                                <img src="<?= URL_ADMIN ?>images/<?= $livres['illustration'] ?>" alt="illustration <?= $livres['titre'] ?>" height="350px" width="250px">
                            </div>
                        <div class="mb-3 text-center">
                            <label for="exampleFormControlInput1" class="form-label"></label>
                            <input type="submit" name="btn_update_book" class="btn btn-primary" value="Enregistrer">
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