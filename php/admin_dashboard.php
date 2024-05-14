<?php

error_reporting(-1);
require_once("utils/cnx.database.php");

function getDashboardData()
{
    global $bdd;
    $data = [];

    //liste des utilisateurs /admin
    $request = $bdd->prepare("SELECT count(id_user) as total_users, (SELECT count(id_user) as total_admin_users from users where admin=1) as total_admin_users FROM users;
    ");
    $request->execute();
    $data["users"] = $request->fetch(PDO::FETCH_ASSOC);

    //liste des commandes
    $request = $bdd->prepare(" SELECT count(id_order) as total_orders,                   
                            ( SELECT count(id_order) as total_waiting_orders  from orders where statut = 0 )as total_waiting_orders
                            from orders");
    $request->execute();
    $data["orders"] = $request->fetch(PDO::FETCH_ASSOC);
    //liste des produits 
    $requestProd = $bdd->prepare(" SELECT count(id_product) as total_products,
                                (SELECT count(id_product) as total_under_ten_products from products where product_quantity<=10 ) as total_under_ten_products from products;");

    $requestProd->execute();
    $data["products"] = $requestProd->fetch(PDO::FETCH_ASSOC);


    return $data;
}
