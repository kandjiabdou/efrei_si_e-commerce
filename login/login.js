$("form").submit((event) => {
    event.preventDefault();

    $.ajax({
        url: "../php/login.php",
        type: "POST",
        dataType: "json",
        data: {
            email: $("#email").val(),
            pwd: $("#password").val()
        },
        success: (res) => {


            if (res.success) {
                localStorage.setItem("user", JSON.stringify(res.user));
                window.location.replace("../home");
            } else alert(res.error);
        },

        error: function (xhr, ajaxOptions, thrownError) {
            console.log("what is the problem", thrownError)
        }
    });
});

$("i").click(() => {
    if ($("#password:password").length) {
        $("i").removeClass("fa-eye");
        $("i").addClass("fa-eye-slash");
        $("#password").attr("type", "text");
    } else {
        $("i").removeClass("fa-eye-slash");
        $("i").addClass("fa-eye");
        $("#password").attr("type", "password");
    }
});