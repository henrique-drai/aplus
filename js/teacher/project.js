var proj
var enunciado_h4
var enunciado_original
var back_page
var selected_etapa
var etapa = {nome:'', desc:'', enunciado:'', data:''};
var formStatus = null;
var etapas_info_global;
var msg_res;


// date picker https://github.com/cevadtokatli/window-date-picker

$(document).ready(() => {


//Sets de conteudo gerais
    $("#entrega_h3").text("Entrega final:");

//Gets de conteudo
    showGroups(proj);
    getEtapas(proj);

    //Enunciado projeto
        if(checkEnunciado()){
            setInterval(function(){
                checkEnunciado();
            }, 1000);
        }

        if(msg_res != undefined && msg_res != ""){
            //Mensagens de sucesso e erro vindas do php
            checkMsg();
        }

//Criar Popups

    // REMOVER PROJETO - button -> mostrar popup (meter conteudo)
    $('#removeProject').on('click', function(event){
        showPopup();
        $(".cd-message").html("<p>Tem a certeza que deseja eliminar o projeto?</p>");
        $(".cd-buttons").html('').append("<li><a href='#' id='confirmRemove' class='red-a'>" +
            "Sim</a></li><li><a href='#' id='closeButton'>Não</a></li>");
    }); 

    //ADICIONAR ENUNCIADO - button -> mostrar popup (meter conteudo)

    $("body").on("click", "#openEnunc", function(){
        showPopup();
        createAddEnuncPopup();
    })

    //CRIAR NOVA ETAPA - button -> mostrar popup (meter conteudo)
    $("body").on("click", "#opennewEtapa", function(){
        showPopup();
        createEtapaPopup();
    })

    //MOREINFO - Opções etapas fazer popup
    $('body').on('click', '.moreInfoButtons', function(){
        selected_etapa = $(this).attr("id");
        showPopup();
        etapa_name = $("#etapa" + selected_etapa).find("p").find("b").text();
        createInfoPopup(selected_etapa, etapa_name);

        if ($(this).css("background-color") == "rgb(153, 156, 155)"){
            $(this).css("background-color", "white");
        } else {
            $(this).css("background-color", "rgb(153, 156, 155)");
        }

        if(etapas_info_global.length == 1){
            $('#removeEtapaButton').prop('disabled', true);
        } else {
            $('#removeEtapaButton').prop('disabled', false);
        }
    })

    //Adicionar enunciado etapa - mudar popup
    $("body").on("click", "#addEtapaEnunciado", function(){
        var name = $("#etapa" + selected_etapa).find("p:first").text();
        if(formStatus != 'addEnunc'){
            formStatus = 'addEnunc';
            createInfoPopup(selected_etapa, name);
            createEnunciadoEtapaPopup();
            checkFormStatus();
        } else {
            createInfoPopup(selected_etapa, name);
            formStatus = null;
            checkFormStatus();   
        }
    })


    //Editar etapa - mudar popup
    $("body").on("click", "#editEtapaButton", function(){
        showPopup();
        var name = $("#etapa" + selected_etapa).find("p:first").text();
        if(formStatus != 'edit'){
            var data = $("#etapa" + selected_etapa).find("p:nth-child(2)").text();
            var desc = $(".cd-message").find("label:first").text();
            createEditPopup(name, data, desc);
            formStatus = 'edit';
            checkFormStatus();
            if (!verifyDates(dateFromPicker(data))){
                $("#datepickeredit").css("border-left-color", "red");
            }else{
                $("#datepickeredit").css("border-left-color", "lawngreen");
            }
        } else {
            createInfoPopup(selected_etapa, name);
            formStatus = null;
            checkFormStatus();
        }
    })

    //Feedback de uma etapa - mudar popup
    $('body').on("click", "#feedbackEtapaButton", function(){
        showPopup();
        showGroups(proj);
        var name = $("#etapa" + selected_etapa).find("p:first").text();
        if(formStatus != 'feedback'){
            createFeedbackPopup();
            formStatus = 'feedback';
            checkFormStatus();
        } else {
            createInfoPopup(selected_etapa, name);
            formStatus = null;
            checkFormStatus();
        }
    })

    //Remover etapa do projeto - icon on click - criar popup
    $('body').on('click', '.delete_img', function(){
        formStatus = null;
        checkFormStatus();
        showPopup();
        selected_etapa = $(this).attr("id").replace("delete","");
        console.log(selected_etapa);
        var name = $("#etapa" + selected_etapa).find("p:first").text();
        createRemoveEtapaPopup(name);
    })

//Outros eventos - on click, on change, etc

    //POPUPS - Esconder
    $('body').on('click', '.cd-popup', function(){
        if($(event.target).is('.cd-popup-close') || $(event.target).is('.cd-popup') || $(event.target).is('#closeButton')){
            event.preventDefault();
            hidePopup();
            $(".moreInfoButtons").css("background-color", "white");
        }
    })

    //REMOVER PROJETO - Confirmar
    $("body").on('click', '#confirmRemove', function(){
        delete_projeto();
    })

    //ADICIONAR ENUNCIADO - File Input
    $("body").on('change', "#file_projeto", function(){
        if($("#file_projeto").val() != ""){
            $("#name-enunciado-proj").text(escapeHtml($("#file_projeto").val().split('\\').pop()));
            $("#file-img").attr('src',base_url+"images/icons/check-solid.png");
            //msg de sucesso - "enunciado adicionado com sucesso -> session php com o valor da msg"
        } else {
            $("#name-enunciado-proj").text("Envie o ficheiro do enunciado");
            $("#file-img").attr('src',base_url+"images/icons/upload-solid.png");
            $("#error-popup").text("Selecione um ficheiro");
            $("#error-popup").show().delay(3000).fadeOut();
        }
    })

    //ADICIONAR ENUNCIADO - Confimar 
    $("body").on("click", "#addEnunciado", function(e){
        enunc = escapeHtml($("#file_projeto").val().split('\\').pop());
        if (enunc.length == 0){
            $("#error-popup").text("Selecione um ficheiro");
            $("#error-popup").show().delay(3000).fadeOut();
            e.preventDefault();
        } else {
            if($("#file_projeto")[0].files[0].size < 5024000){
                //msg de sucesso - reformular msgs de sucesso
                // submit_new_enunciado(enunc);
                $("#enunciado-form")[0].submit();
                console.log(enunc);
            } else {
                $("#error-popup").text("Ficheiro ultrapassa o limite máximo de 5MB");
                $("#error-popup").show().delay(3000).fadeOut();
                e.preventDefault();
            }
        }
    })

    //Remover Projeto
    $('body').on('click', '#removeEnunciadoProj', function(){
        $("#enunciado_h4").text('Este projeto não tem enunciado');
        removeEnunciadoProj();
    })

    //on change mudar a etapa (variavel) - NOVA ETAPA
    $("body").on("change", "#etapa-form", function(){
        var name = escapeHtml($(this).find('input[name="etapaName"]').val());
        var desc = escapeHtml($(this).find('textarea[name="etapaDescription"]').val());
        var data = dateFromPicker($(this).find('input[name="etapaDate"]').val());
        var enunc = '';
        
        etapa['nome'] = name;
        etapa['desc'] = desc;
        etapa['data'] = data;
        etapa['enunciado'] = enunc;

        if (!verifyDates(data)){
            $("#etapa-form input[name='etapaDate']").css("border-left-color", "red");
        } else {
            $("#etapa-form input[name='etapaDate']").css("border-left-color", "lawngreen");
        }
    })

    //Criar NOVA etapa - CONFIRMAR
    $("body").on("click", "#newEtapa", function(){
        submit_etapa();
    })

    //on change selecionar ficheiro - input - ADICIONAR ENUNCIADO ETAPA
    $("body").on("change", "#file_etapa", function(){
        if($("#file_etapa").val() != ""){
            $("#name-enunciado-etapa").text(escapeHtml($("#file_etapa").val().split('\\').pop()));
            $("#file-img-etapa").attr('src',base_url+"images/icons/check-solid.png");
        } else {
            $("#name-enunciado-etapa").text("Envie o ficheiro do enunciado");
            $("#file-img-etapa").attr('src',base_url+"images/icons/upload-solid.png");
            $("#error-popup").text("Selecione um ficheiro");
            $("#error-popup").show().delay(3000).fadeOut();
        }
    })

    //ADICIONAR ENUNCIADO ETAPA - Confirmar
    $('body').on("click", "#addEnuncEtapa", function(e){
        enunc = escapeHtml($("#file_etapa").val().split('\\').pop());
        if (enunc.length == 0){
            $("#error-popup").text("Selecione um ficheiro");
            $("#error-popup").show().delay(3000).fadeOut();
            e.preventDefault();
        } else {
            if($("#file_etapa")[0].files[0].size < 5024000){
                // submit_new_etapa_enunciado(enunc);
                $("#form-upload-etapa")[0].submit();
            } else {
                $("#error-popup").text("Ficheiro ultrapassa limite de 5MB");
                $("#error-popup").show().delay(3000).fadeOut();
                $("#file-img-etapa").attr('src',base_url+"images/icons/upload-solid.png");
                $("#file_etapa").val("");
                e.preventDefault();
            }
        }
    })

    //On change editar etapa -> editar etapa
    $("body").on("change", "#etapa-form-edit", function(){
        var name = escapeHtml($(this).find('input[name="editetapaName"]').val());
        var desc = escapeHtml($(this).find('textarea[name="editetapaDescription"]').val());
        var data = dateFromPicker($(this).find('input[name="editetapaDate"]').val());
        
        etapa['nome'] = name;
        etapa['desc'] = desc;
        etapa['data'] = data;

        if (!verifyDates(data)){
            $("#etapa-form-edit input[name='etapaDate']").css("border-left-color", "red");
        } else {
            $("#etapa-form-edit input[name='etapaDate']").css("border-left-color", "lawngreen");
        }
    })

    
    //EDITAR ETAPA - Confirmar
    $("body").on("click", "#newEtapaEDIT", function(){
        submit_edit_etapa(); 
    })

    //FEEDBACK ETAPA - Select on change -> get submissoes
    $("body").on("change", "#select_grupo_feedback", function(){
        var grupo_id = escapeHtml($(this).val());
        getSumbission(grupo_id, selected_etapa, proj);
    })

    $("body").on("click", "#confirmFeedback", function(){
        submit_feedback(escapeHtml($('textarea[name="feedback-text"]').val()), selected_etapa, escapeHtml($("#select_grupo_feedback :selected").val()));
    })

    //Remover Enunciado de uma etapa
    $('body').on('click', '#removeEnunciado', function(e) {
        etapa_clear_enunciado();
    })

    // REMOVER ETAPA - Confirmar
    $("body").on('click', "#confirmRemoveEtapa", function(){
        removeEtapa(selected_etapa);
        // getEtapas(proj);
    })
    
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

function setMsg(msg, type){

    const arr = {
        msg : msg,
        type : type
    }

    msg_res = arr;
}

function setEnunciadoOriginal(url){
    enunciado_original = url;
}

// Funções GET - metem conteudo na pagina

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
                // console.log(data["nomes"]);

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
            // console.log(data["data_final"]);
            checkEntrega(data["data_final"]);
        },
        error: function(data) {
            console.log("Erro na API - Get Etapa")
            console.log(data)
        }
    });
}

function getSumbission(grupo_id, etapa, proj){
    const data = {
        grupo_id : grupo_id,
        etapa_id : etapa
    }

    $.ajax({
        type: "GET",
        url: base_url + "api/getSub",
        data: data,
        success: function(data) {
            console.log(data)
            if (data.length > 0){
                var base_link = base_url + "uploads/submissions/" + proj + "/" + etapa + "/";
                var extension = data[0]["submit_url"].split(".").pop();
                $("#sub_url").html('<a target="_blank" href="'+base_link+data[0]["submit_url"]+'">' + data[0]["submit_original"] + '</a>');
                $("#confirmFeedback").show();
                $("textarea[name='feedback-text']").prop("disabled", false);

                if (data[0]["feedback"] == ""){
                    $("#fb_content").text("Ainda não foi atribuido feedback a esta etapa.");
                } else {
                    $("#fb_content").text(data[0]["feedback"]);
                }
            } else {
                $("#sub_url").text("Entrega ainda não foi submetida");
                $("#fb_content").text("Ainda não foi atribuido feedback a esta etapa.");
                $("textarea[name='feedback-text']").prop("disabled", true);
                $("textarea[name='feedback-text']").val("");
                $("#error-popup").text("Não é possível atribuir feedback a uma etapa sem submissão");
                $("#error-popup").show().delay(3000).fadeOut();
            }
        },
        error: function(data) {
            console.log("Erro na API - Get Sumbission from Group in Etapa")
            console.log(data)
        }
    });
}


//Funções POST
function submit_feedback(feedback, etapa, grupo_id){
    if (validate_feedback()){
        const data = {
            grupo_id : grupo_id,
            etapa_id : etapa,
            feedback : feedback
        }

        $.ajax({
            type: "POST",
            url: base_url + "api/insertFeedback",
            data: data,
            success: function(data) {
                console.log(data);
                // msg sucesso - canto superior direito - session
                $("textarea[name='feedback-text']").val("");
                $("#sub_url").text('Entrega ainda não foi submetida');
                $("#fb_content").text("Ainda não foi atribuido feedback a esta etapa.");
                location.reload()
            },
            error: function(data) {
                console.log("Erro na API - Dar feedback");
                console.log(data);
                // location.reload();
                $("#error-popup").text("Não foi possível atribuir feedback");
                $("#error-popup").show().delay(3000).fadeOut();
            }
        });
    } else {
        if($("#select_grupo_feedback").val() == ""){
            $("#error-popup").text("Selecione um grupo válido");
        } else if($("textarea[name='feedback-text'").prop("disabled") == true){
            $("#error-popup").text("Não é possível atribuir feedback a uma etapa sem submissão")
        } else {
            $("#error-popup").text("Preencha o feedback");
        }
        //MSGS DE ERRO
        $("#error-popup").show().delay(3000).fadeOut();
        return false;
    }
}

function submit_etapa(){

    if (validate_etapa_description() && verifyDates(etapa["data"])){

        const data = {
            projid : parseInt(proj),
            new_etapa : etapa,
        }

        $.ajax({
            type: "POST",
            url: base_url + "api/createEtapa",
            data: data,
            success: function(data) {
                console.log(proj);
                console.log(data);
                // msg de sucesso canto superior direito - session
                location.reload();
            },
            error: function(data) {
                console.log("Erro na API - Submit Etapa");
                console.log(data);
                // location.reload();
                $("#error-popup").text("Não foi possível submeter a etapa");
                $("#error-popup").show().delay(3000).fadeOut();
            }
        });
    } else {
        //msg de erro
        $("#error-popup").show().delay(3000).fadeOut();
        return false;
    }
}

function submit_edit_etapa(){
    if (verifyDates(etapa["data"])){

        const data = {
            projid : parseInt(proj),
            edited_etapa : etapa,
            id : selected_etapa,
        }

        $.ajax({
            type: "POST",
            url: base_url + "api/editEtapa",
            data: data,
            success: function(data) {
                console.log(data);
                location.reload();
                // msg de sucesso canto superior direito - session
            },
            error: function(data) {
                console.log("Erro na API - Edit Etapa");
                console.log(data);
                $("#error-popup").text("Não foi possível editar a etapa");
                $("#error-popup").show().delay(3000).fadeOut();
            }
        });
    } else {
        //msg de erro
        $("#error-popup").show().delay(3000).fadeOut();
        return false;
    }
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

function etapa_clear_enunciado(){
    const data = {
        projid : parseInt(proj),
        id : selected_etapa,
    }

    $.ajax({
        type: "DELETE",
        url: base_url + "api/removeEnunciadoEtapa/" + selected_etapa,
        data: data,
        success: function(data) {
            console.log("Enunciado da etapa: "+ data + "removido");
            getEtapas(proj);
            $("#removeEnunciado").remove();
            $("#enunciado_label").text("Não existe enunciado associado a esta etapa.");
            $("#success-popup").text("Ficheiro removido com sucesso");
            $("#success-popup").show().delay(3000).fadeOut();
        },
        error: function(data) {
            console.log("Erro na API - Remover enunciado Etapa");
            console.log(data);
        }
    });
}

function removeEtapa(id){
    const data_etapa = {
        etapa_id : id
    }

    $.ajax({
        type: "DELETE",
        url: base_url + "api/removeEtapa/" + id,
        data: data_etapa,
        success: function(data) {
            console.log("mensagem de sucesso");
            // msg de sucesso canto superior direito - session
            hidePopup();
            getEtapas(proj);
            location.reload();

        },
        error: function(data) {
            console.log("Erro na API - Remove Etapa")
            console.log(data)
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
        var enunciado_original = json["enunciado_original"];

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

        array_etapa.push('<div class="etapasDIV" id="etapa' + json["id"] +'">'+
        '<p><img id="delete'+json["id"]+'"src="'+base_url+'images/icons/trash.png" class="delete_img"><b>'+json["nome"]+'</b></p>'+
        '<p class="'+pClass+'">'+ dateFormatter(date) +'</p>'+
        '<p><input class="moreInfoButtons" id="'+json["id"] +'" type="button" value="Opções"></input>'+
        '</p>'+
        '</div><hr>');

        if (enunciado == ""){
            newenunciado = "Não existe enunciado associado a esta etapa."
            removebut = ''
        } else {
            removebut = '<label id="removeEnunciado" class="labelRemove"><img src="'+base_url+'/images/close.png"></label> '
            newenunciado = "<a target='_blank' href='" + base_url + "uploads/enunciados_files/" + proj + "/" + enunciado + "'>" + enunciado_original + "</a>"
        }

        var obj = {
            id: json["id"],
            description: json["description"],
            enunciado:  newenunciado,
            remove: removebut
        };
        etapas_info.push(obj);
    }

   
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
    if (enunciado_h4 != "" && enunciado_original != ""){
        $("#enunciado_h4").html("Enunciado: <a target='_blank' href='"+ base_url + "uploads/enunciados_files/"+ enunciado_h4 +"'>" + enunciado_original + "</a>");
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
    $("#error-popup").remove();
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
    $(".cd-message").after('<div id="error-popup" class="submit-msg">Mensagem de erro template</div>');
    $(".cd-buttons").html('').append("<li><input class='button-popup' id='addEnunciado' type='submit' value='Confirmar'>" +
        "</li><li><a href='#' id='closeButton'>Cancelar</a></li>");
}


function createEtapaPopup(){
    content = '<form id="etapa-form" action="javascript:void(0)">' +
    '<label id="etapa-label" class="form-label-title">Nova etapa:</label>'+
    '<label class="form-label">Nome</label><input class="form-input-text" type="text" name="etapaName" required>'+
    '<label class="form-label">Descrição</label><textarea class="form-text-area" type="text" name="etapaDescription" required></textarea>'+
    '<label class="form-label" id="date-picker-label">Data de entrega'+
    '<input class="form-input-text" id="datepickernew" name="etapaDate" autocomplete="off" readonly="readonly" required></label>'+
    '</form><div id="placeholder-picker-new"></div>' 

    $(".cd-message").html(content);
    $(".cd-message").after('<div id="error-popup" class="submit-msg">Mensagem de erro template</div>');
    $(".cd-buttons").html('').append("<li><a href='#' id='newEtapa'>" +
        "Confirmar</a></li><li><a href='#' id='closeButton'>Cancelar</a></li>");

    const etapapicker = new WindowDatePicker({
        el: '#placeholder-picker-new',
        toggleEl: '#datepickernew',
        inputEl: '#datepickernew',
        type: 'DATEHOUR',
        hourType: "24",
        allowEmpty: "FALSE",
        lang: "pt",
        orientation: true,
    });

    //evento - date picker popup new etapa
    etapapicker.el.addEventListener('wdp.change', () => {
        var data = dateFromPicker($("#datepickernew").val());

        if(!$("#footer-dpnew").length){
            $("#placeholder-picker-new .wdp-container").append("<div id='footer-dpnew' class='datepickerfooter'><input id='hidedatepicker' type='button' value='Confirmar'></div>");
        }

        etapa['data'] = data;

        if (!verifyDates(data)){
            $("#datepickernew").css("border-left-color", "red");
        } else {
            $("#datepickernew").css("border-left-color", "lawngreen");
        }

    });    


    $("body").on("click", "#hidedatepicker", function(){
        etapapicker.close();
    })
}

function createInfoPopup(etapa_rec, name){
    var etapa;
    for (i=0; i<etapas_info_global.length; i++){
        if(etapa_rec == etapas_info_global[i].id){
            etapa = etapas_info_global[i];
        }
    }

    content = '<h3>Etapa "'+name+'"</h3><h3>Descrição:</h3><label>'+etapa["description"]+
        '</label><div id="success-popup" class="submit">Mensagem de sucesso template</div><h3>Enunciado: </h3>'+
        '<label id="enunciado_label">'+etapa["enunciado"]+'</label>' +
        '<div id="popup-form"></div>'+
        '<div class="wrapper"><hr><input id="addEtapaEnunciado" class="addE" type="button" value="Enunciado">' +
        '<input id="editEtapaButton" class="editb" type="button" value="Editar">' +
        '<input id="feedbackEtapaButton" class="feedbackb" type="button" value="Feedback">' +
        '<br></div>'

    $(".cd-message").html(content);
    $("#enunciado_label").append(etapa["remove"]);
    $(".cd-buttons").html('');
}


function createEnunciadoEtapaPopup(){
    form = '<form enctype="multipart/form-data" accept-charset="utf-8" method="post" id="form-upload-etapa" action="'+base_url + 'UploadsC/uploadEnunciadoEtapa/' + proj + "/" + selected_etapa +'">' +
    '<br><input class="form-input-file" type="file" id="file_etapa" name="file_etapa" accept=".pdf">'+
    '<label for="file_etapa" class="input-label">'+
    '<img id="file-img-etapa" class="file-img" src="'+base_url+'images/icons/upload-solid.png">'+
    '<span id="name-enunciado-etapa" class="span-name">Envie o ficheiro do enunciado</span></label>'+
    '<p class="msg-warning-size"><b>Tamanho máximo de ficheiro é de 5MB</b></p></form>'

    $("#popup-form").html(form);
    $("#error-popup").remove();
    $(".cd-message").after('<div id="error-popup" class="submit-msg">Mensagem de erro template</div>');
    $(".cd-buttons").html('').append("<li><input class='button-popup' id='addEnuncEtapa' type='submit' value='Confirmar'>" +
    "</li><li><a href='#' id='closeButton'>Cancelar</a></li>");
}

function createEditPopup(name, data, desc){
    form = '<form id="etapa-form-edit" action="javascript:void(0)">' +
    '<label id="etapa-label-edit" class="form-label-title">Editar etapa '+name+':</label>' +
    '<label class="form-label-title">Nome</label><input class="form-input-text" type="text" name="editetapaName" required>'+
    '<label class="form-label-title">Descrição</label>' +
    '<textarea class="form-text-area" type="text" name="editetapaDescription" required></textarea>'+
    '<label class="form-label-title" id="date-picker-label">Data de entrega' +
    '<input class="form-input-text" id="datepickeredit" name="editetapaDate" autocomplete="off" readonly="readonly" required>'+
    '<div id="placeholder-picker-edit"></div></label></form>' +
    '<div class="wrapper"><hr><input id="addEtapaEnunciado" class="addE" type="button" value="Enunciado">' +
    '<input id="editEtapaButton" class="editb" type="button" value="Editar">' +
    '<input id="feedbackEtapaButton" class="feedbackb" type="button" value="Feedback">' +
    '<br></div>'

    $(".cd-message").html(form);
    $("#error-popup").remove();
    $(".cd-message").after('<div id="error-popup" class="submit-msg">Mensagem de erro template</div>');
    $('.cd-message input[name="editetapaName"]').val(name);
    $('.cd-message textarea[name="editetapaDescription"]').val(desc);
    etapa['nome'] = name;
    etapa['desc'] = desc;
    etapa['data'] = dateFromPicker(data);

    const editpicker = new WindowDatePicker({
        el: '#placeholder-picker-edit',
        toggleEl: '#datepickeredit',
        inputEl: '#datepickeredit',
        type: 'DATEHOUR',
        hourType: "24",
        allowEmpty: "FALSE",
        lang: "pt",
        orientation: true,
    });

    editpicker.set(data);
    if (editpicker.value!=null){
        $("#placeholder-picker-edit .wdp-container").append("<div id='footer-dpedit' class='datepickerfooter'><input id='hidedatepicker' type='button' value='Confirmar'></div>");
    }

    editpicker.el.addEventListener('wdp.change', () => {
        var data = dateFromPicker($("#datepickeredit").val());

        etapa['data'] = data;
        if(!$("#footer-dpedit").length){
            $("#placeholder-picker-edit .wdp-container").append("<div id='footer-dpedit' class='datepickerfooter'><input id='hidedatepicker' type='button' value='Confirmar'></div>");
        }

        if (!verifyDates(data)){
            $("#datepickeredit").css("border-left-color", "red");
        }else{
            $("#datepickeredit").css("border-left-color", "lawngreen");
        }
    });

    $("body").on("click", "#hidedatepicker", function(){
        editpicker.close();
    })

    $(".cd-buttons").html('').append("<li><input form='etapa-form-edit' class='button-popup' id='newEtapaEDIT' type='submit' value='Confirmar'>" +
    "</li><li><a href='#' id='closeButton'>Cancelar</a></li>");
}

function createFeedbackPopup(){
    form = '<form id="feedback-div" action="javascript:void(0)">'+
    '<label class="form-label-title">Selecione o grupo</label>'+
    '<select id="select_grupo_feedback" name="GrupoSelect"></select><label for="file" class="form-label-title">Entrega:</label>'+
    '<p id="sub_url">Entrega ainda não foi submetida</p><label class="form-label-title">Feedback dado:</label>'+
    '<p id="fb_content">Ainda não atribuiu feedback a esta etapa</p><label class="form-label-title">Dar feedback:</label>'+
    '</form>'+
    '<textarea class="form-text-area" type="text" name="feedback-text" disabled required></textarea>'+
    '<div class="wrapper"><hr><input id="addEtapaEnunciado" class="addE" type="button" value="Enunciado">' +
    '<input id="editEtapaButton" class="editb" type="button" value="Editar">' +
    '<input id="feedbackEtapaButton" class="feedbackb" type="button" value="Feedback">' +
    '<br></div>'

    $(".cd-message").html(form);
    $("#error-popup").remove();
    $(".cd-message").after('<div id="error-popup" class="submit-msg">Mensagem de erro template</div>');
    $(".cd-buttons").html('').append("<li><input form='feedback-div' class='button-popup' id='confirmFeedback' type='submit' value='Confirmar'>" +
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

function verifyDates(data){
    if (data == ""){
        $("#error-popup").text("Preencha todos os campos");
        return false;
    }

    var dmaior = new Date(data);
    var today = new Date();
    var dParse = Date.parse(dmaior);

    if (isNaN(dParse)){
        $("#error-popup").text("Data tem de ser maior que a atual");
        return false;
    }

    if (dmaior <= today){
        $("#error-popup").text("Data tem de ser maior que a atual");
        return false;
    }
    return true;
}

function validate_etapa_description(){
    if($("textarea[name='etapaDescription']").val() != ''){
        return true
    }
    $("#error-popup").text("Preencha todos os campos");
    return false;
}

function checkFormStatus(){
    if(formStatus == 'edit'){
        $("#opennewEtapa").css('background-color','white');
        $(".editb").css('background-color','rgb(153, 156, 155)');
        $(".feedbackb").css('background-color','white');
        $(".addE").css('background-color','white');
    } else if(formStatus == 'new'){
        $("#opennewEtapa").css('background-color','rgb(153, 156, 155)');
        $(".editb").css('background-color','white');
        $(".feedbackb").css('background-color','white');
        $(".addE").css('background-color','white');
    } else if(formStatus == 'feedback'){
        $(".feedbackb").css('background-color','rgb(153, 156, 155)');
        $("#opennewEtapa").css('background-color','white');
        $(".editb").css('background-color','white');
        $(".addE").css('background-color','white');
    } else if(formStatus == 'addEnunc'){
        $("#opennewEtapa").css('background-color','white');
        $(".editb").css('background-color','white');
        $(".feedbackb").css('background-color','white');
        $(".addE").css('background-color','rgb(153, 156, 155)');
    } else {
        $("#opennewEtapa").css('background-color','white');
        $(".editb").css('background-color','white');
        $(".feedbackb").css('background-color','white');
        $(".addE").css('background-color','white');
    }
}

function validate_feedback(){
    if ($("textarea[name='feedback-text']").val() != '' && $("#select_grupo_feedback").val() != ''){
        return true
    }
    return false;
}

function createRemoveEtapaPopup(name){
    $(".cd-message").html("<p>Tem a certeza que deseja eliminar a etapa '"+name+"' ?</p>");
    $(".cd-buttons").html('').append("<li><a href='#' id='confirmRemoveEtapa' class='red-a'>" +
        "Sim</a></li><li><a href='#' id='closeButton'>Não</a></li>");
}