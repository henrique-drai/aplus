$(document).ready(() => {
    getAllfaculdades();
    $("#register-cadeira-submit").click(() => submitRegister())
})


function getAllfaculdades(){
    $.ajax({
        type: "GET",
        url: base_url + "admin/api/getAllFaculdadesUnidCurricular",
        success: function(data) {
            var linhas = '';
            if(data.colleges.length>0){
                for(i=0; i<data.colleges.length;i++){
                    linhas += '<option class="college_row"><td>' + data.colleges[i].name + '</td><td>' + data.colleges[i].location + 
                    '</td><td>' + data.colleges[i].siglas + '</td><td><button class="deleteCollege" type="button">Apagar</button></td></tr>'; 
                }
                $("#faculdades_register_UnidCurricular").append(linhas);
            }
        },
        error: function(data) {
            msgErro = "<p class='msgErro'> Não foi possivel registar a faculdade.</p>";
            $("#register-faculdade-form").after(msgErro);
        }
    });

}


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