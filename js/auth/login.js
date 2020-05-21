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
        url: base_url + "api/login",
        data: data,
        success: function(data) {
            console.log(data)
            localStorage.setItem("user_id", data.id)
            window.location.href = base_url + "app/"
        },
        error: function(data) {
            alert("Dados inválidos.")
            console.log(data)
        }
    });
    
}


