$(document).ready(() => {
    $("#login-form-submit").click(() => submitLogin())
})


function submitLogin(){

    const data = {
        email: $("#login-form input[name='email']").val(),
        password: $("#login-form input[name='password']").val(),
    }

    $.ajax({
        type: "POST",
        url: base_url + "auth/login",
        data: data,
        success: function(data) {
            console.log(data)
            localStorage.setItem("token", data.token)
            localStorage.setItem("user_id", data.id)
            localStorage.setItem("profile_pic", data.profile_pic)
            window.location.href = base_url + "app/" + data.role
        },
        error: function(data) {
            alert("Dados inválidos.")
            console.log(data)
        }
    });
    
}


