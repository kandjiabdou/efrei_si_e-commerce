const urlParams = new URLSearchParams(window.location.search);
const id = urlParams.get("id"); // Je récupère l'id de l'article à modifier dans l'url


function getAllUsers() {
    $.ajax({
        url: "../../php/admin_user.php",
        type: "GET",
        dataType: "json",
        data: {
            choisir: "select"
        },
        success: (res) => {
            console.log(res);
            if (res.success) {
                res.users.forEach(u => {
                    const tr = $("<tr></tr>"); // Je crée une nouvelle ligne

                    const lastname = $("<td></td>").text(u.lastname); // Je crée une case pour le nom
                    const firstname = $("<td></td>").text(u.firstname); // Je crée une case pour le prénom
                    const email = $("<td></td>").text(u.email); // Je crée une case pour l'email
                    const isAdmin = $("<td></td>").text((u.admin == 1) ? "Admin" : ""); // Je crée une case pour admin


                    const updatectn = $("<td></td>"); // Je crée une case pour contenir mon bouton
                    const updatebtn = $("<button></button>"); // Je crée le bouton pour la mise à jour
                    updatebtn.addClass("btn ocean action_btn"); // J'ajoute des classes sur le bouton pour le style
                    updatebtn.html("<i class='fa fa-pencil' aria-hidden='true'></i>"); // J'ajoute un texte au lien
                    updatectn.append(updatebtn); // J'ajoute le boutton au td

                    const updateAdmin = $("<span></span>"); // Je crée le bouton pour la mise à jour
                    updatebtn.addClass("btn ocean action_btn");
                    updateAdmin.html('<i class="fa fa-user-plus" aria-hidden="true"></i>');
                    updatectn.append(updateAdmin);

                    updateAdmin.click(() => {
                        $.ajax({
                            url: "../../php/admin_user.php",
                            type: "GET",
                            //dataType: "json",
                            data: {
                                choisir: "adminchoisir",
                                "id_user": u.id_user
                            },
                            success: (res) => {
                                window.location.reload();
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                console.log("what is the problem", thrownError)
                            }
                        });
                    })

                    updatebtn.click(() => {
                        window.location.replace("../users/form.php?id=" + u.id_user); // Je redirige vers la page du formulaire avec paramètre id de mon article sur lequel j'itère en paramètre
                    });

                    tr.append(lastname, firstname, email, isAdmin, updatectn); // J'ajoute toutes mes cases dans ma ligne
                    $("tbody").append(tr); // J'ajoute ma ligne à ma table
                });

                $("td").addClass("text-left"); // J'ajoute une classe à tous les td
            } else console.log(res.error);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log("what is the problem", thrownError)
        }
    });
}

function getUser() {
    $.ajax({
        url: "../../php/admin_user.php",
        type: "GET",
        dataType: "json",
        data: {
            choisir: "select_id",
            user_id: id
        },
        success: (res) => {
            console.log(res);
            if (res.success) {
                let user = res.user;
                $("#lastname").val(user.lastname);
                $("#firstname").val(user.firstname);
                $("#email").val(user.email);
                $("#user_id").val(user.id_user);


            } else console.log(res.error);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log("what is the problem", thrownError)
        }
    });
}

function updateUser(fd) {
    fd.append("choisir", "update");
    $.ajax({
        url: "../../php/admin_user.php",
        type: "POST",
        dataType: "json",
        data: fd,
        contentType: false,
        processData: false,
        cache: false,
        success: (res) => {
            if (res.success == true) {
                window.location.replace("index.php"); //? Si success alors je redirige vers la liste des articles
            }
            console.log(res);

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log("what is the problem", thrownError)
        }
    });
}

$("form").submit(event => {
    event.preventDefault();

    const fd = new FormData();
    // Je récupère les données du formulaire
    fd.append("firstname", $("#firstname").val());
    fd.append("lastname", $("#lastname").val());
    fd.append("email", $("#email").val());
    fd.append("user_id", $("#user_id").val());


    if (id) updateUser(fd);
});