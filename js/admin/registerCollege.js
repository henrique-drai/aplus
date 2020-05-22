$(document).ready(() => {
    $("#register-college-submit").click(() => submitRegister())  
})



function submitRegister(){
    const data = {
        nomefaculdade:   $("#register-faculdade-form input[name='nomefaculdade']").val(),
        morada:    $("#register-faculdade-form input[name='morada']").val(),
        siglas:    $("#register-faculdade-form input[name='siglas']").val(),
    }
    $.ajax({
        type: "POST",
        url: base_url + "api/registerCollege",
        data: data,
        success: function(data) {
            $("#msgStatus").text("Faculdade registada com Sucesso");
            $("#msgStatus").show().delay(2000).fadeOut();
            $("input[type='text']").val("");
            $(".msgSucesso").remove();
            $(".msgErro").remove();
        },
        error: function(data) {
            $("#msgStatus").text("Não foi possivel registar a faculdade");
            $("#msgStatus").show().delay(2000).fadeOut();
        }
    });
    
}