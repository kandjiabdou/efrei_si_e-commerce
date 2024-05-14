<!DOCTYPE html>
<html lang="fr">

<?php include_once ('../components/head.php')
    ?>


<body>

    <div class="hero_area">
        <?php require_once ('../components/menu.php') ?>

        <section class=" slider_section position-relative">
            <div class="number-box">
                <hr>
                <div class="social_box">
                    <a href="">
                        <img src="../assets/front-img/fb.png" alt="">
                    </a>
                    <a href="">
                        <img src="../assets/front-img/twitter.png" alt="">
                    </a>
                    <a href="">
                        <img src="../assets/front-img/insta.png" alt="">
                    </a>
                </div>
                <hr>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-md-10">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="detail-box">
                                        <div class="indicator_number">
                                            $$
                                        </div>
                                        <h2>
                                            Panier
                                        </h2>
                                        <h5>
                                            N produits
                                        </h5>
                                        <div>
                                            <a href="">
                                                Supprimer
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                                data-slide="prev">
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                                data-slide="next">
                                <span class="sr-only">Next</span>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <section class="category_section ">
            <div class="container">
                <div class="product_container" id="product_container">

                </div>
            </div>
        </section>
        <!-- end category section -->

        <!-- shop section -->

        <?php include_once ('../components/footer.php')
            ?>

    </div>


</body>
<?php include_once ('../components/footer_script.php')
    ?>

</html>