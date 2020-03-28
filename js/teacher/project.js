var proj
var back_page
var etapa = {nome:'', desc:'', data:''};

$(document).ready(() => {
    showGroups(proj);

	//open popup
	$('#removeProject').on('click', function(event){
		event.preventDefault();
		$('.cd-popup').addClass('is-visible');
	});
	
	//close popup
	$('.cd-popup').on('click', function(event){
		if( $(event.target).is('.cd-popup-close') || $(event.target).is('.cd-popup') || $(event.target).is('#closeButton') ){
			event.preventDefault();
			$(this).removeClass('is-visible');
		}
    });
    
	//close popup when clicking the esc keyboard button
	$(document).keyup(function(event){
    	if(event.which=='27'){
    		$('.cd-popup').removeClass('is-visible');
	    }
    });

    // back button
    $("#back").click(() => window.location.assign(back_page));


    // getEtapas
    // chama uma primeira vez
    getEtapas(proj);

    // refresh de segundo em segundo?
    setInterval(function(){
         getEtapas(proj);
    }, 1000);



    // show etapa form - criar nova etapa 
    $("#opennewEtapa").on("click", function(){
        $("#etapa-form").show();
        $("#newEtapa").show();
        $("#newEtapaEDIT").hide();
        $("#etapa-label").text("Nova etapa:");
    });


    //show editar etapa form - editar etapa - se uma destas é clicada o botão da outra é escondido
    $('body').on("click", "#editEtapaButton", function(){
        var id = $(this).parent().parent().attr('id');
        var newid = id.replace("div","");
        $("#etapa-form").show();
        $("#newEtapaEDIT").show();
        $("#etapa-label").text("Editar etapa " + newid + ":");
        $("#newEtapa").hide();
    });


    // remover etapa da lista (depois de abrir info)
    $("body").on('click', "#removeEtapaButton", function(){
        var id = $(this).parent().parent().attr('id');
        var newid = id.replace("div","");
        removeEtapa(newid);
        $('#' + id).hide();
        getEtapas(proj);
    })

    
    //confirmed delete || apagar projeto pelo id

    $("#confirmRemove").on('click', function(){
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
                console.log("Erro na API:")
                console.log(data)
            }
        });
    })


    //on change mudar a etapa
    $("#etapa").change(function(){
        var name = $(this).find('input[name="etapaName"]').val();
        var desc = $(this).find('textarea[name="etapaDescription"]').val();
        var data = $(this).find('input[name="etapaDate"]').val();
        
        etapa['nome'] = name;
        etapa['desc'] = desc;
        etapa['data'] = data;

        if (!verifyDates(data)){
            $("#etapa input[name='etapaDate']").css("border-left-color", "red");
        } else {
            $("#etapa input[name='etapaDate']").css("border-left-color", "lawngreen");
        }
    })


    //mostrar info extra da etapa - tabela
    $('body').on('click', '.etapa-name', function(){
        var divid = 'div' + $(this).attr("id");
        $('.etapas-info').hide();
        $('#' + divid).show();
        $("#etapa-form").hide();
    })

    //criar etapa
    $("#newEtapa").click(() => submit_etapa());

})


//igual ao verifyDates do projectsNEW.js - faço um ficheiro geral, tento importar? for now vou repetir
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
                console.log("Erro na API:");
                console.log(data);
            }
        });
    } else {
        $("#errormsg").show().delay(5000).fadeOut();
        return false;
    }
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
    for (i=0; i<data.length; i++){
        json = data[i];
        var date = new Date(json["deadline"]);
        etapasSTR += '<tr>' +
            '<td class="etapa-name" id="'+json["id"] +'">'+ json["nome"] +'</td>' +
            '<td>'+ date.toLocaleString('en-GB') +'</td>' +
            '</tr>'


        p += '<div class="etapas-info" id="div'+json["id"]+'">' +   
            '<label>Descrição:</label>' +
            '<p>'+ json["description"] +'</p>' +
            '<div class="wrapper">'+
            '<input id="editEtapaButton" type="button" value="Editar">' +
            '<input id="feedbackEtapaButton" type="button" value="Feedback"></input>'+
            '<input id="removeEtapaButton" class="remove" type="button" value="Eliminar">' +
            '</div>' +
            '</div>'
    }
   
    var table = '<table id="etapas_list">' +
        '<tr>' +
        '<th>Nome</th>' + 
        '<th>Data Entrega</th>' +
        etapasSTR + 
        '</table>'

    $("#etapas-container").html(table);   
    $("#etapa-info-extra").append(p);
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
            console.log("Erro na API:")
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
            }
        },
        error: function(data) {
            console.log("Erro na API:")
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
            console.log("Erro na API:")
            console.log(data)
        }
    });
}