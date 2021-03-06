var cadeira;
var ficheiro_id;

$(document).ready(() => {
    $("#submit-file-cadeira").on("click", function(e){
        if($("#file_submit").val() == ""){
            $(".error-file").show();
            $(".default-file").hide()
            $(".success-file").hide();
            e.preventDefault();
        } else {
            if($("#file_submit")[0].files[0].size < 2024000){
                // submit_ficheiro(cadeira, $("#file_submit").val().split('\\').pop());  
                console.log("vai ser enviado o ficheiro")
            } else {
                $(".error-file").text("O ficheiro ultrapassa o limite máximo de 2MB");
                $(".error-file").show();
                $(".default-file").hide()
                $(".success-file").hide();
                e.preventDefault();
            }         
        }
    })

    var link = location.href.split(localStorage.cadeira_code);
    var ano = link[1].replace("/","");

    $("#form-submit-cadeira").attr('action', base_url + 'UploadsC/uploadFicheirosCadeira/' + cadeira + "/" + localStorage.cadeira_code + "/" + ano);

    get_ficheiros(cadeira);

    $("body").on("click", ".delete_img", function(){
        makePopup("confirmRemove", "Tem a certeza que deseja eliminar o ficheiro?");
        ficheiro_id = $(this).attr("id");
        console.log(ficheiro_id);
    });

    $("body").on("click", "#confirmRemove", function(){
        removeFicheiro(cadeira, ficheiro_id);
        $(".cd-popup").remove();
    });
});

function setCadeira(id){
    cadeira = id;
}

function get_ficheiros(cadeira_id){
    const data = {
        cadeira_id : cadeira_id,
    }

    $.ajax({
        type: "GET",
        url: base_url + "api/getFicheirosCadeira/" + cadeira_id,
        data: data,
        success: function(data) {
            console.log(data.length);
            var base_link = base_url + "file/subject_files/" + cadeira_id + "/";
            var array = [];

            if(data.length == 0){
                array.push("Não existem ficheiros para mostrar");
            } else {
                for (i=0; i<data.length; i++){
                    array.push('<div class="file-row" id="file-row-teacher">'
                    + '<p><a target="_blank" href="'+base_link+data[i]["url"]+'">' + data[i]["url_original"] + '</a></p>'
                    + '<p><img id="'+data[i]["id"]+'" src="'+base_url+'images/icons/trash.png" class="delete_img"></p></div><hr>');
                }
            }

            // $("#show-files-div").html(str);
            $("#container-ficheiros").pagination({
                dataSource: array,
                pageSize: 10,
                pageNumber: 1,
                callback: function(data, pagination) {
                    $("#show-files-div").html(data);
                }
            })
        },
        error: function(data) {
            console.log("Erro na API - Submit File Para Area da Cadeira");
            console.log(data);
        }
    });
}


function removeFicheiro(cadeira_id, ficheiro_id){
    console.log("eliminar ficheiro da bd depois de fazer verificacao e dar unlink no php");

    const data = {
        cadeira_id : cadeira_id,
        ficheiro_id : ficheiro_id,
    }

    $.ajax({
        type: "DELETE",
        url: base_url + "api/removeFicheiroAreaCadeira/" + ficheiro_id,
        data: data,
        success: function(data) {
            window.location = base_url + "file/delete_file/" + data["ficheiro"][0]["url_original"] + "/" + cadeira_id + "/" + 1;
        },
        error: function(data) {
            console.log("Erro na API - Remove Etapa")
            console.log(data)
        }
    });
}