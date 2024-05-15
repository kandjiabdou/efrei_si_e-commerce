
$("#form_info").submit(function (event) {
    event.preventDefault();  // Prévenir la soumission standard du formulaire
    var userData = {
        firstName: $("#firstname").val(),
        lastName: $("#lastname").val(),
        address: $("#address").val(),
        city: $("#city").val(),
        code: $("#code").val(),
        choisir: 'update_info',
        user_id: user.id_user
    };
    console.log(userData);
    updateProfile(userData);
});

$("#form_pwd").submit(function (event) {
    event.preventDefault();
    var userData = {
        choisir: 'update_pwd',
        user_id: user.id_user,
        ancienpwd: $("#ancienpwd").val(),
        newpwd: $("#newpwd").val(),
        confirmpwd: $("#confirmpwd").val()
    }
    console.log(userData);
    updatePwd(userData);
});

$("#form_avatar").submit(function (event) {
    event.preventDefault();
    var formData = new FormData(this);
    formData.append('choisir', 'update_avatar');
    formData.append('user_id', user.id_user);  // Assurez-vous que 'user.id_user' est correctement défini
    updateAvatar(formData);
});

function updateProfile(userData) {
    $.ajax({
        url: "../php/profile.php",
        type: "POST",
        dataType: "json",
        data: userData,
        success: function (res) {
            console.log("res : ", res);
            if (res.success) {
                localStorage.setItem("user", JSON.stringify(res.user));
                alert(res.message);
            } else {
                alert("Error: " + res.error);
            }
        },
        error: function (xhr, status, error) {
            alert("An error occurred: " + error);
        }
    });
}

function updatePwd(data) {
    $.ajax({
        url: "../php/profile.php",
        type: "POST",
        dataType: "json",
        data: data,
        success: (res) => {
            if (res.success) {
                alert(res.message);
                window.location.replace("./");
            } else {
                alert(res.error);
            }
        },
        error: function (xhr, status, error) {
            alert("An error occurred: " + error);
        }
    });
}

function updateAvatar(formData) {
    $.ajax({
        url: "../php/profile.php",
        type: "POST",
        processData: false,  // important pour le traitement de FormData
        contentType: false,  // important pour le traitement de FormData
        dataType: "json",
        data: formData,
        success: (res) => {
            if (res.success) {
                $('#avatar_user').attr('src', "/project_e_commerce/assets/avatar/" + res.image);
                alert(res.message);
            } else {
                alert(res.error);
            }
        },
        error: function (xhr, status, error) {
            console.log("error : ", error);
            alert("An error occurred: " + error);
        }
    });
}
