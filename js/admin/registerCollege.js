$(document).ready(() => {
    $("#register-college-submit").click(() => submitRegister())  
})



function submitRegister(){
    const data = {
        nomefaculdade:   $("#register-faculdade-form input[name='nomefaculdade']").val(),
        morada:    $("#register-faculdade-form input[name='morada']").val(),
        siglas:    $("#register-faculdade-form input[name='siglas']").val(),
    }
    if(data.nomefaculdade!=="" && data.morada!=="" && data.siglas!==""){
        $.ajax({
            type: "POST",
            url: base_url + "api/registerCollege",
            data: data,
            success: function(data) {
                $("#msgStatus").text("Faculdade registada com Sucesso");
                $("#msgStatus").show().delay(2000).fadeOut();
                $("input[type='text']").val("");
            },
            error: function(data) {
                $("#msgErro").text("Não foi possivel registar a faculdade");
                $("#msgErro").show().delay(2000).fadeOut();
            }
        });
    }
    else{
        $("#msgErro").text("É necessário preencher todos os campos.");
        $("#msgErro").show().delay(2000).fadeOut();
    }
}