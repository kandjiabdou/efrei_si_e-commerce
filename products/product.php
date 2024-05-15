<!DOCTYPE html>
<html lang="fr">

<?php include_once ('../components/head.php')
    ?>


<body>

    <div class="hero_area">
        <?php require_once ('../components/menu.php') ?>



        <section class="shop_section layout_padding-top layout_padding2-bottom"
            style="background-color: #fff; min-height: -webkit-fill-available ">
            <div class="container-fluid">
                <div class="custom_heading">
                    <h4>
                        Détails
                    </h4>
                    <hr>
                    <h3>
                        Produit
                    </h3>
                </div>
                <div class="shop_content">

                    <div class="container mt-5">
                        <div class="row">
                            <!-- Photo Column -->
                            <div class="col-md-6">
                                <img id="picture" src="" alt="Product Image" class="img-fluid">
                            </div>
                            <!-- Details Column -->
                            <div class="col-md-6">
                                <h3 id="Nom"></h3>
                                <p id="description"></p>
                                <p>Prix: <span id="prix"></span> USD</p>
                                <p>Réduction: <span id="reduction"></span>%</p>
                                <button id="addToCartBtn" class="btn btn-primary">Ajouter au panier</button>
                            </div>
                        </div>
                    </div>
                    <script src="product.js" defer></script>
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