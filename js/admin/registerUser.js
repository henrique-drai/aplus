$(document).ready(() => {
    $("#register-form-submit").click(() => submitRegister())
})



function submitRegister(){

    const data = {
        name:       $("#register-form input[name='name']").val(),
        surname:    $("#register-form input[name='surname']").val(),
        email:      $("#register-form input[name='email']").val(),
        password:   $("#register-form input[name='password']").val(),
        role:       $("#register-form input[name='role']").val(),
    }

    $.ajax({
        type: "POST",
        url: base_url + "api/registerUser",
        data: data,
        success: function(data) {
            console.log(data);
        },
        error: function(data) {
            alert("Dados inválidos. (Esta mensagem vai ser substituída, como é óbvio)")
        }
    });
    
}