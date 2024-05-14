$("form").submit((event) => { // A la soumission du formulaire cette fonction sera déclencher.
    event.preventDefault(); // Ici j'empêche le comportement par defaut , qui est le rechargement de la page.
    //console.log("okkkkkk");

    $.ajax({
        url: "../php/signin.php", // url du script PHP qui recevra les données du formulaire.
        type: "POST", // Méthod HTPP utilisée pour la requête (ici c'est la méthode POST).
        dataType: "json", // Type de données attendu en réponse (ici c'est un format JSON).
        data: {
            firstname: $("#prenom").val(),
            lastname: $("#nom").val(), // Données à envoyer au serveur,
            email: $("#email").val(), // les valeurs sont récupérées à partir des champs du formilaire. 
            pwd: $("#password").val()
        },
        success: (res) => {
            //console.log("bien recu", res)

            if (res.success) { // Si le serveur indique opération success, je dirigie l'utilisateur dans la page login.
                //localStorage.setItem("user", JSON.stringify(res.user));
                window.location.replace("../login/");
            } else alert(res.error);
        }
    });
});