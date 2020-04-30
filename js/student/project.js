var proj
var selected_etapa

$(document).ready(() => {
    getEtapas(proj);


    //mostrar info extra da etapa - Etapas
    $('body').on('click', '.moreInfoButtons', function(){
        selected_etapa = $(this).attr("id");
        var divid = 'div' + selected_etapa;

        $(".moreInfoButtons").css("background-color", "white");

        if ($(this).css('background-color') == "#3e5d4f"){
            $(this).css("background-color", "white");
        } else {
            $(this).css("background-color", "#3e5d4f");
        }

        $('.etapas-info').hide();
        $('#' + divid).show();

    })

});

function setProj(id){
    proj = id;
}


function showMyGroup(proj_id){
    // vai precisar do id do projeto e id do user que está no localstorage. No controlador
    // é depois necessário verificar com o token
    $.ajax({
        type: "GET",
        headers: {
            "Authorization": localStorage.token
        },
        url: base_url + "api/getMyGroupInProj",
        data: {proj_id: proj_id},
        success: function(data) {
        },
        error: function(data) {
        }
    });
}


function getEtapas(proj_id){
    //vai buscar as etapas deste projeto, sem os botoes que aparecem nos profs mas sim
    //com a info extra e uma opcao para enviar a submissao se o grupo estiver feito
    //ou ver o feedback se ja tiver submetido

    const data_proj = {
        projid : proj_id
    }

    $.ajax({
        type: "GET",
        headers: {
            "Authorization": localStorage.token
        },
        url: base_url + "api/getAllEtapas/" + proj_id,
        data: data_proj,
        success: function(data) {
            makeEtapaDiv(data);
        },
        error: function(data) {
            console.log("Erro na API - Get Etapa")
            console.log(data)
        }
    });
}


function makeEtapaDiv(data){
    etapasSTR = '';
    var p = '';
    var lastp;
    for (i=0; i<data.length; i++){
        json = data[i];
        var enunciado = json["enunciado_url"];
        var date = new Date(json["deadline"]);
        etapasSTR += '<div class="etapasDIV" id="etapa' + json["id"] +'"><p><b>'+json["nome"]+'</b></p>'+
            '<p>'+ date.toLocaleString('en-GB', {hour: '2-digit', minute:'2-digit', year: 'numeric', month: 'numeric', day: 'numeric'}) +'</p>'+
            '<p><input class="moreInfoButtons" id="'+json["id"] +'" type="button" value="Info"></input></p>' +
            '</div>' +
            '<hr>'


        if (enunciado == ""){
            newenunciado = "Não existe enunciado associado a esta etapa."
        } else {
            newenunciado = "<a target='_blank' href='" + base_url + "uploads/enunciados_files/" + proj + "/" + json['id'] +".pdf'>" + enunciado + "</a>"
        }


        p += '<div class="etapas-info" id="div'+json["id"]+'">' +   
            '<label>Descrição:</label>' +
            '<p>'+ json["description"] +'</p>' +
            '<label>Enunciado da etapa:</label>' +
            '<p>' + newenunciado + '</p>' +
            '<label>Feedback:</label>' +
            '<p> O professor ainda não atribuiu feedback a esta etapa.</p>' +
            '<div class="wrapper">'+
            '<input id="submissionProjButton" class="subButton" type="button" value="Submeter Entrega">'+
            '</div>' +
            '</div>'

        lastp = 'div'+json["id"];
    
    }

    if (etapasSTR == ''){
        etapasSTR = '<p>Não existem etapas para mostrar</p><hr>';
    }

    $("#etapas-container").html(etapasSTR);   

    if ($("#" + lastp).length == 0){
        $("#etapa-info-extra").html(p);
    }
}