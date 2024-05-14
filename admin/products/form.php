<?php
include_once ("../components/admin_header.php");

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
    include_once ("../components/sidebar.php");
    include_once ("../components/topbar.php");

    ?>
    <div class="main-content" style="padding-top: 50px;">
        <div class="container-fluid content-top-gap">
            <div class="row">
                <div class="card" style="width: 100%;">
                    <div class="card-body">
                        <form>
                            <div class="inputBox">

                                <label for="Nom">Titre</label>
                                <input type="text" id="Nom" required class="form-control input-style">
                            </div>

                            <div class="inputBox">

                                <label for="desc">Description</label>
                                <textarea id="description" required class="form-control input-style"></textarea>
                            </div>
                            <div class="inputBox">
                                <label for="picture">Image</label><br>
                                <img id="picture" class="img-fluid" alt="picture" src="/project_e_commerce/assets/product/default_product.png" />
                                <input type="file" id="image" accept="image/*" class="form-control input-style">
                            </div>

                            <div class="inputBox">
                                <label for="quantite">Quantité</label>
                                <input type="number" id="quantite" required class="form-control input-style">
                            </div>

                            <div class="inputBox">
                                <label for="prix">Prix</label>
                                <input type="number" id="prix" required class="form-control input-style">
                            </div>

                            <div class="inputBox">
                                <label for="reduction">Réduction</label>
                                <input type="number" id="reduction" class="form-control input-style">
                            </div>

                            <div class="inputBox">
                                <label for="categorie">Categorie</label>
                                <select id="categorie" class="form-control input-style" required>
                                    <option>---</option>
                                </select>
                            </div>




                            <input type="submit" value="Envoyer">
                            <a href="../products/">Annuler</a>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>



    <script src="../js/jquery.js"></script>
    <script src="../js/utile.js"></script>
    <script src="../js/nicescroll.js"></script>
    <script src="../js/script.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="form.js" defer></script>

</body>

</html>