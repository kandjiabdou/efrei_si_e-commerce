<!DOCTYPE html>
<html lang="fr">

<?php include_once ('../components/head.php')
    ?>


<body>

    <div class="hero_area">
        <?php require_once ('../components/menu.php') ?>



        <section class="shop_section layout_padding-top layout_padding2-bottom category_section"
            style="background-color: #fff; min-height: -webkit-fill-available ">
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
                        <div class="text-center col-md-5 col-lg-4 order-md-first">
                            <h4 class="mb-3"> avatar</h4>
                            <div>
                                <img id="avatar_user" src="../assets/user.png" alt="profile" style="width: 250px;">
                            </div>
                            <form id="form_avatar">

                                <div class="inputBox">
                                    <label for="picture">Changer votre avatar</label><br>
                                    <input type="file" name="image" id="image" accept="image/*"
                                        class="form-control input-style">
                                </div>
                                <br>
                                <button class="w-100 btn btn-primary btn-lg" type="submit">Changer l'avatar</button>
                            </form>
                        </div>
                        <div class="col-md-7 col-lg-8">
                            <form id="form_info" action="">
                                <h4 class="mb-3">Informations personnelles</h4>
                                <p id="mypara">--</p>

                                <div class="row g-3">
                                    <div class="col-12" style="">
                                        <label for="email" class="form-label"></label>
                                        <input class="form-control" id="email" readonly>
                                        <div class="invalid-feedback">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="firstName" class="form-label">Prénom</label>
                                        <input type="text" class="form-control" id="firstname" value="">
                                        <div class="invalid-feedback">
                                            Valid first name is required.
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="lastName" class="form-label">Nom</label>
                                        <input type="text" class="form-control" id="lastname" value="">
                                        <div class="invalid-feedback">
                                            Valid last name is required.
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="address" class="form-label">Adresse</label>
                                        <input type="text" class="form-control" id="address" value="">
                                        <div class="invalid-feedback">
                                            Valid adresse is required.
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="city" class="form-label">Ville</label>
                                        <input type="text" class="form-control" id="city" value="">
                                        <div class="invalid-feedback">
                                            Valid ville is required.
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="code" class="form-label">Code postal</label>
                                        <input type="number" class="form-control" id="code" value="">
                                        <div class="invalid-feedback">
                                            Valid last name is required.
                                        </div>
                                    </div>
                                    <br>
                                    <button class="w-100 btn btn-primary btn-lg" type="submit">Mettre à jour mes
                                        informations</button>
                                </div>
                            </form>
                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

                            <script src="profile.js" defer></script>
                            <br><br><br>


                            <form id="form_pwd" class="col-12 needs-validation" novalidate="">
                                <h4>Changement de mot de passe</h4>
                                <div class="row gy-3">
                                    <div class="col-md-6">
                                        <label for="ancienpwd" class="form-label">Saisir votre ancien mot de
                                            passe</label>
                                        <div class="input-group">
                                            <input id="ancienpwd" type="password" class="form-control password"
                                                placeholder="Entrez votre nouveau mot de passe" required>
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary toggle-password" type="button">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                            <div class="invalid-feedback">
                                                Password is required
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Saisir votre nouveau mot de passe</label>
                                        <div class="input-group">
                                            <input id="newpwd" type="password" class="form-control password"
                                                placeholder="Entrez votre nouveau mot de passe" required>
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary toggle-password" type="button">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                            <div class="invalid-feedback">
                                                Password is required
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="confirmpwd" class="form-label">Confirmer le mot de passe</label>
                                        <div class="input-group">
                                            <input id="confirmpwd" type="password" class="form-control password"
                                                placeholder="Entrez votre nouveau mot de passe" required>
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary toggle-password" type="button">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                            <div class="invalid-feedback">
                                                Password is required
                                            </div>
                                        </div>
                                    </div>
                                    <br>


                                </div>
                                <button class="w-100 btn btn-primary btn-lg" type="submit">Mettre à jour votre mot
                                    de
                                    passe</button>
                            </form>
                        </div>
                        <br><br><br>
                        <div>
                            <h4>Liste des commandes passées</h2>
                                <ol class="list-group list-group-numbered" id="order-history">
                                </ol>
                        </div>

                        <hr class="my-4">


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