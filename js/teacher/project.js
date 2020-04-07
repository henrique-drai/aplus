var proj
var enunciado_h3
var back_page
var selected_etapa
var etapa = {nome:'', desc:'', enunciado:'', data:''};
var formStatus = null;

$(document).ready(() => {

    //GRUPOS ---

    //tabela dos grupos
    showGroups(proj);

    //atualizar tabela dos grupos. Não precisa de ser instantaneo
    setInterval(function(){
        showGroups(proj);
    }, 5000);

    // --- GRUPOS

    //REMOVER PROJETO ---

	//open popup - REMOVER PROJETO
	$('#removeProject').on('click', function(event){
        event.preventDefault();
        makePopup("confirmRemove", "Tem a certeza que deseja eliminar o projeto?");
	});
	
	//close popup - REMOVER PROJETO
	$('body').on('click', '.cd-popup', function(event){
		if( $(event.target).is('.cd-popup-close') || $(event.target).is('.cd-popup') || $(event.target).is('#closeButton') ){
            event.preventDefault();
            $(this).remove();
		}
    });
    
    //confirmed delete do popup - REMOVER PROJETO
    $("body").on('click', '#confirmRemove', function(){
        const data = {
            projid : proj
        }
    
        $.ajax({
            type: "POST",
            headers: {
                "Authorization": localStorage.token
            },
            url: base_url + "teacher/api/removeProject",
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

    //set enunciado h3 value - ENUNCIADO PROJETO
    if(enunciado_h3 == ""){
        $("#enunciado_h3").text("Enunciado: Este projeto não tem enunciado.")
    } else {
        $("#enunciado_h3").html("Enunciado: <a href=''>" + enunciado_h3 + '</a>');
    }

    
    //file enunciado projeto selected - MUDAR ENUNCIADO
    $("#file_projeto").on('change', function(){
        $("#addEnunciado").show();
        $("#file_projeto").css("border-left-color", "lawngreen");
    })


    //ao confirmar - MUDAR ENUNCIADO
    $("#addEnunciado").on('click', function(){
        enunc = $("#file_projeto").val();
        submit_new_enunciado(enunc);
    })

    //--- ENUNCIADO PROJETO

    //ETAPAS --- 

    // getEtapas - ETAPAS
    getEtapas(proj);

    // data final = data etapa mais tarde - PROJETO
    var datafinal = $(".data-val").last().text();
    $("#entrega_h3").text("Entrega final: " + datafinal);

    // refresh tabela - ETAPAS
    setInterval(function(){
         getEtapas(proj);
         var datafinal = $(".data-val").last().text();
         $("#entrega_h3").text("Entrega final: " + datafinal);
    }, 1000);


    // show etapa form - CRIAR NOVA ETAPA 
    $("#opennewEtapa").on("click", function(){
        $("#etapa-form").show();
        $("#newEtapa").show();
        $("#newEtapaEDIT").hide();
        $("#feedback-form").hide();
        $("#etapa-label").text("Nova etapa:");
        emptyEtapa();

        if(formStatus != 'new'){
            formStatus = 'new';
            checkFormStatus();
        } else {
            formStatus = null;
            checkFormStatus();
            $("#etapa-form").hide();
            $("#newEtapa").hide();
        }
    });


    //show feedback etapa - FEEDBACK ETAPA
    $('body').on("click", "#feedbackEtapaButton", function(){

        $("#etapa-form").hide();
        $("#newEtapa").hide();
        $("#newEtapaEDIT").hide();
        $("#feedback-form").show();

        if(formStatus != 'feedback'){
            formStatus = 'feedback';
            checkFormStatus();
        } else {
            formStatus = null;
            checkFormStatus();
            $("#feedback-form").hide();
        }
    });


    //show editar etapa form - EDITAR ETAPA
    $('body').on("click", "#editEtapaButton", function(){
        var id = $(this).parent().parent().attr('id');
        var newid = id.replace("div","");
        $("#etapa-form").show();
        $("#newEtapaEDIT").show();
        $("#etapa-label").text("Editar etapa '" + $("#etapaname" + newid).text() + "':");
        $("#newEtapa").hide();
        $("#feedback-form").hide();

        putEtapaInfoForm(newid);

        if(formStatus != 'edit'){
            formStatus = 'edit';
            checkFormStatus();
        } else {
            formStatus = null;
            checkFormStatus();
            emptyEtapa();
            $("#etapa-form").hide();
            $("#newEtapa").hide();
        }
    });

    //on change mudar a etapa (variavel) - EDITAR ETAPA
    $("#etapa").change(function(){
        var name = $(this).find('input[name="etapaName"]').val();
        var desc = $(this).find('textarea[name="etapaDescription"]').val();
        var data = $(this).find('input[name="etapaDate"]').val();
        var enunc = $(this).find('input[name="file"]').val();
        
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

    // abrir pop up - REMOVER ETAPA
    $("body").on('click', "#removeEtapaButton", function(){
        makePopup('confirmRemoveEtapa','Tem a certeza que deseja eliminar esta etapa?');    
    })
    

    // REMOVER ETAPA
    $("body").on('click', "#confirmRemoveEtapa", function(){
        $('.cd-popup').remove();
        removeEtapa(selected_etapa);
        $("#etapa-form").hide();
        $('#' + selected_etapa).hide();
        getEtapas(proj);
    })

    //mostrar info extra da etapa - TABELA ETAPAS
    $('body').on('click', '.moreInfoButtons', function(){
        selected_etapa = $(this).attr("id");
        var divid = 'div' + selected_etapa;
        $('.etapas-info').hide();
        $('#' + divid).show();
        $("#etapa-form").hide();
        formStatus = null;
        checkFormStatus();
    })

    //remover enunciado etapa
    $('body').on('click', '#removeEnunciado', function(e) {
        etapa_clear_enunciado();
        getEtapas(proj);
    })

    //criar etapa
    $("#newEtapa").click(() => submit_etapa());


    //editar etapa 
    $("#newEtapaEDIT").click(() => submit_edit_etapa());


    //--- ETAPAS
})

function strToDate(dtStr) {
    let dateParts = dtStr.split("/");
    let timeParts = dateParts[2].split(" ")[1].split(":");
    dateParts[2] = dateParts[2].split(" ")[0];
    return dateObject = new Date(+dateParts[2], dateParts[1] - 1, +dateParts[0], timeParts[0], timeParts[1], timeParts[2]); 
}

//limpar os campos preenchidos
function emptyEtapa(){
    $('#etapa-form')[0].reset();
}

//preencher form da etapa com a info relativa à etapa
function putEtapaInfoForm(newid){
    var name = $("#etapaname" + newid).text();
    var data = $("#etapadata" + newid).text().replace(",","");
    var desc = $("#div" + newid).find("p").first().text();
    var newdata = strToDate(data).toISOString();
    var finaldata = newdata.substring(0,newdata.length-1);

    $('input[name="etapaName"]').val(name);
    $('input[name="etapaDate"]').val(finaldata);
    $('textarea[name="etapaDescription"]').val(desc);

    etapa['nome'] = name;
    etapa['desc'] = desc;
    etapa['data'] = finaldata;
}


function makePopup(butID, msg){
    popup = '<div class="cd-popup" role="alert">' +
        '<div class="cd-popup-container">' +
        '<p>'+ msg +'</p>' +
        '<ul class="cd-buttons">' +
        '<li><a href="#" id="'+ butID +'">Sim</a></li>' +
        '<li><a href="#" id="closeButton">Não</a></li>' +
        '</ul>' +
        '<a class="cd-popup-close"></a>' +
        '</div></div>'

    $("#popups").html(popup);
}


//muito parecido ao verifyDates do projectsNEW.js, só muda o set do errormsg
function verifyDates(data){

    var dmaior = new Date(data);
    var today = new Date();

    var dParse = Date.parse(dmaior);
    $("#errormsg").text("A data da etapa tem de ser maior que a data atual");

    if (isNaN(dParse)){
        return false;
    }

    if (dmaior <= today){
        return false;
    }

    return true;
}


function submit_etapa(){

    if (verifyDates(etapa["data"])){

        const data = {
            projid : parseInt(proj),
            new_etapa : etapa,
        }

        $.ajax({
            type: "POST",
            headers: {
                "Authorization": localStorage.token
            },
            url: base_url + "teacher/api/createEtapa",
            data: data,
            success: function(data) {
                console.log(proj);
                console.log(data);
            },
            error: function(data) {
                console.log("Erro na API - Submit Etapa");
                console.log(data);
            }
        });
    } else {
        $("#errormsg").show().delay(5000).fadeOut();
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
            headers: {
                "Authorization": localStorage.token
            },
            url: base_url + "teacher/api/editEtapa",
            data: data,
            success: function(data) {
                console.log(data);
            },
            error: function(data) {
                console.log("Erro na API - Edit Etapa");
                console.log(data);
            }
        });
    } else {
        $("#errormsg").show().delay(5000).fadeOut();
        return false;
    }
}


function etapa_clear_enunciado(){
    const data = {
        projid : parseInt(proj),
        id : selected_etapa,
    }

    $.ajax({
        type: "POST",
        headers: {
            "Authorization": localStorage.token
        },
        url: base_url + "teacher/api/clearEnunciadoEtapa",
        data: data,
        success: function(data) {
            console.log("Enunciado do proj: "+ data + "removido");
            $("#removeEnunciado").hide();
            $("#div"+data).find('p').last().text("Não existe enunciado associado a esta etapa.");
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
        headers: {
            "Authorization": localStorage.token
        },
        url: base_url + "teacher/api/editEnunciado",
        data: data,
        success: function(data) {
            console.log(data);
            $("#enunciado_h3").html("Enunciado: <a href=''> " + data + "</a>");
            $("#addEnunciado").hide();
        },
        error: function(data) {
            console.log("Erro na API - Edit Enunciado");
            console.log(data);
        }
    });

}

function checkFormStatus(){
    if(formStatus == 'edit'){
        $("#opennewEtapa").css('background-color','white');
        $(".editb").css('background-color','#3e5d4f');
        $(".feedbackb").css('background-color','white');
    } else if(formStatus == 'new'){
        $("#opennewEtapa").css('background-color','#3e5d4f');
        $(".editb").css('background-color','white');
        $(".feedbackb").css('background-color','white');
    } else if(formStatus == 'feedback'){
        $(".feedbackb").css('background-color','#3e5d4f');
        $("#opennewEtapa").css('background-color','white');
        $(".editb").css('background-color','white');
    } else {
        $("#opennewEtapa").css('background-color','white');
        $(".editb").css('background-color','white');
        $(".feedbackb").css('background-color','white');
    }
}

function setEnunciado(url){
    enunciado_h3 = url;
}

function setProj(id){
    proj = id;
}

function setBackPage(href){
    back_page = href;
}

function makeEtapaTable(data){
    etapasSTR = '';
    var p = '';
    var lastp;
    for (i=0; i<data.length; i++){
        json = data[i];
        var enunciado = json["enunciado_url"];
        var date = new Date(json["deadline"]);
        etapasSTR += '<tr>' +
            '<td id="etapaname'+ json["id"] +'" class="etapa-name">'+ json["nome"] +'</td>' +
            '<td id="etapadata' + json["id"] + '" class="data-val">'+ date.toLocaleString('en-GB') +'</td>' +
            '<td><input class="moreInfoButtons" id="'+json["id"] +'" type="button" value="Info"></input></td>'
            '</tr>'


        if (enunciado == ""){
            newenunciado = "Não existe enunciado associado a esta etapa."
            removebut = ''
        } else {
            removebut = '<label id="removeEnunciado"><img src="'+base_url+'/images/close.png"></label> '
            newenunciado = '<a href="">' + enunciado + '</a>';
        }


        p += '<div class="etapas-info" id="div'+json["id"]+'">' +   
            '<label>Descrição:</label>' +
            '<p>'+ json["description"] +'</p>' +
            '<label>Enunciado da etapa:</label>' +
            '<p>' + newenunciado + '</p>' +
             removebut +
            '<div class="wrapper">'+
            '<input id="editEtapaButton" class="editb" type="button" value="Editar">' +
            '<input id="feedbackEtapaButton" class="feedbackb" type="button" value="Feedback"></input>'+
            '<input id="removeEtapaButton" class="remove" type="button" value="Eliminar">' +
            '</div>' +
            '</div>'

        lastp = 'div'+json["id"];
        
    }
   
    var table = '<table id="etapas_list">' +
        '<tr>' +
        '<th>Nome</th>' + 
        '<th>Data Entrega</th>' +
        '<th>Mais Informação</th></tr>' +
        etapasSTR + 
        '</table>'

    $("#etapas-container").html(table);   
    
    if ($("#" + lastp).length == 0){
        $("#etapa-info-extra").html(p);
    }
    
}

function getEtapas(proj_id){

    const data_proj = {
        projid : proj_id
    }

    $.ajax({
        type: "POST",
        headers: {
            "Authorization": localStorage.token
        },
        url: base_url + "teacher/api/getAllEtapas",
        data: data_proj,
        success: function(data) {
            makeEtapaTable(data);
        },
        error: function(data) {
            console.log("Erro na API - Get Etapa")
            console.log(data)
        }
    });
}

function showGroups(proj_id) {
    $.ajax({
        type: "POST",
        url: base_url + "teacher/api/getAllGroups",
        data: {proj_id: proj_id},
        success: function(data) {
            console.log(data);
            var linhas = '';
            $("#groups_list tr").remove();
            $("#groups_list").append("<tr><th>Nome</th><th>Número de elementos</th>" +
                "<th>Elementos</th><th>Chat</th></tr>");

            for(var i=0; i < data["grupos"].length; i++) {
                var count = 0;
                var names = '';
                for(var j=0; j < data["students"][0].length; j++) {
                    if(data["students"][0][j].grupo_id == data["grupos"][i].id) {
                        count++;
                    }
                }

                for(var j=0; j < data["nomes"].length; j++) {
                    if(data["nomes"][j].grupo_id == data["grupos"][i].id) {
                        names = names + data["nomes"][j].user_name.name + " " + data["nomes"][j].user_name.surname + " | ";
                    }
                }

                $("#groups_list").append("<tr><td>" + data["grupos"][i].name +"</td>" +
                    "<td>" + count + "</td><td>" + names.slice(0, -2) + "</td><td>" +
                    "<input id='chatButton' type='button' value='Chat'></td></tr>");


                linhas += '<option value=' +  data["grupos"][i].id  +">" + data["grupos"][i].name  + '</option>'; 
            }

            $("#select_grupo_feedback").html(linhas);
        },
        error: function(data) {
            console.log("Erro na API - Show Groups")
            $("#groups_list").html("Não existem grupos para mostrar.")
            console.log(data)
        }
    });
}
     

function removeEtapa(id){
    const data_etapa = {
        etapa_id : id
    }

    $.ajax({
        type: "POST",
        headers: {
            "Authorization": localStorage.token
        },
        url: base_url + "teacher/api/removeEtapa",
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
