var cadeira;

$(document).ready(() => {
    $("#submit-file-cadeira").on("click", function(e){
        if($("#file_submit")[0].files.length==0){
            $(".error-file").show();
            $(".default-file").hide()
            $(".success-file").hide();
            e.preventDefault();
        } else {
            e.preventDefault(); //TIRAR QUANDO O CODIGO DO PHP TIVER FEITO
            console.log("wohoo ficheiros a serem enviados");
            console.log($("#file_submit")[0].files);

            if($("#file_submit")[0].files.length > 1){
                for (i=0; i<$("#file_submit")[0].files.length; i++){
                    console.log($("#file_submit")[0].files[i].name);
                    submit_ficheiro(cadeira, $("#file_submit")[0].files[i].name);
                }
            } else {
                console.log($("#file_submit")[0].files[0].name);
            }
        }
    })

    $("#form-submit-cadeira").attr('action', base_url + 'UploadsC/uploadFicheirosCadeira/' + cadeira);

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