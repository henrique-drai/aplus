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
            localStorage.setItem("token", data.token)
            localStorage.setItem("email", data.email)
            window.location.href = base_url + "app/" + data.role
        },
        error: function(data) {
            alert("Dados inválidos. (Esta mensagem vai ser substituída, como é óbvio)")
        }
    });
    
}


