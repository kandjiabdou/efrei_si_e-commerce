const urlParams = new URLSearchParams(window.location.search);
const id = urlParams.get("id"); // Je récupère l'id du produit à modifier dans l'url


function getAllcategories() {

    $.ajax({
        url: "../../php/admin_categories.php",
        type: "GET",
        data: {
            choisir: "select"
        },
        contentType: "application/json",
        dataType: "json",
        cache: false,
        success: (res) => {
            console.log(res)


            for (let i = 0; i < res.categories.length; i++) {
                pr = res.categories[i];
                let tr = `
                <tr>
                    <td>${pr.id_category}</td>
                    <td>${pr.name_category}</td>
                   
                    <td><a href="form.php?id=${pr.id_category}"><i class="fa fa-edit"></i></a></td>
                </tr>
            `;
                $("#categories_tbody").append(tr)
            }



        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log("what is the problem", thrownError)
        }
    });

}




function insertCategory(fd) {
    event.preventDefault();
    fd.append("choisir", "insert");

    $.ajax({
        url: "../../php/admin_categories.php",
        type: "POST",
        // dataType: "json",
        data: fd,
        contentType: false,
        processData: false,
        cache: false,
        success: (res) => {
            window.location.replace("../categories"); // Si success alors je rédirige vers la liste des categories 
            // else alert(res.error);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log("what is the problem", thrownError)
        }
    });
}

function getcategory(id) {
    $.ajax({
        url: "../../php/admin_categories.php",
        type: "GET",
        dataType: "json",
        data: {
            choisir: "select_id",
            id_category: id
        },
        success: (res) => {
            console.log(res);
            $("#Nom").val(res.category.name_category);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log("what is the problem", thrownError)
        }
    });
}

function updateArticle(fd) {
    fd.append("choisir", "update");
    fd.append("id_category", id);

    $.ajax({
        url: "../../php/admin_categories.php",
        type: "POST",
        dataType: "json",
        data: fd,
        contentType: false,
        processData: false,
        cache: false,
        success: (res) => {
            console.log(res)
            if (res.success) window.location.replace("../categories/"); // Si success alors je rédirige vers la liste des categories
            else console.log(res.error);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log("what is the problem", thrownError)
        }
    });
}

if (id) {
    $.ajax({
        url: "../../php/admin_categories.php",
        type: "GET",
        dataType: "json",
        data: {
            choisir: "select_id",
            id_category: id
        },
        success: (res) => {
            if (res.success) {

                $("#Name").val(res.category.name_category);
            } else alert(res.error);
        }
    });
} else {
    // Je modifie mon titre du header pour inserer
    $("header h1").text("Ajouter un article");
    $(".box h1").text("Ajout");
}

$("form").submit(event => {
    event.preventDefault();

    const fd = new FormData();
    // Je récupère les données du formulaire
    fd.append("name_category", $("#Name").val());


    if (id) {
        updateArticle(fd);
    } else {
        insertCategory(fd);
    }

});

if (id) {
    getcategory(id)
}