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
    if(data.name!=="" || data.surname!=="" || data.email!=="" || data.password!==""){
        $.ajax({
            type: "POST",
            url: base_url + "admin/api/register",
            data: data,
            success: function(data) {
                $("input[type='text']").val("");
                $("#msgStatus").text("Utilizador registado com sucesso.");
                $("#msgStatus").show().delay(2000).fadeOut();
            },
            error: function(data) {
                $("input[type='text']").val("");
                $("#msgStatus").text("Não foi possivel registar o utilizador.");
                $("#msgStatus").show().delay(2000).fadeOut();
            }
        });
    }
    else{
        $("#msgStatus").text("É necessário preencher todos os campos.");
        $("#msgStatus").show().delay(2000).fadeOut();
    }
}