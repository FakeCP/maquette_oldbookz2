<?php

use JetBrains\PhpStorm\Internal\ReturnTypeContract;

function alert ($couleur, $message) { ?>
        <div class="alert alert-<?=$couleur ?>" role="alert">
        <?= $message ?>
        </div>
   <?php }

function isConnect() {
            if (isset($_SESSION['connect']) && $_SESSION['connect'] = true) {
                return true;
            } 
            return false;
        }


function checkRoles($id, $bdd) {
    if (intval($id) <= 0) {
        return false;
    }

    $sql = 
    'SELECT libelle FROM role_utilisateur 
    INNER JOIN role 
    ON role.id = role_utilisateur.id_role 
    WHERE role_utilisateur.id_utilisateur = ?';
    $requete = $bdd->prepare($sql);
    $requete->execute([$id]);
    // ATTENTION FETCH_NUM POUR LE MERGE !!
    $roles = $requete->fetchAll(PDO::FETCH_NUM);
    //verif si un role ou +
    if (count($roles) > 1) {
        $roles = array_merge($roles[0], $roles[1]);
    } else {
        //sinon on récupère le role de l'utilisateur(qui a forcément 0 pour index car la bdd retourne un tableau qui commence tjs par 0)
        $roles = $roles[0];
    }
    // var_dump($roles);
    // die;
    //on retourne le tableau
    //normalement on devrait stocker directement le tableau en session
    //cela permet d'avoir une actualisation à chaque appel de la fonction
    

    $_SESSION['utilisateur']['roles'] = $roles;
    // var_dump($_SESSION['utilisateur']['roles']);
    // die;
    return true;
}


/**
 * isAdmin() 
 * Fonction qui retourne un booléan 
 * en fonction de si l'utilisateur a le rôle d'administrateur ou non
 * return boolean
 */
function isAdmin() {
    /**
     * Doit vérifier si le tableau ['roles'] en session contient le nom du role recherché
     * Si oui alors l'utilisateur a le role recherché
     * Sinon l'utilisateur n'a pas le role recherché
     */
    return in_array('admin', $_SESSION['utilisateur']['roles']);
}

function getCategories($_id_livre, $_bdd){
    // GENERER LA REQ SQL qui permet de recuperer les catégories par rapport a un ID de livre
    $sql = 'SELECT categorie.libelle 
    FROM categorie_livre 
    INNER JOIN categorie ON categorie_livre.id_categorie = categorie.id 
    WHERE categorie_livre.id_livre = ?';
    // on prepare la req
    $req = $_bdd->prepare($sql);
    // on execute la req avec en param l'id du livre rechercher
    $req->execute([$_id_livre]);
    // on recup les data sous forme de tableau associatif
    $categories = $req->fetchAll(PDO::FETCH_ASSOC);
    // on créer un tableau qui va permettre de stocker les catégories
    $cat_livre = [];
    // on boucle sur la liste des catégories recu
    foreach ($categories as $categorie) {
        // a cause du fetchAll on recoit un tableau de tableau
        // var_dump($categorie);
        // var_dump(implode($categorie));
        // on stock la valeur que contient le "sous-tableau" grace a la fonction implode qui permet de transformer un array en string 
        $cat_livre[] = implode($categorie);
    }
    // on retourne le tableau des catégories sous forme de chaine de caractères
    return implode(', ', $cat_livre);
}
        