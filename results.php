<?php
    session_start();

    echo '<p> Nom :' . $_SESSION['form']['nom'] . '</p>';
    echo '<p> Prénom :' . $_SESSION['form']['prenom'] . '</p>';
    echo '<p> Mail :' . $_SESSION['form']['mail'] . '</p>';
    echo '<p> Message :' . $_SESSION['form']['message'] . '</p>';