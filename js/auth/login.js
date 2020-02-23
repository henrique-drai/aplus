$(document).ready(() => {
    $("#login-form-submit").click(() => submitLogin())
})


function submitLogin(){

    const data = {
        username: $("#login-form input[name='username']").val(),
        password: $("#login-form input[name='password']").val(),
    }

    $.ajax({
        type: "POST",
        url: window.location.href + "/../../../api/login",
        data: data,
        success: function(data) {
            sessionStorage.setItem("token", data.token)
        }
    });
    
}


