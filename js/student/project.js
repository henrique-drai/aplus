var proj;  
var selected_etapa;
var etapas_info_global;
var formStatus;
var grupo;
var have_group;

$(document).ready(() => {
    getEtapas(proj);

    $("#entrega_h3").text("Entrega final:");


    //ENUNCIADO PROJETO --- 

    //verificar se o enunciado do projeto existe na diretoria 
    
    if(checkEnunciado()){
        setInterval(function(){
            checkEnunciado();
        }, 1000);
    }


    showMyGroup(proj);

    //mostrar info extra da etapa - Etapas
    $('body').on('click', '.moreButton', function(){
        selected_etapa = $(this).attr("id");
        console.log(selected_etapa);

        // verificação de data - se a data de entrega da etapa ja tiver sido passada esconder o botao
        // data entrega
        var data_entrega = $(this).parent().parent().find("p:nth-child(2)").text().split(" ")
        var dsplit = data_entrega[0].split("/");
        var time_entrega = data_entrega[1].split(":");

        //mês -1 porque o js é parvo e tem os meses 0-indexed
        //yyyy-mm-dd-hh-mm
        var data_entrega_final = new Date(dsplit[2], dsplit[1]-1, dsplit[0], time_entrega[0], time_entrega[1]);

        // data atual 
        var today = new Date();

        $("#erro-entrega").hide();


        if (today > data_entrega_final){
            $("#erro-entrega").show();
            $("#form-submit-etapa").hide();
            $("#ul-buttons").hide();
        } else {
            if(have_group){
                $("#form-submit-etapa").show();
                $("#ul-buttons").show();
            } else {
                $("#no-group-erro").show().delay(5000).fadeOut();
                $("#form-submit-etapa").hide();
                $("#ul-buttons").hide();
            }
            $("#erro-entrega").hide();
        }


        $("#form-submit-etapa").attr('action', base_url + 'UploadsC/uploadSubmissao/' + proj + '/' + selected_etapa + '/' + grupo);

        updateEtapaPopup(selected_etapa);

        etapa_name = $("#etapa" + selected_etapa).find("p").find("b").text();

        $(".cd-popup-container").find("h3:first").text("Etapa: '" + etapa_name + "'");

        checkSubmission(grupo, selected_etapa, proj);

        if ($(this).css("background-color") == "#75a790"){
            $(this).css("background-color", "white");
        } else {
            $(this).css("background-color", "#75a790");
        }

    })

    $('body').on("click", ".cd-popup2", function(event){
        if( $(event.target).is('.cd-popup-hide') || $(event.target).is('#closeButton-hide') || $(event.target).is('.cd-popup2') ){
            event.preventDefault();
            $(this).hide();
            $(".moreButton").css("background-color", "white");
            $("#no-group-erro").hide();
            $("#etapa-form-edit").hide();
            $("#form-upload-etapa").hide();
            $("#erro-entrega").hide();
            $("#form-submit-etapa").hide();
		}
    })


    $("body").on("click", "#submitEtapa", function(){
        $("#form-submit-etapa").show();
    })

    $("#file_submit").on("change", function(){

        if($("#file_submit").val() != "") {
            $("#name-file-submit").text($("#file_submit").val().split('\\').pop());
            $("#file-img-submit").attr('src',base_url+"images/icons/check-solid.png");
        } else {
            $("#name-file-submit").text("Envie o ficheiro do enunciado");
            $("#file-img-submit").attr('src',base_url+"images/icons/upload-solid.png");
            $("#enviado-erro").show().delay(1500).fadeOut();
        }

    })

    $("body").on("click", "#addSubmission", function(e){
        if($("#file_submit").val() == ""){
            $("#enviado-erro").show().delay(2500).fadeOut();
        } else {
            if($("#file_submit")[0].files[0].size < 5024000){
                $("#form-submit-etapa")[0].submit();
                submit_etapa($("#file_submit").val().split('\\').pop());
            } else {
                $("#enviado-erro").text("Ficheiro ultrapassa o limite de 5MB");
                $("#enviado-erro").show().delay(2500).fadeOut();
                $("#name-file-submit").text("Envie o ficheiro do enunciado");
                $("#file-img-submit").attr('src',base_url+"images/icons/upload-solid.png");
                $("#file_submit").val("");
                e.preventDefault();
            }
        }
    })


    $("body").on("click", "#areagrupo", function() {
        showMyGroup(proj);
        window.location = base_url + "app/grupo/" + grupo;
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
        url: base_url + "api/getMyGroupInProj/" + proj_id,
        data: {proj_id: proj_id},
        success: function(data) {
            if (data == ""){
                $("#areagrupo").hide();
                $(".criarGrupo").css("display", "inline");
                $("#grupo-name").text("Grupos");
                showNotFullGroups(proj_id);
                var timeout = setInterval(function(){showNotFullGroups(proj_id);}, 10000);
                $("#submitEtapa").prop('disabled', true);
                have_group = false;
                $("#form-submit-etapa").hide();
                localStorage.setItem("grupo_id",0) //adicionei só para se alguem estiver a usar localstorage não dar porcaria
            } else {
                $("#grupo-name").text('Grupo ' + data["grupo"]["name"]);
                $("#submitEtapa").prop('disabled', false);
                $(".criarGrupo").css("display", "none");
                $("#criarGrupoName").hide();
                $("#areagrupo").show(); //link para a area de grupo
                have_group = true;
                grupo = data["grupo"]["id"];
                localStorage.setItem("grupo_id",grupo) //adicionei só para se alguem estiver a usar localstorage não dar porcaria
                var names = '';
                for(var j=0; j < data["nomes"].length; j++) {
                    names = names + '<a href="'+ base_url +'app/profile/'+ data["nomes"][j][2] + '">' + data["nomes"][j][0] + " " + data["nomes"][j][1] + "</a> | ";
                }

                $("#grupos-container").html('<div class="myGroupDiv" id="grupo'+grupo+'">' +
                '<p><b>Membros do seu grupo: </b></p><p>'+ names.slice(0, -2) +'</p>' + 
                '<p><input class="quitGroupButton" id=quit"'+grupo +'" type="button" value="Sair"></input></p>' + 
                '</div><hr>');
            }
        },
        error: function(data) {
            console.log(data);
        }
    });
}


function showNotFullGroups(proj_id){
    $.ajax({
        type: "GET",
        url: base_url + "api/showNotFullGroup/" + proj_id,
        data: {proj_id: proj_id},
        success: function(data) {
            var array=[];
            for(var i=0; i<data["gruposdisponiveis"].length; i++){
                var names = '';
                var countEle = 0;
                
                for(var j=1; j<data["alunosnogrupo"].length; j++){
                    if(data["alunosnogrupo"][j]["grupo_id"] == data["gruposdisponiveis"][i].grupo_id) {
                        countEle+=1;
                        names = names + '<a href="'+ base_url +'app/profile/' + data["alunosnogrupo"][j].user_name[2] + '">' + data["alunosnogrupo"][j].user_name[0] + " " + data["alunosnogrupo"][j].user_name[1] + "</a> | ";
                    } 
                }
                array.push('<div class="availableGroupsDiv" id="grupo' + data["gruposdisponiveis"][i].grupo_id + '">' +
                    '<p><b> Grupo: </b>' + data["gruposdisponiveis"][i].grupo_nome + '</p>' +
                    '<p><b>Membros: </b>'+ names.slice(0, -2) + " ("+ countEle + "/" + data["alunosnogrupo"][0]["maxElementos"] +")" + '</p>' +
                    '<p><input class="entrarGroupButton" id=entrar"'+ data["gruposdisponiveis"][i].grupo_id +'" type="button" value="Entrar"></input></p></div><hr>');
                
            }

            if(array.length == 0){
                $("#grupos-container2").html("Não existem grupos disponiveis");
                $(".paginationjs").css("display", "none");
            }
            else{
                $('#grupos-container').pagination({
                    dataSource: array,
                    pageSize: 5,
                    pageNumber: 1,
                    callback: function(data, pagination) {
                        $("#grupos-container2").html(data);
                    }
                })
            }
            
        },
        error: function(data) {
            var mensagem = "<h4 id='errogrupo'>Não foi possivel encontrar grupos.</h2>";
            $(".myGroupDiv").append(mensagem);
            $("#errogrupo").delay(2000).fadeOut();
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
        url: base_url + "api/getAllEtapas/" + proj_id,
        data: data_proj,
        success: function(data) {
            makeEtapaDiv(data["etapas"]);
            checkEntrega(data["data_final"]);
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
        '<p><input class="moreButton" id='+json["id"] +' type="button" value="Ver Mais"></input></p>' +
        '</div><hr>');


        if (enunciado == ""){
            newenunciado = "Não existe enunciado associado a esta etapa."
            removebut = ''
        } else {
            // $.get(base_url + "uploads/enunciados_files/" + proj + "/" + json['id'] +".pdf")
            // .done(function(){
            //     console.log("ficheiro: " + json['id'] +".pdf existe")
            //     removebut = '<label id="removeEnunciado" class="labelRemove"><img src="'+base_url+'/images/close.png"></label> '
            //     newenunciado = "<a target='_blank' href='" + base_url + "uploads/enunciados_files/" + proj + "/" + json['id'] +".pdf'>" + enunciado + "</a>"
            // })

            // .fail(function(){
            //     newenunciado = "Não existe enunciado associado a esta etapa."
            //     removebut = ''
            // })
            removebut = '<label id="removeEnunciado" class="labelRemove"><img src="'+base_url+'/images/close.png"></label> '
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


function checkEntrega(dateOld){

    date = dateFormatter(new Date(dateOld));
    if(date == ''){
        $("#entrega_h3").text("Entrega final: Ainda não definida");
    } else {
        $("#entrega_h3").text("Entrega final: " + date);
    }
}

// Este tem uma pequena alteração porque nao usa o button
function checkEnunciado(){

    if (enunciado_h4 != ""){
        $("#enunciado_h4").html("Enunciado: <a target='_blank' href='"+ base_url + "uploads/enunciados_files/"+ proj+".pdf'>" + enunciado_h4 + "</a>");
    } else {
        //$("#enunciado_h4").text("Enunciado: <a target='_blank' href='"+ base_url + "uploads/enunciados_files/"+ proj+".pdf'>" + proj + ".pdf </a>");
        $("#enunciado_h4").text("Este projeto ainda não tem enunciado.")
    }

    // $.get(base_url + "uploads/enunciados_files/"+ proj+".pdf")
    //     .done(function() { 
    //         if (enunciado_h4 != ""){
    //             $("#enunciado_h4").html("Enunciado: <a target='_blank' href='"+ base_url + "uploads/enunciados_files/"+ proj+".pdf'>" + enunciado_h4 + "</a>");
    //         } else {
    //             $("#enunciado_h4").text("Enunciado: <a target='_blank' href='"+ base_url + "uploads/enunciados_files/"+ proj+".pdf'>" + proj + ".pdf </a>");
    //         }

    //         return true;
    //     }).fail(function() { 
    //         $("#enunciado_h4").text("Este projeto ainda não tem enunciado.")
    //         return false;
    //     })
}


function setEnunciado(url){
    enunciado_h4 = url;
}

function updateEtapaPopup(etapa_rec){
    var etapa;
    for (i=0; i<etapas_info_global.length; i++){
        if(etapa_rec == etapas_info_global[i].id){
            etapa = etapas_info_global[i];
        }
    }

    console.log(etapa);
    $(".cd-popup-container").find("label:first").text(etapa["description"]);
    $("#enunciado_label").html(etapa["enunciado"]);

    $("#popup-geral").css('visibility', 'visible');
    $("#popup-geral").css('opacity', '1');
    $("#popup-geral").show();
}

function submit_etapa(file_name){
    const data = {
        grupo : grupo,
        etapa : selected_etapa,
        ficheiro : file_name
    }

    $.ajax({
        type: "POST",
        url: base_url + "api/submitEtapa",
        data: data,
        success: function(data) {
            $("#enviado-sucesso").show(); //resolver a questao do refresh primeiro.
            console.log(data);
        },
        error: function(data) {
            console.log("Erro na API - Submit etapa");
            console.log(data);
        }
    });
}

function checkSubmission(grupo, etapa, proj){
    const data = {
        grupo_id : grupo,
        etapa_id : etapa
    }


    $.ajax({
        type: "GET",
        url: base_url + "api/getSub",
        data: data,
        success: function(data) {
            if (data.length > 0){
                console.log(data);
                var base_link = base_url + "uploads/submissions/" + proj + "/" + etapa + "/";
                var extension = data[0]["submit_url"].split(".").pop();
                if (data[0]["feedback"] == ""){
                    $("#feedback_label").text("Ainda não foi atribuido feedback a esta etapa.");
                } else {
                    $("#feedback_label").text(data[0]["feedback"]);
                }
                $("#sub_label").html('<a target="_blank" href="'+base_link+grupo+'.'+extension+'">' + data[0]["submit_url"] + '</a>');
                // $.get(base_link+grupo+'.'+extension)
                //     .done(function(){
                //         $("#sub_label").html('<a target="_blank" href="'+base_link+grupo+'.'+extension+'">' + data[0]["submit_url"] + '</a>');
                //     })

                //     .fail(function(){
                //         $("#sub_label").text("O seu grupo ainda não submeteu uma entrega.");
                //     })
            } else {
                $("#sub_label").text("O seu grupo ainda não submeteu uma entrega.");
                $("#feedback_label").text("Ainda não foi atribuido feedback a esta etapa.");
            }
        },
        error: function(data) {
            console.log("Erro na API - get Submission");
            console.log(data);
        }
    });
}
