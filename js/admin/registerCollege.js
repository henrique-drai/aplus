$(document).ready(() => {
    $("#register-college-submit").click(() => submitRegister())  
})



function submitRegister(){
    const data = {
        nomefaculdade:   $("#register-faculdade-form input[name='nomefaculdade']").val(),
        morada:    $("#register-faculdade-form input[name='morada']").val(),
        siglas:    $("#register-faculdade-form input[name='siglas']").val(),
    }
    $("input[type='text']").val("");
    $(".msgSucesso").remove();
    $(".msgErro").remove();
    $.ajax({
        type: "POST",
        url: base_url + "admin/api/registerCollege",
        data: data,
        success: function(data) {
            msgSucesso = "<p class='msgSucesso'>Faculdade registada com Sucesso.</p>";
            $("#register-faculdade-form").after(msgSucesso);
        },
        error: function(data) {
            msgErro = "<p class='msgErro'> Não foi possivel registar a faculdade.</p>";
            $("#register-faculdade-form").after(msgErro);
        }
    });
    
}