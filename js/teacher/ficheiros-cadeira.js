var cadeira;

$(document).ready(() => {
    $("#submit-file-cadeira").on("click", function(e){
        if($("#file_submit").val() == ""){
            $(".error-file").show();
            $(".default-file").hide()
            $(".success-file").hide();
            e.preventDefault();
        } else {
            // e.preventDefault(); //TIRAR QUANDO O CODIGO DO PHP TIVER FEITO
            console.log("wohoo ficheiros a serem enviados");
            submit_ficheiro(cadeira, $("#file_submit").val().split('\\').pop());           
        }
    })

    var link = location.href.split(localStorage.cadeira_code);
    var ano = link[1].replace("/","");

    $("#form-submit-cadeira").attr('action', base_url + 'UploadsC/uploadFicheirosCadeira/' + cadeira + "/" + localStorage.cadeira_code + "/" + ano);

});

function setCadeira(id){
    cadeira = id;
}

function submit_ficheiro(cadeira_id, ficheiro){

    const data = {
        cadeira_id : cadeira_id,
        ficheiro_url : ficheiro,
    }

    $.ajax({
        type: "POST",
        url: base_url + "api/submitFileAreaCadeira",
        data: data,
        success: function(data) {
            console.log(data)
        },
        error: function(data) {
            console.log("Erro na API - Submit File Para Area da Cadeira");
            console.log(data);
        }
    });
}