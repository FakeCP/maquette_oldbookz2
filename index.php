<?php 
    include 'admin/config/config.php';
    include 'includes/header.php';
    ?>

    <section id="best_sellers">
        <p class="bs_text">OLDBOOKZ vous propose une large sélection de livres rares, épuisés et de collection mis en
            location par des milliers de personnes du monde entier !</h2>

        <div class="best_sellers_band">
            <h2>Nos best-sellers</h2>
        </div>

        <div class="slider_boss">
            <div class="slider">
                <div class="slider_block">
                <div>
                    <h3>Orange mécanique <br> 3ème édition</h3>
                    <img src="admin/images/orange_mecanique.jpg" alt="orange_mecanique">
                    
                    <button class="add_basket">Louer ce livre</button>
                </div>
                </div>

                <div class="slider_block">
                <div>
                    <h3>Le Tour du monde en 80 jours (édition Hetzel)</h3>
                    <img src="admin/images/tour-du-monde.jpg" class="flipbook" alt="tour_du_monde" height="329px" width="220px">
                    
                    <button class="add_basket">Louer ce livre</button>
                </div>
                </div>

                <div class="slider_block">
                <div>
                    <h3>1984 <br> Version non-censurée</h3>
                    <img src="admin/images/1984.jpg" class="flipbook" alt="1984" height="329px" width="220px">
                    
                    <button class="add_basket">Louer ce livre</button>
                </div>
                </div>

                <div class="slider_block">
                <div>
                    <h3>Harry Potter 1<br> 1ère édition</h3>
                    <img src="admin/images/harry_potter.jpg" class="flipbook" alt="harry_potter.jpg" height="329px" width="220px">
                    
                    <button class="add_basket">Louer ce livre</button>
                </div>
                </div>

                <div class="slider_block">
                <div>
                    <h3>Le vieil homme <br> et la mer</h3>
                    <img src="admin/images/vieil_homme_et_la_mer.jpg" class="flipbook" alt="vieil_homme_et_la_mer" height="329px" width="220px" >
                    
                    <button class="add_basket">Louer ce livre</button>
                </div>
                </div>

                <div class="slider_block">
                <div>
                    <h3>Des souris et <br> des hommes (Alpha)</h3>
                    <img src="admin/images/souris_hommes.jpg" class="flipbook" alt="souris_hommes" height="329px" width="220px" >
                    
                    <button class="add_basket">Louer ce livre</button>
                </div>
                </div>
            </div>
        </div>
    </section>

    <?php
        include 'includes/footer.php';
        ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="slick-1.8.1/slick-1.8.1/slick/slick.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13"
        crossorigin="anonymous"></script>
    <script src="main.js"></script>
</body>


</html>