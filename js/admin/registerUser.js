$(document).ready(() => {
    $("#register-form-submit").click(() => submitRegister())
})



function submitRegister(){

    const data = {
        name:       $("#register-form input[name='name']").val(),
        surname:    $("#register-form input[name='surname']").val(),
        email:      $("#register-form input[name='email']").val(),
        password:   $("#register-form input[name='password']").val(),
        role:       $("#register-form select[name='role']").val(),
    }

    $.ajax({
        type: "POST",
        url: base_url + "api/admin/register",
        data: data,
        success: function(data) {
            console.log(data);
        },
        error: function(data) {
            console.log("ERRO NA API")
        }
    });
    
}