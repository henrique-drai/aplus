var proj
var enunciado_h4
var back_page
var selected_etapa
var etapa = {nome:'', desc:'', enunciado:'', data:''};
var updated_enunc_etapa;
var formStatus = null;
var etapas_info_global;

$(document).ready(() => {

    //GRUPOS ---

    //tabela dos grupos
    showGroups(proj);

    // --- GRUPOS

    //REMOVER PROJETO ---

	//open popup - REMOVER PROJETO
	$('#removeProject').on('click', function(event){
        formStatus = null;
        checkFormStatus();
        event.preventDefault();
        makePopup("confirmRemove", "Tem a certeza que deseja eliminar o projeto?");
	});
	
	//remove popup - REMOVER PROJETO
	$('body').on('click', '.cd-popup', function(event){
		if( $(event.target).is('.cd-popup-close') || $(event.target).is('.cd-popup') || $(event.target).is('#closeButton') ){
            event.preventDefault();
            $(".cd-popup").remove();
		}
    });
    

    //hide popup - usado no criar etapa por enquanto só
    $('body').on("click", ".cd-popup2", function(event){
        if( $(event.target).is('.cd-popup-hide') || $(event.target).is('#closeButton-hide') || $(event.target).is('.cd-popup2') ){
            event.preventDefault();
            $(this).hide();
            $(".cd-buttons").hide();
            $(".moreInfoButtons").css("background-color", "white");
            $("#etapa-form-edit").hide();
            $("#feedback-form").hide();
            $("#form-upload-etapa").hide();
            $(".form-input-file").val("");
            $(".span-name").text("Envie o ficheiro do enunciado");
            $(".file-img").attr('src',base_url+"images/icons/upload-solid.png");
            formStatus = null;
            checkFormStatus();
		}
    })



    //confirmed delete do popup - REMOVER PROJETO
    $("body").on('click', '#confirmRemove', function(){
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
    })

    //--- REMOVER PROJETO

    //ENUNCIADO PROJETO --- 

    //verificar se o enunciado do projeto existe na diretoria 
    
    if(checkEnunciado()){
        setInterval(function(){
            checkEnunciado();
        }, 1000);
    }

    
    //file enunciado projeto selected - MUDAR ENUNCIADO
    $("#file_projeto").on('change', function(){
        $("#addEnunciado").show();
        
        console.log($("#file_projeto").val());

        if($("#file_projeto").val() != ""){
            $("#name-enunciado-proj").text($("#file_projeto").val().split('\\').pop());
            $("#file-img").attr('src',base_url+"images/icons/check-solid.png");
        } else {
            $("#name-enunciado-proj").text("Envie o ficheiro do enunciado");
            $("#file-img").attr('src',base_url+"images/icons/upload-solid.png");
            $("#addEnunciado").hide();
        }

    })



    //ao confirmar - MUDAR ENUNCIADO
    $("#addEnunciado").on('click', function(e){
        enunc = $("#file_projeto").val().split('\\').pop();
        if (enunc.length == 0){
            $("#projenuncerror").text("Tem de selecionar um ficheiro");
            $("#projenuncerror").show().delay(2500).fadeOut();
            e.preventDefault();
        } else {
            if($("#file_projeto")[0].files[0].size < 5024000){
                enunc = $("#file_projeto").val().split('\\').pop();
                $("#projenuncsucc").show().delay(2500).fadeOut();
                submit_new_enunciado(enunc);
                $("#enunciado-form").submit();
            } else {
                $("#projenuncerror").text("Ficheiro ultrapassa o limite máximo de 5MB");
                $("#projenuncerror").show().delay(2500).fadeOut();
                e.preventDefault();
            }
        }
    })

    //--- ENUNCIADO PROJETO

    //--- ENUNCIADO ETAPA

    $("#file_etapa").on('change', function(){


        if($("#file_etapa").val() != ""){
            $("#name-enunciado-etapa").text($("#file_etapa").val().split('\\').pop());
            $("#file-img-etapa").attr('src',base_url+"images/icons/check-solid.png");
        } else {
            $("#name-enunciado-etapa").text("Envie o ficheiro do enunciado");
            $("#file-img-etapa").attr('src',base_url+"images/icons/upload-solid.png");
            $("#errormsgenunc").text("Tem de selecionar um ficheiro");
            $("#errormsgenunc").show().delay(1500).fadeOut();
        }

    })

    $('body').on("click", "#addEnuncEtapa", function(e){
        enunc = $("#file_etapa").val().split('\\').pop();
        console.log(enunc);
        if (enunc.length == 0){
            $("#errormsgenunc").text("Tem de selecionar um ficheiro");
            $("#errormsgenunc").show().delay(2500).fadeOut();
        } else {
            if($("#file_etapa")[0].files[0].size < 5024000){
                $("#form-upload-etapa").submit();
                submit_new_etapa_enunciado(enunc);
            } else {
                $("#errormsgenunc").text("Ficheiro ultrapassa o limite de 5MB");
                $("#errormsgenunc").show().delay(2500).fadeOut();
                $("#name-enunciado-etapa").text("Envie o ficheiro do enunciado");
                $("#file-img-etapa").attr('src',base_url+"images/icons/upload-solid.png");
                $("#file_etapa").val("");
                e.preventDefault();
            }
        }
    })

    //ETAPAS --- 



    // getEtapas - ETAPAS
    getEtapas(proj);

    $("#entrega_h3").text("Entrega final:");

    // // refresh tabela 1 vez para atualizar a data - ETAPAS
    // checkEntrega();


    // show etapa form - CRIAR NOVA ETAPA 
    $("body").on("click", "#opennewEtapa", function(){
        $("#etapa-form").show();
        $("#newEtapa").show();
        $("#etapa-form-popup").show();
        $("#etapa-form-popup").css('visibility', 'visible');
        $("#etapa-form-popup").css('opacity', '1');
        $("#etapa-label").text("Nova etapa:");
        $("#ul-buttons-etapa").show();

        $("#etapa-form-edit").hide();
        $("#feedback-form").hide();
        $("#form-upload-etapa").hide();
        emptyEtapa();

        if(formStatus != 'new'){
            formStatus = 'new';
            checkFormStatus();
        } else {
            formStatus = null;
            checkFormStatus();
        }

    });


    //show feedback etapa - FEEDBACK ETAPA
    $('body').on("click", "#feedbackEtapaButton", function(){

        $("#ul-buttons").find("li:first").find("a").prop("id", "confirmFeedback");

        $("#etapa-form").hide();
        $("#etapa-form-edit").hide();
        $("#form-upload-etapa").hide();

        $("#feedback-form").show();
        $(".inputs-div").hide();
        showGroups(proj);

        if(formStatus != 'feedback'){
            formStatus = 'feedback';
            $("#ul-buttons").show();
            checkFormStatus();
        } else {
            formStatus = null;
            checkFormStatus();
            $(".inputs-div").show();
            $("#ul-buttons").hide();
            $("#feedback-form").hide();
        }

    });


    // ir buscar submission - FEEDBACK ETAPA
    $('#select_grupo_feedback').on('change', function(){
        var grupo_id = $(this).val();
        getSumbission(grupo_id, selected_etapa, proj);
    })

    //show editar etapa form - EDITAR ETAPA
    $('body').on("click", "#editEtapaButton", function(){
        
        $("#ul-buttons").find("li:first").find("a").prop("id", "newEtapaEDIT");

        $("#etapa-form").hide();
        $("#feedback-form").hide();
        $("#form-upload").hide();
        $(".inputs-div").hide();
        $("#form-upload-etapa").hide();

        $("#etapa-form-edit").show();
        $("#etapa-label-edit").text("Editar etapa '" + $("#etapa" + selected_etapa).find("p:first").text() + "':");
        


        putEtapaInfoForm(selected_etapa);

        if(formStatus != 'edit'){
            formStatus = 'edit';
            $("#ul-buttons").show();
            checkFormStatus();
        } else {
            formStatus = null;
            checkFormStatus();
            emptyEtapa();
            $(".inputs-div").show();
            $("#ul-buttons").hide();
            $("#etapa-form-edit").hide();
        }

    });


    //ADICIONAR ENUNCIADO - ETAPA
    $('body').on('click', "#addEtapaEnunciado", function(){
        $("#etapa-form-edit").hide();
        $("#etapa-form").hide();
        $("#feedback-form").hide();
        $("#form-upload-etapa").show();
        $(".inputs-div").show();
        $("#ul-buttons").show();

        $("#ul-buttons").find("li:first").find("a").prop("id", "addEnuncEtapa");
        console.log($("#addEnuncEtapa"));

        if(formStatus != 'addEnunc'){
            formStatus = 'addEnunc';
            checkFormStatus();
        } else {
            formStatus = null;
            $("#ul-buttons").hide();
            checkFormStatus();
            $("#etapa-form").hide();
            $("#form-upload-etapa").hide();
        }

    })

    //on change mudar a etapa (variavel) - NOVA ETAPA
    $("#etapa").change(function(){
        var name = $(this).find('input[name="etapaName"]').val();
        var desc = $(this).find('textarea[name="etapaDescription"]').val();
        var data = $(this).find('input[name="etapaDate"]').val();
        var enunc = '';
        
        etapa['nome'] = name;
        etapa['desc'] = desc;
        etapa['data'] = data;
        etapa['enunciado'] = enunc;

        if (!verifyDates(data)){
            $("#etapa input[name='etapaDate']").css("border-left-color", "red");
        } else {
            $("#etapa input[name='etapaDate']").css("border-left-color", "lawngreen");
        }
    })

    //on change mudar a etapa (variavel) - EDITAR ETAPA
    $("#etapa-edit").change(function(){
        var name = $(this).find('input[name="editetapaName"]').val();
        var desc = $(this).find('textarea[name="editetapaDescription"]').val();
        var data = $(this).find('input[name="editetapaDate"]').val();
        var enunc = '';
        
        etapa['nome'] = name;
        etapa['desc'] = desc;
        etapa['data'] = data;
        etapa['enunciado'] = enunc;

        if (!verifyDates(data)){
            $("#etapa-edit input[name='editetapaDate']").css("border-left-color", "red");
        } else {
            $("#etapa-edit input[name='editetapaDate']").css("border-left-color", "lawngreen");
        }
    })

    // abrir pop up - REMOVER ETAPA
    $("body").on('click', "#removeEtapaButton", function(){
        $("#etapa-form-edit").hide();
        $("#etapa-form").hide();
        $("#feedback-form").hide();
        $("#form-upload-etapa").hide();
        formStatus = null;
        checkFormStatus();
        $("#ul-buttons").hide();
        $(".inputs-div").show();
        makePopup('confirmRemoveEtapa','Tem a certeza que deseja eliminar esta etapa?');    
    })
    

    // REMOVER ETAPA
    $("body").on('click', "#confirmRemoveEtapa", function(){
        $('.cd-popup').remove();
        removeEtapa(selected_etapa);
        getEtapas(proj);
        $(".cd-popup2").hide();
    })


    //mostrar info extra da etapa - TABELA ETAPAS
    $('body').on('click', '.moreInfoButtons', function(){
        
        selected_etapa = $(this).attr("id");
        $("#form-upload-etapa").attr('action', base_url + 'UploadsC/uploadEnunciadoEtapa/' + proj + '/' + selected_etapa);

        updateEtapaPopup(selected_etapa);

        etapa_name = $("#etapa" + selected_etapa).find("p").find("b").text();

        $(".cd-popup-container").find("h3:first").text("Etapa: '" + etapa_name + "'");


        if ($(this).css("background-color") == "#75a790"){
            $(this).css("background-color", "white");
        } else {
            $(this).css("background-color", "#75a790");
        }

        if(etapas_info_global.length == 1){
            $('#removeEtapaButton').prop('disabled', true);
        } else {
            $('#removeEtapaButton').prop('disabled', false);
        }

        
    })


    //remover enunciado etapa
    $('body').on('click', '#removeEnunciado', function(e) {
        etapa_clear_enunciado();
        getEtapas(proj);
        $("#"+selected_etapa).css("background-color", "#75a790");
    })

    //remover enunciado projeto
    $('body').on('click', '#removeEnunciadoProj', function(){
        $("#enunciado_h4").text('Este projeto não tem enunciado');
        removeEnunciadoProj();
    })

    //criar etapa
    $("#newEtapa").click(() => submit_etapa());


    //editar etapa 
    $("body").on("click", "#newEtapaEDIT", function(){
        $("#etapa-form-edit").submit();
        submit_edit_etapa();
    })


    //submit feedback
    $("body").on("click", "#confirmFeedback", function(){
        $("#feedback-div").submit();
        submit_feedback($('textarea[name="feedback-text"]').val(), selected_etapa, $("#select_grupo_feedback :selected").val());
    })

    //enunciado - projeto
    $("body").on("click", "#openEnunc", function(){
        $("#enunciado-popup").css("visibility", "visible");
        $("#enunciado-popup").css("opacity", "1");
        $("#enunciado-popup").show();
        $("#ul-buttons-enunc").show();
        
        $("#enunciado-form").attr('action', base_url + 'UploadsC/uploadEnunciadoProjeto/' + proj);

    })


    //--- ETAPAS
    
})


function checkEnunciado(){
    //pensar em mudar isto para chamada ajax mesmo.
    $.get(base_url + "uploads/enunciados_files/"+ proj+".pdf")
        .done(function() { 
            // var removebut = '<label id="removeEnunciadoProj" class="labelRemove"><img src="'+base_url+'/images/close.png"></label> ';
            if (enunciado_h4 != ""){
                $("#enunciado_h4").html("Enunciado: <a target='_blank' href='"+ base_url + "uploads/enunciados_files/"+ proj+".pdf'>" + enunciado_h4 + "</a>");
            } else {
                $("#enunciado_h4").text("Enunciado: <a target='_blank' href='"+ base_url + "uploads/enunciados_files/"+ proj+".pdf'>" + proj + ".pdf </a>");
            }
            // $("#removeDiv").html(removebut);
            $("#openEnunc").val("Editar Enunciado");
            return true;
        })
        .fail(function() { 
            $("#enunciado_h4").text("Este projeto ainda não tem enunciado.")
            $("#openEnunc").val("Adicionar Enunciado");
            return false;
        })
}


function strToDate(dtStr) {
    let dateParts = dtStr.split("/");
    let timeParts = dateParts[2].split(" ")[1].split(":");
    dateParts[2] = dateParts[2].split(" ")[0];
    return dateObject = new Date(dateParts[2], dateParts[1] - 1, +dateParts[0], timeParts[0], timeParts[1], timeParts[2]); 
}

//limpar os campos preenchidos
function emptyEtapa(){
    $('#etapa-form')[0].reset();
}

//preencher form da etapa com a info relativa à etapa
function putEtapaInfoForm(newid){
    var name = $("#etapa" + newid).find("p:first").text();
    var data = $("#etapa" + newid).find("p:nth-child(2)").text().replace(",","");
    data +=":00";
    var desc = $(".cd-popup-container").find("label:first").text();
    var newdata = strToDate(data).toISOString();
    var finaldata = newdata.substring(0,newdata.length-1);

    $('input[name="editetapaName"]').val(name);
    $('input[name="editetapaDate"]').val(finaldata);
    $('textarea[name="editetapaDescription"]').val(desc);

    etapa['nome'] = name;
    etapa['desc'] = desc;
    etapa['data'] = finaldata;
}


function makePopup(butID, msg){
    popup = '<div class="cd-popup" role="alert">' +
        '<div class="cd-popup-container">' +
        '<p>'+ msg +'</p>' +
        '<ul class="cd-buttons" id="red-buttons">' +
        '<li><a href="#" id="'+ butID +'">Sim</a></li>' +
        '<li><a href="#" id="closeButton">Não</a></li>' +
        '</ul>' +
        '<a class="cd-popup-close"></a>' +
        '</div></div>'

    $("#popups").append(popup);
    $(".cd-popup").css('opacity', '1');
    $(".cd-popup").css('visibility', 'visible');
}

function checkEntrega(dateOld){

    date = dateFormatter(new Date(dateOld));

    if(date == ''){
        $("#entrega_h3").text("Entrega final: Ainda não definida");
    } else {
        $("#entrega_h3").text("Entrega final: " + date);
    }
}


//muito parecido ao verifyDates do projectsNEW.js, só muda o set do errormsg
function verifyDates(data){

    if (data == ""){
        $("#errormsgedit").text("Todos os campos devem ser preenchidos");
        $("#errormsgedit").show().delay(2500).fadeOut();
        return false;
    }

    var dmaior = new Date(data);
    var today = new Date();

    var dParse = Date.parse(dmaior);

    if (isNaN(dParse)){
        $("#errormsgedit").text("A data da etapa tem de ser maior que a data atual");
        $("#errormsgedit").show().delay(2500).fadeOut();
        return false;
    }

    if (dmaior <= today){
        $("#errormsgedit").text("A data da etapa tem de ser maior que a data atual");
        $("#errormsgedit").show().delay(2500).fadeOut();
        return false;
    }

    return true;
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
                $("#successmsg_criar").show();
                console.log(proj);
                console.log(data);
                setTimeout(function(){ 
                    location.reload();
                }, 500); 
            },
            error: function(data) {
                console.log("Erro na API - Submit Etapa");
                console.log(data);
            }
        });
    } else {
        $("#errormsg").show().delay(2500).fadeOut();
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
                $("#successmsg_editar").show();
                setTimeout(function(){ 
                    location.reload();
                }, 500); 
                console.log(data);
           
            },
            error: function(data) {
                console.log("Erro na API - Edit Etapa");
                console.log(data);
            }
        });
    } else {
        $("#errormsg").show().delay(2500).fadeOut();
        return false;
    }
}


function validate_etapa_description(){
    if($("textarea[name='etapaDescription']").val() != ''){
        return true
    }

    $("#errormsg").text('Todos os campos devem ser preenchidos');
    return false;
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
            $("#removeEnunciado").hide();
            $("#enunciado_label").text("Não existe enunciado associado a esta etapa.");
            // $("#div"+data).find('p').last().text("Não existe enunciado associado a esta etapa.");
        },
        error: function(data) {
            console.log("Erro na API - Remover enunciado Etapa");
            console.log(data);
        }
    });
}


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
            $("#enunciado_h4").html("<a target='_blank' href='"+ base_url + "uploads/enunciados_files/"+ proj+".pdf'>" + data + "</a>");
        },
        error: function(data) {
            console.log("Erro na API - Edit Enunciado");
            console.log(data);
        }
    });

}

function submit_new_etapa_enunciado(enunc){
    console.log(enunc);
    const data = {
        etapaid : selected_etapa,
        enunciado : enunc,
    }

    $.ajax({
        type: "POST",
        url: base_url + "api/editEtapaEnunciado",
        data: data,
        success: function(data) {
            console.log(data);
            console.log(selected_etapa);
            $("#successmsgenunc").text("Enunciado adicionado com sucesso");
            $('#file_etapa').css("border-left-color", "rgb(124, 124, 124)");
            $("#successmsgenunc").show().delay(2500).fadeOut();
            var removebut = removebut = '<label id="removeEnunciado" class="labelRemove"><img src="'+base_url+'/images/close.png"></label> '
            $("#enunciado_label").html("<a target='_blank' href='"+ base_url + "uploads/enunciados_files/"+ proj+ "/" + selected_etapa+".pdf'>" + data + "</a>" + removebut);
            console.log(base_url + "uploads/enunciados_files/"+ proj + "/" + selected_etapa);
        },
        error: function(data) {
            console.log("Erro na API - Edit Etapa Enunciado");
            $("#errormsgenunc").text("Erro a adicionar o enunciado");
            $("#errormsgenunc").show().delay(2500).fadeOut();
            console.log(data);
        }
    });

}


function setEnunciado(url){
    enunciado_h4 = url;
}

function setProj(id){
    proj = id;
}

function setBackPage(href){
    back_page = href;
}

function checkFormStatus(){
    if(formStatus == 'edit'){
        $("#opennewEtapa").css('background-color','white');
        $(".editb").css('background-color','#75a790');
        $(".feedbackb").css('background-color','white');
        $(".addE").css('background-color','white');
    } else if(formStatus == 'new'){
        $("#opennewEtapa").css('background-color','#75a790');
        $(".editb").css('background-color','white');
        $(".feedbackb").css('background-color','white');
        $(".addE").css('background-color','white');
    } else if(formStatus == 'feedback'){
        $(".feedbackb").css('background-color','#75a790');
        $("#opennewEtapa").css('background-color','white');
        $(".editb").css('background-color','white');
        $(".addE").css('background-color','white');
    } else if(formStatus == 'addEnunc'){
        $("#opennewEtapa").css('background-color','white');
        $(".editb").css('background-color','white');
        $(".feedbackb").css('background-color','white');
        $(".addE").css('background-color','#75a790');
    } else {
        $("#opennewEtapa").css('background-color','white');
        $(".editb").css('background-color','white');
        $(".feedbackb").css('background-color','white');
        $(".addE").css('background-color','white');
    }
}

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


function updateEtapaPopup(etapa_rec){
    var etapa;
    for (i=0; i<etapas_info_global.length; i++){
        if(etapa_rec == etapas_info_global[i].id){
            etapa = etapas_info_global[i];
        }
    }

    console.log(etapa);

    $(".inputs-div").show();
    $("#container-geral").find("label:first").text(etapa["description"]);
    $("#enunciado_label").html(etapa["enunciado"]);
    $("#enunciado_label").append(etapa["remove"]);

    $("#popup-geral").css('visibility', 'visible');
    $("#popup-geral").css('opacity', '1');
    $("#popup-geral").show();
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
                    
                    
                    // + '<p><input id="chatButton" type="button" value="Chat"></p></div><hr>');


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

        },
        error: function(data) {
            console.log("Erro na API - Remove Etapa")
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
                $("#sub_url").html('<a target="_blank" href="'+base_link+grupo_id+'.'+extension+'">' + data[0]["submit_url"] + '</a>'); //tratar url - exemplo no checkEnunciado
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
                $("#errormsgfb").text("Não é possível atribuir feedback a uma etapa sem submissão")
                $("#errormsgfb").show().delay(1500).fadeOut();
            }
        },
        error: function(data) {
            console.log("Erro na API - Get Sumbission from Group in Etapa")
            console.log(data)
        }
    });
}


function validate_feedback(){
    if ($("textarea[name='feedback-text']").val() != '' && $("#select_grupo_feedback").val() != ''){
        return true
    }

    return false;
}

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
                $("#successmsgfb").text("Feedback submetido com sucesso");
                $('#feedback-form')[0].reset();
                $("#sub_url").text('Entrega ainda não foi submetida');
                $("#fb_content").text("Ainda não foi atribuido feedback a esta etapa.");
                $("#successmsgfb").show().delay(2500).fadeOut();
            },
            error: function(data) {
                console.log("Erro na API - Dar feedback");
                $("#errormsgfb").text("Erro ao submeter feedback");
                $("#errormsgfb").show().delay(2500).fadeOut();
                console.log(data);
            }
        });
    } else {

        if($("#select_grupo_feedback").val() == ""){
            $("#errormsgfb").text("Tem de selecionar um grupo válido");
        } else if($("textarea[name='feedback-text'").prop("disabled") == true){
            $("#errormsgfb").text("Não é possível atribuir feedback a uma etapa sem submissão")
        } else {
            $("#errormsgfb").text("Feedback tem de ser preenchido");
        }

        $("#errormsgfb").show().delay(2500).fadeOut();
        return false;
    }
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