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
                                            01
                                        </div>
                                        <h2>
                                            Produit
                                        </h2>
                                        <h3>
                                            Description
                                        </h3>
                                        <div>
                                            <a href="">
                                                Buy Now
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item ">
                                    <div class="detail-box">
                                        <div class="indicator_number">
                                            02
                                        </div>
                                        <h2>
                                            Produit
                                        </h2>
                                        <h3>
                                            Description
                                        </h3>
                                        <div>
                                            <a href="">
                                                Buy Now
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item ">
                                    <div class="detail-box">
                                        <div class="indicator_number">
                                            03
                                        </div>
                                        <h2>
                                            Produit
                                        </h2>
                                        <h3>
                                            Description
                                        </h3>
                                        <div>
                                            <a href="">
                                                Buy Now
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

        <!-- end category section -->

        <!-- shop section -->

        <section class="shop_section layout_padding-top layout_padding2-bottom">
            <div class="container-fluid">
                <div class="shop_content">

                    <div class="shop_container" id="shop_container">


                    </div>
                </div>

            </div>
        </section>
        <?php include_once ('../components/footer.php')
            ?>

    </div>


</body>
<?php include_once ('../components/footer_script.php')
    ?>

</html>