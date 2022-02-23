<?php
    session_start();
    include 'includes/header.php';
    ?>

<section class="contact_form">
    <h1>Contactez-nous !</h1>

    <div class="contact_box">

    <?php 
    
    if(isset($_SESSION['info_error'])) {
        echo '<div class="alert alert-danger" role="alert">' . implode('. ', $_SESSION['info_error']) . '</div>';
        unset($_SESSION['info_error']);
    
     } elseif (!isset($_SESSION['info_error']) && isset($_SESSION['info_success'])) {
            echo '<div class="alert alert-success" role="alert">' . ($_SESSION['info_success']) . '</div>';
            unset($_SESSION['info_success']);
        }
         ?>
        
        <form action="traitement.php" method="POST">
        <div class="names">
            <div>
                <input type="text" name="nom" id="nom" class="champs" placeholder="Votre nom...">
            </div>
            <div>
                <input type="text" name="prenom" id="prenom" class="champs" placeholder="Votre prenom...">
            </div>
        </div>
        <div>
            <input type="text" name="mail" id="mail" class="champs" placeholder="Votre mail...">
        </div>
        <div>
            <textarea type="text" name="message" id="message" class="champs" placeholder="Votre message..."></textarea>
        </div>
        <div class="button">
            <button type="submit" class="send_button" name="btn_form">Envoyer</button>
        </div>
        </form>   
    </div>
</section>

<?php
    include 'includes/footer.php';
    ?>