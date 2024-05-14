<header class="header_section">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container">
            <div></div>
            <div>
                <a href="../home/">Accueil</a>

                <a href="../products/">Produits</a>
                <a href="../contact/">Contact</a>

            </div>
            <div>
                <?php

                if (isset($_SESSION["connected"]) && $_SESSION["connected"]) : ?>

                    <?php if (isset($_SESSION["admin"]) && $_SESSION["admin"] == 1) : ?>
                        <a href="../admin/dashboard/" class="dashboard_item">
                            <img src="../assets/dashboard.png" alt="">
                        </a>
                    <?php endif ?>
                    <a href="../profile/" class="profile_item">
                        <img src="../assets/user.png" alt="">
                    </a>

                <?php else : ?>

                    <?php header("location: ../login/") ?>
                <?php endif ?>
                <?php if (isset($_SESSION["connected"]) && $_SESSION["connected"]) : ?>

                        <a href="../panier/" class="cart-icon">
                            <img src="../assets/cart.png" alt="">
                            <span class="cart-badge" id="cart-badge"></span>
                        </a>
                        <a href="../login/logout.php" class="logout_item">
                            <img src="../assets/logout.png" alt="">
                        </a>


                <?php endif; ?>
            </div>


            <!--div>

                <form class="form-inline my-2 my-lg-0  mb-3 mb-lg-0">
                    <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit"></button>
                </form>
            </div-->
        </nav>
    </div>
</header>