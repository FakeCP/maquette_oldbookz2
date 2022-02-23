<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Readex+Pro:wght@200&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mochiy+Pop+P+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="slick-1.8.1/slick-1.8.1/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="slick-1.8.1/slick-1.8.1/slick/slick-theme.css">
    <link rel="stylesheet" href="style.css">
    <title>Oldbookz accueil</title>
</head>

<body>

    <header>
        <div class="wrapper">
            <div class="logo">
                <img class="logopic" src="admin/images/old-bookz-logo.png" alt="Logo Old Bookz">
            </div>
            <ul class="nav-area">
                <li><a href="index.php">Accueil</a></li>
                <li><a href="#">Base de données</a></li>
                <li><a href="contact.php" target="_blank">Contact</a></li>
                <li><a href="<?= URL_ADMIN ?>login.php" class="nav-espace">Mon espace</a></li>
            </ul>

            </nav>
        </div>
    </header>

    <section id="cover">
        
        <h1>La plus grande base de données de livres anciens à louer !</h1>
        
        <div class="findbook-area">
            <div class="text-area">
                <p>Trouvez votre livre (auteur, titre, mot-clé...)</p>
            </div>
            <div class="searchbar">
                <div class="search_bloc">
                    <div class="btn btn_common icon-search">
                        <i class="fas fa-search"></i>
                    </div>
                    <input type="text" class="input" placeholder="chercher...">
                </div>
            </div>
        </div>
    </section>