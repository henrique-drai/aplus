var grupo;
var ficheiro_id;

$(document).ready(() => {
    $("#submit-file").on("click", function(e){
        if($("#file_submit").val() == ""){
            $(".error-file").show();
            $(".default-file").hide()
            $(".success-file").hide();
            e.preventDefault();
        } else {
            if($("#file_submit")[0].files[0].size < 2024000){
                // submit_ficheiro_grupo(grupo, $("#file_submit").val().split('\\').pop());   
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

    $("#form-submit-grupo").attr('action', base_url + 'UploadsC/uploadFicheirosGrupo/' + grupo);

    get_ficheiros_grupo(grupo);

    $("body").on("click", ".delete_img", function(){
        makePopup("confirmRemove", "Tem a certeza que deseja eliminar o ficheiro?");
        ficheiro_id = $(this).attr("id");
        console.log(ficheiro_id);
    });

    $("body").on("click", "#confirmRemove", function(){
        removeFicheiro(grupo, ficheiro_id);
        $(".cd-popup").remove();
    });

});


function setGrupo(grp){
    grupo = grp;
}

function get_ficheiros_grupo(grupo){
    const data = {
        grupo_id : grupo,
    }

    $.ajax({
        type: "GET",
        url: base_url + "api/getFicheirosGrupo/" + grupo,
        data: data,
        success: function(data) {
            console.log(data);
            var base_link = base_url + "file/group_files/" + grupo + "/"; 
            var array = [];

            if(data["ficheiros"].length == 0){
                array.push("Não existem ficheiros para mostrar");
            } else {
                for (i=0; i<data["ficheiros"].length; i++){
                    var name = "";
                    for (j=0; j<data["nomes"].length; j++){
                        if(data["ficheiros"][i]["user_id"] == data["nomes"][j][2]){
                            name = data["nomes"][j][0] + " " + data["nomes"][j][1]; 
                        }
                    }

                    array.push('<div class="file-row" id="file-row-teacher">'
                    + '<p><a target="_blank" href="'+base_link+data["ficheiros"][i]["url"]+'">' + data["ficheiros"][i]["url_original"] + '</a></p>'
                    + '<p><a href="'+base_url+ 'app/profile/' + data["ficheiros"][i]["user_id"]+'">'+name+ '</a></p>'
                    + '<p><img id="'+data["ficheiros"][i]["id"]+'" src="'+base_url+'images/icons/trash.png" class="delete_img"></p></div><hr>');
                }
            }

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
            console.log("Erro na API - get ficheiros grupo");
            console.log(data);
        }
    });
}

function removeFicheiro(grupo_id, ficheiro_id){

    const data = {
        grupo_id : grupo_id,
        ficheiro_id : ficheiro_id,
    }

    $.ajax({
        type: "DELETE",
        url: base_url + "api/removeFicheiroAreaGrupo/" + ficheiro_id,
        data: data,
        success: function(data) {
            window.location = base_url + "file/delete_file/" + data["ficheiro"][0]["url_original"] + "/" + grupo_id + "/" + 0;
        },
        error: function(data) {
            console.log("Erro na API - Remove Ficheiro")
            console.log(data)
        }
    });
}
