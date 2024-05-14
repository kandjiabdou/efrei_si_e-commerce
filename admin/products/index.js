function delateArticle(id) {
    console.log("art del :",id);
    const fd = new FormData();
    fd.append("choisir", "delete");
    fd.append("id_product", id);
    $.ajax({
        url: "../../php/admin_products.php",
        type: "POST",
        dataType: "json",
        data: fd,
        contentType: false,
        processData: false,
        cache: false,
        success: (res) => {
            console.log(res)
            if (res.success) window.location.replace("../products/"); // Si success alors je rédirige vers la liste des produits
            else alert(res.error);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log("what is the problem", thrownError)
        }
    });
}

function getAllProducts() {

    $.ajax({
        url: "../../php/admin_products.php",
        type: "GET",
        data: {
            choisir: "select"
        },
        contentType: "application/json",
        dataType: "json",
        cache: false,
        success: (res) => {
            // console.log(res)


            for (const element of res.products) {
                pr = element;
                let tr = `
                <tr>
                    <td>${pr.id_product}</td>
                    <td>${pr.product_name}</td>
                    <td><img class="img-fluid" src="/project_e_commerce/assets/product/${pr.product_picture}" /></td>
                    <td>${pr.description}</td>
                    <td>${pr.product_quantity}</td>
                    <td>${pr.product_price}</td>
                    <td>${pr.reduction ?? "-"}</td>
                    <td>${pr.category}</td>
                    <td>
                        <a href="form.php?choisir=selec_idt&id=${pr.id_product}"><i class="fa fa-edit"></i></a>
                        <button onclick="delateArticle(${pr.id_product})"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>
            `;
                $("#products_tbody").append(tr)
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log("what is the problem", thrownError)
        }
    });

}


getAllProducts();