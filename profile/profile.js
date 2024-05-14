const user = JSON.parse(localStorage.getItem("user"));
console.log(user);
$("#firstname").val(user.firstname);
$("#lastname").val(user.lastname);
$("#email").val(user.email);
$("#mypara").html(user.lastname);
$("form").submit(event => {
    event.preventDefault();
    $.ajax({
        url: "../php/profile.php",
        type: "POST",
        dataType: "json",
        data: {
            choisir: 'update',
            user_id: user.user_id,
            ancienpwd: $("ancienpwd").val(),
            newpwd: $("newpwd").val(),
            confirmpwd: $("confirmpwd").val()
        },
        success: (res) => {
            if (res.success) {

                alert(res.message);
            } else {
                alert(res.error);
            }
        }
    });
});