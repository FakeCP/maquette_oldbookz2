<?php
include "./config/config.php";
// echo password_hash('iwqs1278', PASSWORD_DEFAULT);
// echo password_hash('jridv4lk', PASSWORD_DEFAULT);
if (isConnect()) {
    header('location:index.php');
    die;
}
?>

<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Login :</title>
  </head>
  <body>
    <div class="container">
        <?php 
            if (!empty($_SESSION)) {
                if ($_SESSION["connect"] == false) {
            alert('danger', 'Login ou mot de passe incorrect');
            }}
            ?>

        <h1 class="text-center">Connexion :</h1>
        <form action="action.php" method="POST">
            <div class="mb-3">
                <label for="mail" class="form-label">Adresse mail : </label>
                <input type="email" name="mail" class="form-control" id="mail">
            </div>
            <div class="mb-3">
                <label for="mot_de_passe" class="form-label">Mot de passe : </label>
                <input type="password" name="mot_de_passe" class="form-control" id="mot_de_passe">
            </div>
            <div class="mb-3 text-center">
                <input type="submit" class="btn btn-primary" name="btn_connect" value="Connexion">
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>