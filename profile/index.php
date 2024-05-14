

<!DOCTYPE html>
<html lang="fr">

<?php include_once('../components/head.php')
?>


<body>

<div class="hero_area">
    <?php require_once('../components/menu.php') ?>



    <section class="shop_section layout_padding-top layout_padding2-bottom category_section" style="background-color: #fff; min-height: -webkit-fill-available ">
        <div class="container">
            <div class="custom_heading">
                <h4>
                    MON
                </h4>
                <hr>
                <h3>
                    Profil
                </h3>
            </div>
            <div class="shop_content">

                <div class="row g-5">
                    <div class="text-center col-md-5 col-lg-4 order-md-last">
                        <h4 class="mb-3">
                        </h4>
                        <div>
                            <img src="../assets/user.png" alt="profile" style="width: 250px;">
                        </div>
                    </div>
                    <div class="col-md-7 col-lg-8">
                        <h4 class="mb-3">Informations personnelles</h4>
                        <p id="mypara">qsdfqsdfqsdfqsfd</p>

                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label for="firstName" class="form-label">Prénom</label>
                                <input type="text" class="form-control" id="firstname" value="" readonly>
                                <div class="invalid-feedback">
                                    Valid first name is required.
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label for="lastName" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="lastname" value="" readonly>
                                <div class="invalid-feedback">
                                    Valid last name is required.
                                </div>
                            </div>

                            <div class="col-12" style="">
                                <label for="email" class="form-label"></label>
                                <input type="hidden" class="form-control" id="email" readonly>
                                <div class="invalid-feedback">

                                </div>
                            </div>



                            <form class="col-12 needs-validation" novalidate="">
                                <h4>Changement de mot de passe</h4>
                                <div class="row gy-3">
                                    <div class="col-md-6">
                                        <label for="cc-number" class="form-label">Saisir votre ancien mot de passe</label>
                                        <input type="text" class="form-control" id="cc-number"
                                               placeholder="Entrez votre ancien mot de passe" required="">
                                        <div class="invalid-feedback">
                                            Credit card number is required
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="cc-name" class="form-label">Saisir votre nouveau mot de passe</label>
                                        <input type="text" class="form-control" id="cc-name"
                                               placeholder="Entrez votre nouveau mot de passe" required="">
                                        <div class="invalid-feedback">
                                            Name on card is required
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="cc-number" class="form-label">Confirmer le mot de passe</label>
                                        <input type="text" class="form-control" id="cc-number"
                                               placeholder="Confirmez votre nouveau mot de passe" required="">
                                        <div class="invalid-feedback">
                                            Credit card number is required
                                        </div>
                                    </div>
                                    <br>


                                </div>
                        </div>
                        <div>
                            <h4>Liste des commandes passées</h2>
                                <ol class="list-group list-group-numbered" id="order-history">
                                </ol>
                        </div>

                        <hr class="my-4">

                        <button class="w-100 btn btn-primary btn-lg" type="submit">Mettre à jour votre mot de passe</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <?php include_once('../components/footer.php')
    ?>

</div>


</body>
<?php include_once('../components/footer_script.php')
?>

</html>