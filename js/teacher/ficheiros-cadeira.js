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
        }
    })

    $("#form-submit-cadeira").attr('action', base_url + 'UploadsC/uploadFicheirosCadeira/' + cadeira);

    $("#submit-file-cadeira").on("click", function(){
        const data = {
            cadeira_id : cadeira,
        }

        $.ajax({
            type: "POST",
            headers: {
                "Authorization": localStorage.token
            },
            url: base_url + "api/submitFileAreaCadeira",
            data: data,
            success: function(data) {
                console.log(data);
            },
            error: function(data) {
                console.log("Erro na API - Submit File Area Cadeira");
                console.log(data);
            }
        });

    })
});

function setCadeira(id){
    cadeira = id;
}