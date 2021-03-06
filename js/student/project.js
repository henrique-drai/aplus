var proj;
var enunciado_h4;
var enunciado_original;
var selected_etapa;
var etapas_info_global;
var formStatus;
var grupo;
var have_group;
var msg_res;

$(document).ready(() => {
    getEtapas(proj);

    $("#entrega_h3").text("Entrega final:");


    //ENUNCIADO PROJETO --- 

    //verificar se o enunciado do projeto existe 
    
    if(checkEnunciado()){
        setInterval(function(){
            checkEnunciado();
        }, 1000);
    }

    if(msg_res != undefined && msg_res != ""){
        //Mensagens de sucesso e erro vindas do php
        checkMsg();
    }

    showMyGroup(proj);

    //mostrar info extra da etapa - Etapas
    $('body').on('click', '.moreButton', function(){
        selected_etapa = $(this).attr("id");
        console.log(selected_etapa);
        etapa_name = $("#etapa" + selected_etapa).find("p").find("b").text();

        showPopup();
        createSubmissionPopup(selected_etapa, etapa_name);
        checkSubmission(grupo, selected_etapa, proj);

        if ($(this).css("background-color") == "#999C9B") {
            $(this).css("background-color", "white");
        } else {
            $(this).css("background-color", "#999C9B");
        }

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

        if (today > data_entrega_final){
            $("#error-popup").text("A data limite para submeter esta etapa foi ultrapassada.")
            $("#error-popup").append('<i id="closeError" class="fa fa-times" aria-hidden="true"></i>');
            $("#error-popup").show();
            $("#form-submit-etapa").hide();
            $(".cd-buttons").html('');
        } else {
            if(have_group){
                $("#form-submit-etapa").show();
                $(".cd-buttons").html('').append("<li><input class='button-popup' id='addSubmission' type='submit' value='Submeter'>" +
                "</li><li><a href='#' id='closeButton'>Cancelar</a></li>");
            } else {
                $("#error-popup").text("Inscreva-se num grupo para poder fazer submissões.")
                $("#error-popup").append('<i id="closeError" class="fa fa-times" aria-hidden="true"></i>');
                $("#error-popup").show();
                $("#form-submit-etapa").hide();
                $(".cd-buttons").html('');
            }
            $("#error-popup").hide();
        }

    })

    //POPUPS - Esconder
    $('body').on('click', '.cd-popup', function(){
        if($(event.target).is('.cd-popup-close') || $(event.target).is('.cd-popup') || $(event.target).is('#closeButton')){
            event.preventDefault();
            hidePopup();
            $(".moreButton").css("background-color", "white");

            // dps mudar isto
            $("#error-popup").remove();
        }
    })

    $("body").on("change", "#file_submit", function(){
        if($("#file_submit").val() != "") {
            $("#name-file-submit").text(escapeHtml($("#file_submit").val().split('\\').pop()));
            $("#file-img-submit").attr('src',base_url+"images/icons/check-solid.png");
        } else {
            $("#name-file-submit").text("Envie o ficheiro do enunciado");
            $("#file-img-submit").attr('src',base_url+"images/icons/upload-solid.png");
            $("#error-popup").text("Tem de selecionar um ficheiro");
            $("#error-popup").append('<i id="closeError" class="fa fa-times" aria-hidden="true"></i>');
            $("#error-popup").show();
        }

    })

    $("body").on("click", "#addSubmission", function(e){
        if($("#file_submit").val() == ""){
            $("#error-popup").text("Tem de selecionar um ficheiro");
            $("#error-popup").append('<i id="closeError" class="fa fa-times" aria-hidden="true"></i>');
            $("#error-popup").show();
            e.preventDefault();
        } else {
            if($("#file_submit")[0].files[0].size < 2024000){
                $("#form-submit-etapa")[0].submit();
            } else {
                $("#error-popup").text("Ficheiro ultrapassa o limite de 2MB")
                $("#error-popup").append('<i id="closeError" class="fa fa-times" aria-hidden="true"></i>');
                $("#error-popup").show();

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

    
    // ESCONDER POPUP AO CLICAR
    $("body").on("click", "#closeError", function(){
        $("#error-popup").fadeOut();
    })
    

});

function setProj(id){
    proj = id;
}

function setMsg(msg, type){

    const arr = {
        msg : msg,
        type : type
    }

    msg_res = arr;
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
                    var _src = base_url + "file/profilePic/"+ data["nomes"][j][2]; 
                    var _name = data["nomes"][j][0] + data["nomes"][j][1]
                    names = names + '<a class="groupmember" href="'+ base_url +'app/profile/'+ data["nomes"][j][2] + '">' + '<img class="groupMemberImg" src="'+_src+'" alt="' + _name +'">' + "<span class='memberName'>" + data["nomes"][j][0] + " " + data["nomes"][j][1] + "</span>" + "</a>";
                }
                $("#grupos-container").html('<div class="myGroupDiv" id="grupo'+grupo+'">' +
                '<p><b>Membros do seu grupo: </b></p><p>'+ names +'</p>' + 
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
            var d1 = data["data_final"].split(" ");
            var date_full = d1[0].split("-");
            var hours_full = d1[1].split(":");
            var date = new Date(date_full[0], date_full[1]-1, date_full[2], hours_full[0], hours_full[1], hours_full[2]);
            checkEntrega(date);
            makeEtapaDiv(data["etapas"]);
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

        array_etapa.push('<div class="etapasDIV" id="etapa' + json["id"] +'"><p><b>'+json["nome"]+'</b></p>'+
        '<p class="'+pClass+'">'+ dateFormatter(date) +'</p>'+
        '<p><input class="moreButton" id='+json["id"] +' type="button" value="Ver Mais"></input></p>' +
        '</div><hr>');


        if (enunciado == ""){
            newenunciado = "Não existe enunciado associado a esta etapa."
        } else {
            newenunciado = "<a target='_blank' href='" + base_url + "file/enunciadoEtapa/" + proj + "/" + json["id"] + "'>" + enunciado_original + "</a>"
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

    if (enunciado_h4 != "" && enunciado_original != ""){
        $("#enunciado_h4").html("Enunciado: <a target='_blank' href='"+ base_url + "file/enunciadoFile/" + proj  + "'>" + enunciado_original + "</a>");
    } else {
        $("#enunciado_h4").text("Este projeto ainda não tem enunciado.")
    }
}


function setEnunciado(url){
    enunciado_h4 = url;
}

function setEnunciadoOriginal(url){
    enunciado_original = url;
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
                var base_link = base_url + "file/submissionEtapa/" + proj + "/" + etapa + "/" + grupo;
                if (data[0]["feedback"] == ""){
                    $("#feedback_label").text("Ainda não foi atribuido feedback a esta etapa.");
                } else {
                    $("#feedback_label").text(data[0]["feedback"]);
                }
                $("#sub_label").html('<a target="_blank" href="'+base_link+'">' + data[0]["submit_original"] + '</a>');
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

function showPopup(){
    $(".cd-popup").css('visibility', 'visible');
    $(".cd-popup").css('opacity', '1');
}

function hidePopup(){
    $(".cd-popup").css('visibility', 'hidden');
    $(".cd-popup").css('opacity', '0');
    $("#error-popup").remove();
}


function createSubmissionPopup(etapa_rec, name){
    var etapa;
    for (i=0; i<etapas_info_global.length; i++){
        if(etapa_rec == etapas_info_global[i].id){
            etapa = etapas_info_global[i];
        }
    }

    popup = '<h3>Etapa '+name+'</h3><h3>Descrição:</h3><label>'+etapa["description"]+'</label>'+
    '<h3>Enunciado: </h3><label id="enunciado_label">'+etapa["enunciado"]+'</label>'+
    '<h3>Submissão: </h3><label id="sub_label"></label> <h3>Feedback: </h3> <label id="feedback_label"></label>'+
    '<div id="popup-form"></div>'

    
    form = '<br><form enctype="multipart/form-data" accept-charset="utf-8" method="post" id="form-submit-etapa" action="'+base_url + 'UploadsC/uploadSubmissao/' + proj + '/' + selected_etapa + '/' + grupo+'">' +
    '<input class="form-input-file" type="file" id="file_submit" name="file_submit" accept=".zip,.rar,.pdf,.docx">'+
    '<label for="file_submit" class="input-label"><img id="file-img-submit" src="'+base_url+'images/icons/upload-solid.png">'+
    '<span id="name-file-submit">Submeter trabalho</span></label>'+
    '<p class="msg-warning-size"><b>Tamanho máximo de ficheiro é de 2MB</b></p>'+
    '</form>'

    $("#error-popup").remove();
    $(".cd-message").html(popup);
    $("#popup-form").html(form);
    $(".cd-message").after('<div id="error-popup" class="submit-msg">Mensagem de erro template</div>');
}