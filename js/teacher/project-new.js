var proj
var enunciado_h4
var back_page
var selected_etapa
var etapa = {nome:'', desc:'', enunciado:'', data:''};
var updated_enunc_etapa;
var formStatus = null;
var etapas_info_global;

$(document).ready(() => {

//Gets de conteudo
    showGroups(proj);
    getEtapas(proj);

    //Enunciado projeto
        if(checkEnunciado()){
            setInterval(function(){
                checkEnunciado();
            }, 1000);
        }


//Gerais - remover projeto, date pickers, etc

    // REMOVER PROJETO - button -> mostrar popup (meter conteudo)
    $('#removeProject').on('click', function(event){
        showPopup();
        $(".cd-message").html("<p>Tem a certeza que deseja eliminar o projeto?</p>");
        $(".cd-buttons").html('').append("<li><a href='#' id='confirmRemove'>" +
            "Sim</a></li><li><a href='#' id='closeButton'>Não</a></li>");
    }); 

    //ADICIONAR ENUNCIADO - button -> mostrar popup (meter conteudo)

    $("body").on("click", "#openEnunc", function(){
        showPopup();
        createAddEnuncPopup();
    })

//Eventos - on click, on change, etc

    //POPUPS - Esconder
    $('body').on('click', '.cd-popup', function(){
        if($(event.target).is('.cd-popup-close') || $(event.target).is('.cd-popup') || $(event.target).is('#closeButton')){
            event.preventDefault();
            hidePopup();
        }
    })

    //REMOVER PROJETO - Confirmar
    $("body").on('click', '#confirmRemove', function(){
        delete_projeto();
    })

    //ADICIONAR ENUNCIADO - File Input
    $("body").on('change', "#file_projeto", function(){
        console.log($("#file_projeto").val());

        if($("#file_projeto").val() != ""){
            $("#name-enunciado-proj").text($("#file_projeto").val().split('\\').pop());
            $("#file-img").attr('src',base_url+"images/icons/check-solid.png");
        } else {
            $("#name-enunciado-proj").text("Envie o ficheiro do enunciado");
            $("#file-img").attr('src',base_url+"images/icons/upload-solid.png");
        }
    })

    //ADICIONAR ENUNCIADO - Confimar 
    $("body").on("click", "#addEnunciado", function(e){
        enunc = $("#file_projeto").val().split('\\').pop();
        if (enunc.length == 0){
            //erro - reformular msgs de erro
            //tem de selecionar um ficheiro
            e.preventDefault();
        } else {
            if($("#file_projeto")[0].files[0].size < 5024000){
                //msg de sucesso - reformular msgs de sucesso
                submit_new_enunciado(enunc);
                console.log(enunc);
            } else {
                // $("#projenuncerror").text("Ficheiro ultrapassa o limite máximo de 5MB");
                //msg de erro - reforumlar msgs de erro
                e.preventDefault();
            }
        }
    })

    //Remover Projeto
    $('body').on('click', '#removeEnunciadoProj', function(){
        $("#enunciado_h4").text('Este projeto não tem enunciado');
        removeEnunciadoProj();
    })

    
//Etapas 
      
})


//Funções set variáveis globais
function setEnunciado(url){
    enunciado_h4 = url;
}

function setProj(id){
    proj = id;
}

function setBackPage(href){
    back_page = href;
}


// Funções get - metem conteudo na pagina

function showGroups(proj_id) {
    $.ajax({
        type: "GET",
        url: base_url + "api/getAllGroups/" + proj_id,
        data: {proj_id: proj_id},
        success: function(data) {
            console.log(data);
            var linhas = '<option value="">--- Grupos ---</option>';
            var array = [];
            
            for(var i=0; i < data["grupos"].length; i++) {
                var names = '';
                console.log(data["nomes"]);

                for(var j=0; j < data["nomes"].length; j++) {
                    if(data["nomes"][j].grupo_id == data["grupos"][i].id) {
                        names = names + '<a href="'+ base_url +'app/profile/' + data["nomes"][j].user_name[2] + '">' + data["nomes"][j].user_name[0] + " " + data["nomes"][j].user_name[1] + "</a> | ";
                    }
                }
                
                array.push('<div class="gruposDIV" id="grupo' + data["grupos"][i].id + '">' +
                    '<p><b> Grupo: </b>' + data["grupos"][i].name + '</p>' +
                    '<p><b>Membros: </b>'+ names.slice(0, -2) +'</p></div><hr>');
                    
                linhas += '<option value=' +  data["grupos"][i].id  +">" + data["grupos"][i].name  + '</option>'; 
            }

            if (array.length == 0){
                array.push("<p>Não existem grupos</p><hr>");
            }
            
            $("#select_grupo_feedback").html(linhas);

            $('#grupos-container').pagination({
                dataSource: array,
                pageSize: 5,
                pageNumber: 1,
                callback: function(data, pagination) {
                    $("#grupos-container2").html(data);
                }
            })
        },
        error: function(data) {
            console.log("Erro na API - Show Groups")
            $("#select_grupo_feedback").html('<option value="">--- Não existem grupos ---</option>');
            $("#grupos-container").html("<p>Não existem grupos para mostrar.</p><hr>");
            console.log(data);
        }
    });
}


function getEtapas(proj_id){

    const data_proj = {
        projid : proj_id
    }

    $.ajax({
        type: "GET",
        url: base_url + "api/getAllEtapas/" + proj_id,
        data: data_proj,
        success: function(data) {
            makeEtapaTable(data["etapas"]);
            console.log(data["data_final"]);
            checkEntrega(data["data_final"]);
        },
        error: function(data) {
            console.log("Erro na API - Get Etapa")
            console.log(data)
        }
    });
}


//Funções POST
function submit_new_enunciado(enunc){
    const data = {
        projid : parseInt(proj),
        enunciado : enunc,
    }

    $.ajax({
        type: "POST",
        url: base_url + "api/editEnunciado",
        data: data,
        success: function(data) {
            console.log(data);
            console.log(base_url + "uploads/enunciados_files/"+ proj);
            $("#enunciado_h4").html("<a target='_blank' href='"+ base_url + "uploads/enunciados_files/"+ proj+".pdf?"+new Date().getMilliseconds()+"'>" + data + "</a>");
        },
        error: function(data) {
            console.log("Erro na API - Edit Enunciado");
            console.log(data);
        }
    });

}

//Funções DELETE
function delete_projeto(){
    const data = {
        projid : proj
    }

    $.ajax({
        type: "DELETE",
        url: base_url + "api/removeProject/" + proj,
        data: data,
        success: function(data) {
            console.log(data);
            window.location.assign(back_page);
        },
        error: function(data) {
            console.log("Erro na API - Confirm Remove Projeto")
            console.log(data)
        }
    });
}

function removeEnunciadoProj(){
    const data = {
        projid : parseInt(proj),
    }

    $.ajax({
        type: "DELETE",
        url: base_url + "api/removeEnunciadoProj/" + proj,
        data: data,
        success: function(data) {
            console.log("Enunciado do proj: "+ data + "removido");
            $("#removeEnunciadoProj").hide();
            $("#enunciado_h4").text('Este projeto não tem enunciado');
        },
        error: function(data) {
            console.log("Erro na API - Remover enunciado Projeto");
            console.log(data);
        }
    });
}

//Funções sem chamada a api

function makeEtapaTable(data){
    var etapas_info = [];
    var array_etapa = [];
    for (i=0; i<data.length; i++){
        json = data[i];
        var enunciado = json["enunciado_url"];

        var d1 = json["deadline"].split(" ");
        var date_full = d1[0].split("-");
        var hours_full = d1[1].split(":");
        var date = new Date(date_full[0], date_full[1]-1, date_full[2], hours_full[0], hours_full[1], hours_full[2]);

        var today = new Date();

        var pClass = "p_up"

        if (today > date){
            pClass = "p_expired"
        } else {
            pClass = "p_up"
        }

        array_etapa.push('<div class="etapasDIV" id="etapa' + json["id"] +'"><p><b>'+json["nome"]+'</b></p>'+
        '<p class="'+pClass+'">'+ dateFormatter(date) +'</p>'+
        '<p><input class="moreInfoButtons" id="'+json["id"] +'" type="button" value="Opções"></input></p>' +
        '</div><hr>');

        if (enunciado == ""){
            newenunciado = "Não existe enunciado associado a esta etapa."
            removebut = ''
        } else {
            removebut = '<label id="removeEnunciado" class="labelRemove"><img src="'+base_url+'/images/close.png"></label> '
            newenunciado = "<a target='_blank' href='" + base_url + "uploads/enunciados_files/" + proj + "/" + json['id'] +".pdf'>" + enunciado + "</a>"
        }


        var obj = {
            id: json["id"],
            description: json["description"],
            enunciado:  newenunciado,
            remove: removebut
        };

        etapas_info.push(obj);
        
    }

    console.log(etapas_info);
   
    if (array_etapa.length == 0){
        array_etapa.push("<p>Não existem etapas para mostrar</p><hr>");
    }

    etapas_info_global = etapas_info;

    $('#etapas-container').pagination({
        dataSource: array_etapa,
        pageSize: 3,
        pageNumber: 1,
        callback: function(data, pagination) {
            $("#etapas-container2").html('<div class="buttons-container"><input id="opennewEtapa" type="button" value="Criar etapa"></div><hr>');
            $("#etapas-container2").append(data);
        }
    })
}

function checkEnunciado(){
    //enunciado h4 é setted através do registo da bd associado ao proj
    if (enunciado_h4 != ""){
        $("#enunciado_h4").html("Enunciado: <a target='_blank' href='"+ base_url + "uploads/enunciados_files/"+ proj+".pdf'>" + enunciado_h4 + "</a>");
        $("#openEnunc").val("Editar Enunciado");
    } else {
        $("#enunciado_h4").text("Este projeto ainda não tem enunciado.")
        $("#openEnunc").val("Adicionar Enunciado");
    }
    //fazer get para o ficheiro na diretoria real? no servidor não funcionava
}

function showPopup(){
    $(".cd-popup").css('visibility', 'visible');
    $(".cd-popup").css('opacity', '1');
}

function hidePopup(){
    $(".cd-popup").css('visibility', 'hidden');
    $(".cd-popup").css('opacity', '0');
}

function createAddEnuncPopup(){

    popup = '<form enctype="multipart/form-data" accept-charset="utf-8" method="post" id="enunciado-form" action="'+base_url + 'UploadsC/uploadEnunciadoProjeto/' + proj+'">' +
    '<label id="enunc-label" class="form-label-title">Escolher um enunciado para o projeto</label><br>' +
    '<input class="form-input-file" type="file" id="file_projeto" name="file_projeto" title="Escolher enunciado" accept=".pdf">' +
    '<label for="file_projeto" class="input-label">' +
    '<img id="file-img" class="file-img" src="'+base_url+'images/icons/upload-solid.png">' +
    '<span id="name-enunciado-proj" class="span-name">Envie o ficheiro do enunciado</span></label>' +
    '<p class="msg-warning-size"><b>Tamanho máximo de ficheiro é de 5MB</b></p>' +
    '</form>'

    $(".cd-message").html(popup);
    $(".cd-buttons").html('').append("<li><input form='enunciado-form' class='button-popup' id='addEnunciado' type='submit'>" +
        "</li><li><a href='#' id='closeButton'>Cancelar</a></li>");
}

function checkEntrega(dateOld){

    date = dateFormatter(new Date(dateOld));

    if(date == ''){
        $("#entrega_h3").text("Entrega final: Ainda não definida");
    } else {
        $("#entrega_h3").text("Entrega final: " + date);
    }
}