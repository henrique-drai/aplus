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

    // refresh de segundo em segundo? defini 4 para nao ser demasiado for now

    setInterval(function(){
         getEtapas(proj);
    }, 1000);



    // show etapa form - criar nova etapa
    $("#opennewEtapa").on("click", function(){
        $("#etapa-form").show();
        // fazer verificação dos inputs como no projectNEW.js
    });

    //confirmed delete 
    //apagar projeto pelo id

    $("body").on('click', "#removeEtapaButton", function(){
        var id = $(this).parent().parent().find("td:first").text();

        removeEtapa(id);
        getEtapas(proj);
    })

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


    $("#newEtapa").click(() => submit_etapa());


})


//igual ao verifyDates do projectsNEW.js - faço um ficheiro geral, tento importar? for now vou repetir
function verifyDates(data){

    console.log(data);
    var dmaior = new Date(data);
    var today = new Date();

    console.log(dmaior);

    console.log(today);

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
    for (i=0; i<data.length; i++){
        json = data[i];
        etapasSTR += '<tr>' +
            '<td>'+ json["id"] +'</td>' +
            '<td>'+ json["nome"] +'</td>' +
            '<td>'+ json["deadline"] +'</td>' +
            '<td>'+ json["description"] +'</td>' +
            '<td><input id="editEtapaButton" type="button" value="Editar"></td>' +
            '<td><input id="feedbackEtapaButton" class="remove" type="button" value="Feedback"></td>' +
            '<td><input id="removeEtapaButton" class="remove" type="button" value="Eliminar"></td>' +
            '</tr>'
    }
   
    var table = '<table id="etapas_list">' +
        '<tr><th>ID</th>' +
        '<th>Nome</th>' + 
        '<th>Data Entrega</th>' +
        '<th>Descrição</th>' +
        '<th>Editar</th>' + 
        '<th>Feedback</th>' + 
        '<th>Eliminar</th></tr>' +
        etapasSTR + 
        '</table>'


    $("#etapas-container").html(table);    
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