
function getProduct(id) {
    $.ajax({
        url: "../php/admin_products.php",
        type: "GET",
        dataType: "json",
        data: {
            choisir: "select_id",
            id_product: id
        },
        success: (res) => {
            console.log(res);
            $('#picture').attr('src', "/project_e_commerce/assets/product/" + res.product.product_picture);
            $("#Nom").text(res.product.product_name);
            $("#description").text(res.product.description);
            $("#prix").text(res.product.product_price);
            $("#reduction").text(res.product.reduction);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log("what is the problem", thrownError);
        }
    });
}

const urlParams = new URLSearchParams(window.location.search);
const productId = urlParams.get("id"); // Je récupère l'id du produit à modifier dans l'url
console.log("id du produit :", productId);
if (productId){
    getProduct(productId);
}