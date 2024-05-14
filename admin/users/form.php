<?php
include_once("../components/admin_header.php");
//include_once("../../php/admin_products.php");



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
                <div class="card" style="width: 100%;">
                    <div class="card-body">
                        <div class="row">
                            <form>
                                <div class="inputBox">

                                    <label for="firstname">Prenom</label>
                                    <input type="text" id="firstname" required class="form-control input-style">
                                </div>

                                <div class="inputBox">

                                    <label for="lastname">Nom</label>
                                    <input type="text" id="lastname" required class="form-control input-style"></input>
                                </div>

                                <div class="inputBox">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" require class="form-control input-style">
                                </div>

                                <div class="inputBox">
                                    <input type="hidden" id="user_id" required class="form-control input-style">
                                </div>
                                <input type="submit" value="Modifier">

                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>







    <script src="../js/jquery.js"></script>
    <script src="../js/utile.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="../js/nicescroll.js"></script>
    <script src="../js/script.js"></script>
    <script src="index.js"></script>


    <script defer>
        getUser();
    </script>








</body>

</html>