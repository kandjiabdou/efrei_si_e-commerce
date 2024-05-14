<?php
include_once("../components/admin_header.php");
include_once("../../php/admin_dashboard.php");

$data = getDashboardData();


/********************************************************* */
// isAdmin j' affiche l'interface de l'administrateur (dashbaord)
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/fontawesome.css">

</head>

<body class="sidebar-menu-collapsed">

    <?php
    include_once("../components/sidebar.php");
    include_once("../components/topbar.php");





    ?>
    <div class="main-content" style="padding-top: 50px;">
        <div class="container-fluid content-top-gap">
            <div class="row">

                <div class="col-xl-4 col-sm-12">
                    <div class="card card_border border-primary-top p-4">
                        <i class="lnr lnr-users"> </i>
                        <h3 class="text-primary number">
                            <?php echo $data['users']['total_admin_users'] . '/' . $data['users']['total_users']; ?>
                        </h3>
                        <p class="stat-text">Total Admin / Users</p>
                    </div>
                </div>

                <div class="col-xl-4 col-sm-12">
                    <div class="card card_border border-primary-top p-4">
                        <i class="fa fa-shopping-bag"> </i>
                        <h3 class="text-primary number">
                            <?php echo $data['products']["total_under_ten_products"] . '/' . $data['products']['total_products']; ?>
                        </h3>
                        <p class="stat-text">Total Produits en fin de stocks / Produits</p>
                    </div>
                </div>

                <div class="col-xl-4 col-sm-12">
                    <div class="card card_border border-primary-top p-4">
                        <i class="fa fa-shopping-cart"> </i>
                        <h3 class="text-primary number">
                            <?php echo $data['orders']["total_waiting_orders"] . '/' . $data['orders']['total_orders']; ?>
                        </h3>
                        <p class="stat-text">Total commandes en attente /Commandes</p>
                    </div>
                </div>


            </div>
        </div>

    </div>

    <script src="../js/jquery.js"></script>
    <script src="../js/utile.js"></script>
    <script src="../js/nicescroll.js"></script>
    <script src="../js/script.js"></script>





</body>

</html>