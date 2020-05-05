var proj
var selected_etapa

$(document).ready(() => {
    getEtapas(proj);


    showMyGroup(proj);

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
        url: base_url + "api/getMyGroupInProj/" + proj_id,
        data: {proj_id: proj_id},
        success: function(data) {
            console.log(data);
            if (data == ""){
                $("#grupo-name").text('Cria um grupo ou entra num grupo existente');
                $("#grupos-container").html("cena de criar grupos - ye");
            } else {
                $("#grupo-name").text('Grupo ' + data["name"]);
                $("#grupos-container").html("mostrar aqui os membros do grupo, outras opções");
            }
        },
        error: function(data) {
            console.log(data);
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
    var etapas_info = [];
    var array_etapa = [];
    for (i=0; i<data.length; i++){
        json = data[i];
        var enunciado = json["enunciado_url"];
        var date = new Date(json["deadline"]);

        array_etapa.push('<div class="etapasDIV" id="etapa' + json["id"] +'"><p><b>'+json["nome"]+'</b></p>'+
        '<p>'+ date.toLocaleString('en-GB', {hour: '2-digit', minute:'2-digit', year: 'numeric', month: 'numeric', day: 'numeric'}) +'</p>'+
        '<p><input id=sub"'+json["id"] +'" type="button" value="Ver Mais"></input></p>' +
        '</div><hr>');


        if (enunciado == ""){
            newenunciado = "Não existe enunciado associado a esta etapa."
        } else {
            newenunciado = "<a target='_blank' href='" + base_url + "uploads/enunciados_files/" + proj + "/" + json['id'] +".pdf'>" + enunciado + "</a>"
        }


        var obj = {
            id: json["id"],
            description: json["description"],
            enunciado:  newenunciado
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
            $("#etapas-container2").html(data);
        }
    })
}