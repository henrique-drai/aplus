$(document).ready(() => {

    const months = {
        "Janeiro":1,
        "Fevereiro":2,
        "Março":3,
        "Abril":4,
        "Maio":5,
        "Junho":6,
        "Julho":7,
        "Agosto":8,
        "Setembro":9,
        "Outubro":10,
        "Novembro":11,
        "Dezembro":12
    }

    getTasks();

    const id = localStorage.grupo_id;
    var task_id;

    $("body").on("click", "#ratingmembros", function() {
        window.location = base_url + "app/rating/" + localStorage.grupo_id;
    })
    
    $("body").on("click", "#ficheiros", function() {
        window.location = base_url + "app/ficheiros/" + localStorage.grupo_id;
    })

    $("#newTarefa").click(function() {
        createPopUpAdd();
    })
	
	//close popup - REMOVER FORUM
	$('body').on('click', '.cd-popup', function(){
		if( $(event.target).is('.cd-popup-close') || $(event.target).is('.cd-popup') || $(event.target).is('#closeButton') ){
            event.preventDefault();
            $(this).remove();
		}
    });

    //close popup2 - REMOVER FORUM
	$('body').on('click', '.cd-popup2', function(){
		if( $(event.target).is('.cd-popup-close') || $(event.target).is('.cd-popup2') || $(event.target).is('#closeButton') ){
            event.preventDefault();
            $(this).remove();
		}
    });

    $("body").on("change", "select", function() {
        if($("select").val() == "") {
            $("select").css("border-left-color", "salmon");
        } else {
            $("select").css("border-left-color", "#42d542");
        }
    })

    $("body").on("click", "#addTask-form-submit", function(){
        var taskName = $('input[name="tarefaName"]').val();
        var taskDesc = $('textarea[name="tarefaDescription"').val();
        var taskMember = $('select').val();

        if(taskName != '' && taskMember != '') {
            insertTask(taskName, taskDesc, taskMember);
        }
    })

    $("body").on("click", ".delete_img", function () {
        task_id = $(this).attr("id");
        makePopup("confirmRemove", "Tem a certeza que deseja eliminar a tarefa?");
        $(".cd-popup").css('visibility', 'visible');
        $(".cd-popup").css('opacity', '1');
    })

    $("body").on('click', '#confirmRemove', function(){
        deleteTaskById(task_id);
    })

    checkClosedProject()
});

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

function checkClosedProject(){
    $.ajax({
        type: "GET",
        url: base_url + "api/getProjectStatus",
        data: {grupo_id: localStorage.grupo_id},
        success: function(data) {
            
            // PARA TESTAR - SE QUISEREM
            // var ano = new Date(data.date)
            // var ano = new Date("05/05/2020")
            // var dataAtual = Date.now();

            // if(ano < Date.now()){
            //     $("#btnArea").append("<input id='ratingmembros' type='button' value='Rating Membros'>")
            // }
            // else{
            //     $("#ratingmembros").remove()
            // }

                
            if(new Date(data.date)<Date.now()){
                if(new Date(data.date).addDays(5)<Date.now()){
                    $("#btnArea").append("<p>Ultrapassado o tempo máximo (5 dias) p/ classificação dos membros<p>")
                }
                else{
                    $("#btnArea").append("<input id='ratingmembros' type='button' value='Rating Membros'>")
                }
                // $("#btnArea").append("<input id='ratingmembros' type='button' value='Rating Membros'>")
            }
            // Acho que este remove é opcional visto que volta a carregar o html normal sem o botáo para o rating
            // Ou seja, é como se voltasse ao início
            else{ 
                $("#ratingmembros").remove()
            }

        },
        error: function(data) {
            console.log("Erro na API:")
        }
    });
}

function createPopUpAdd() {
    $.ajax({
        type: "GET",
        url: base_url + "api/getGroupMembers/" + localStorage.grupo_id,
        success: function(data) {
            console.log(data)
            var popup = '';

            popup = popup + "<div class='cd-popup2' role='alert'><div class='cd-popup-container'>" +                 
                "<form id='addTask' action='javascript:void(0)'><div class='addTask_inputs'><h2>Adicionar nova tarefa</h2>" +
                "<label class='form-label'>Nome:</label><input class='form-input-text' type='text' name='tarefaName' required>" +
                "<label class='form-label'>Descrição:</label><textarea class='form-text-area' type='text' name='tarefaDescription'>" + 
                "</textarea><label class='form-label'>Membro responsável:</label><select><option value=''>Selecionar um membro</option>";
            
            for(var i=0; i < data['users'].length; i++) {
                popup = popup + "<option value='" + data["users"][i]["id"] + "'>" + data["users"][i]["name"] + " " + 
                    data["users"][i]["surname"] + "</option>"
            }

            popup = popup + "</select></div><ul class='cd-buttons'><li><a href='#' id='addTask-form-submit'>" +
                "Criar Tarefa</a></li><li><a href='#' id='closeButton'>Cancelar</a></li></ul></form>" +
		        "<a class='cd-popup-close'></a></div></div>"
        
            $(".popupAdd").html(popup);
            $(".cd-popup2").css('visibility', 'visible');
            $(".cd-popup2").css('opacity', '1');

        },
        error: function(data) {
            console.log(data)
        }
    });
}

function insertTask(taskName, taskDesc, taskMember) {
    $.ajax({
        type: "POST",
        url: base_url + "api/insertTask",
        data: {grupo_id: localStorage.grupo_id,
               user_id: taskMember,
               name: taskName,
               description: taskDesc},
        success: function(data) {
            console.log("cool")
            $(".message").empty();
            
            $(".cd-popup2").css('visibility', 'hidden');
            $(".cd-popup2").css('opacity', '0');

            getTasks();
            
            $(".message").append("Tarefa adicionada com sucesso!");
            $(".message").fadeTo(2000, 1);
            setTimeout(function() {
                $(".message").fadeTo(2000, 0);
            }, 2000);
        },
        error: function(data) {
            console.log("Erro na API:")
            console.log(data)
        }
    });
}

function getTasks() {
    $.ajax({
        type: "GET",
        url: base_url + "api/getTasks/" + localStorage.grupo_id,
        success: function(data) {
            console.log(data)
            $(".tasksTable").empty();
            var image_url = base_url + "/images/icons/trash.png";

            if(data.tasks.length != 0) {
                $(".tasksTable").append("<table id='tab-gerir-tarefas'><tr><th>Tarefa</th><th>Descrição</th>" +
                "<th>Membro Responsável</th><th>Começo</th><th>Fim</th><th></th></tr></table>");

                for(var i=0; i < data.tasks.length; i++) {
                    $("#tab-gerir-tarefas").append("<tr><td>" + data.tasks[i].name + "</td><td>" +
                    data.tasks[i].description + "</td><td>" + data.members[i][0].name + " " + 
                    data.members[i][0].surname + "</td><td>botao de inicio</td><td>botao de fum</td><td>" +
                    "<span><img src='" + image_url + "' class='delete_img' id='" + data.tasks[i].id + "'></span><b>" + "</td></tr>");
                }
            } else {
                $(".tasksTable").append("<p>Não existem tarefas.</p>");
                $("#editTarefa").css('visibility', 'hidden');
                $("#deleteTarefa").css('visibility', 'hidden');
                
            }
        },
        error: function(data) {
            console.log("Erro na API:")
            console.log(data)
        }
    });
}


Date.prototype.addDays = function(days) {
    var date = new Date(this.valueOf());
    date.setDate(date.getDate() + days);
    return date;
}

function setGrupoId(id){
    localStorage.grupo_id=id
}

function deleteTaskById(id) {
    $.ajax({
        type: "DELETE",
        url: base_url + "api/deleteTaskById/" + id,
        success: function (data) {
            $(".message").empty();
            console.log(data);

            $(".cd-popup").css('visibility', 'hidden');
            $(".cd-popup").css('opacity', '0');

            getTasks();
            $(".message").append("Tarefa eliminada com sucesso!");
            $(".message").fadeTo(2000, 1);
            setTimeout(function () {
                $(".message").fadeTo(2000, 0);
            }, 2000);

        },
        error: function (data) {
            alert("Houve um erro a remover a tarefa.")
            console.log(data)

        }
    })
}