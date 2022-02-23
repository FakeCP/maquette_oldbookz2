<?php
    session_start();


        if (isset($_POST['btn_form'])) {
            if (isset($_POST['prenom']) && isset($_POST['nom']) && isset($_POST['mail']) && isset($_POST['message'])){
                if(!empty($_POST['prenom']) || !empty($_POST['nom']) || !empty($_POST['mail']) || !empty($_POST['message'])){
                    if (strlen($_POST['nom']) < 2) {
                        $_SESSION['info_error'][] = 'Votre nom doit contenir au moins 2 caractères';
                    }
                    if (strlen($_POST['prenom']) < 2) {
                        $_SESSION['info_error'][] = 'Votre prénom doit contenir au moins 2 caractères';
                    }
                    if (!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)){
                        $_SESSION['info_error'][] = 'Vous devez utiliser une adresse mail valide';
                    }
                    if (strlen($_POST['message']) < 20) {
                        $_SESSION['info_error'][] = 'Votre message doit contenir au moins 20 caractères';
                    }
                              
        }
        if (!isset($_POST['info_error'])) {
            $_SESSION['info_success'] = 'Merci, votre message a bien été envoyé';
        }
    header('location:contact.php');
    }
}

 