$(document).ready(() => {
    $("#login-form-submit").click(() => submitLogin())
})


function submitLogin(){

    $("form .error-msg").css("visibility", "hidden")

    $.ajax({
        type: "POST",
        url: base_url + "api/login",
        data: {
            email: $("#login-form input[name='email']").val(),
            password: $("#login-form input[name='password']").val(),
        },
        success: function(data) {
            console.log(data)
            localStorage.setItem("user_id", data.id)
            window.location.href = base_url + "app/"
        },
        error: function(data) {
            $("form .error-msg").css("visibility", "visible")
            console.log(data)
        }
    });
    
}


