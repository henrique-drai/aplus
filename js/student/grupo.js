$(document).ready(() => {
    // setInterval(getTasks, 3000); 

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
            $(".taskInfo").css("background-color", "white");
		}
    });

    //close popup2 - REMOVER FORUM
	$('body').on('click', '.cd-popup2', function(){
		if( $(event.target).is('.cd-popup-close') || $(event.target).is('.cd-popup2') || $(event.target).is('#closeButton') ){
            event.preventDefault();
            $(this).remove();
            $(".taskInfo").css("background-color", "white");
		}
    });

    //close popup2 - REMOVER FORUM
	$('body').on('click', '.cd-popup3', function(){
		if( $(event.target).is('.cd-popup-close') || $(event.target).is('.cd-popup3') || $(event.target).is('#closeButton') ){
            event.preventDefault();
            $(this).remove();
            $(".taskInfo").css("background-color", "white");
		}
    });

    $('body').on('click', '.cd-popup4', function () {
    	if ($(event.target).is('.cd-popup-close') || $(event.target).is('.cd-popup4') || $(event.target).is('#closeButton')) {
    		event.preventDefault();
    		$(this).remove();
    		$(".taskInfo").css("background-color", "white");
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

    $("body").on("click", ".remove", function () {
        task_id = $(this).attr("id");
        $(".cd-popup3").remove();
        makePopup("confirmRemove", "Tem a certeza que deseja eliminar a tarefa?");
        $(".cd-popup").css('visibility', 'visible');
        $(".cd-popup").css('opacity', '1');
    })

    $("body").on('click', '#confirmRemove', function(){
        deleteTaskById(task_id);
    })

    $('body').on('click', '.taskInfo', function(){
        var task_id = $(this).attr("id");
        updateTaskPopup(task_id);

        if ($(this).css("background-color") == "#75a790"){
            $(this).css("background-color", "white");
        } else {
            $(this).css("background-color", "#75a790");
        }        
    })

    $("body").on("click", ".start_date_button", function() {
        var task_id = $(this).attr("id");
        insertTaskStartDate(task_id);
    })

    $("body").on("click", ".end_date_button", function() {
        var task_id = $(this).attr("id");
        insertTaskEndDate(task_id);
    })

    checkClosedProject()

    $('body').on("click", ".editTask", function () {
        var task_id = $(this).attr("id");
        createPopUpEdit(task_id);

     });

     disableTasksClose()
});

function disableTasksClose() {
	$.ajax({
		type: "GET",
		url: base_url + "api/getProjectStatus",
		data: {
			grupo_id: localStorage.grupo_id
		},
		success: function (data) {
            console.log(data.date)
            
            if (new Date(data.date) < Date.now()){
                $("#newTarefa").remove();
                
                $('.tasksTable thead tr th:last').remove(); 
                $(".tasksTable th:last-child, .tasksTable td:last-child").remove();           
            		
            }
        },
		error: function (data) {
			console.log("Erro na API:")
		}
	});
}



function updateTaskPopup(task_id){
    $.ajax({
        type: "GET",
        url: base_url + "api/getTaskById/" + task_id,
        success: function(data) {
            console.log(data)
            var popup = '';

            popup = popup + "<div class='cd-popup3' role='alert'><div class='cd-popup-container' id='container-geral'>" +                 
                "<div class='infoTask_inputs'><h3>Tarefa: " + data.task[0].name + "</h3>" +
                "<h3>Descrição</h3>";
                
            if(data.task[0].description == "") {
                popup = popup + "<label>Não tem descrição.</label>"
            } else {
                popup = popup + "<label>" + data.task[0].description + "</label>";
            }

            popup = popup + "<h3>Data de Início</h3>";

            if(data.task[0].start_date == "0000-00-00 00:00:00") {
                popup = popup + "<span class='startTask'><input type='button' class='start_date_button' id='" + data.task[0].id + "' value='Iniciar Tarefa'></span>";
            } else {
                popup = popup + "<label><span class='startTask'>" + data.task[0].start_date + "</span></label>";
            }

            popup = popup + "<h3>Data de Fim</h3>";

            if(data.task[0].start_date == "0000-00-00 00:00:00") {
                popup = popup + "<label><span class='endTask'>A tarefa ainda não foi começada.</span></label></div>";
            } else if(data.task[0].done_date != "0000-00-00 00:00:00") {
                var day = data.task[0].done_date.substring(8, 10) - data.task[0].start_date.substring(8, 10);
                var hours = data.task[0].done_date.substring(11, 13) - data.task[0].start_date.substring(11, 13);
                var min = data.task[0].done_date.substring(14, 16) - data.task[0].start_date.substring(14, 16);
                var seconds = data.task[0].done_date.substring(17, 19) - data.task[0].start_date.substring(17, 19);
                popup = popup + "<label>" + data.task[0].done_date + "</label><h3>Tempo gasto na tarefa</h3><label>" + 
                        day + " dia(s) " + hours + " hora(s) " + min + " minutos " + Math.abs(seconds) + " segundos " + "</label></div>";
            } else if(data.task[0].user_id == localStorage.user_id){
                popup = popup + "<span class='endTask'><input type='button' class='end_date_button' id='" + data.task[0].id + "' value='Terminar Tarefa'></span><span class='time_spent'></span></div>";
            } else {
                popup = popup + "<label>A tarefa ainda não foi terminada.</label></div>";
            }

            popup = popup + "<div class='wrapper'><hr><input id='" + data.task[0].id + "' class='editTask' type='button' value='Editar Tarefa'>" +
                "<input id='" + data.task[0].id + "' class='remove' type='button' value='Eliminar'></div><a class='cd-popup-close'></a></div></div>";
        
            $(".popupAdd").html(popup);
            $(".cd-popup3").css('visibility', 'visible');
            $(".cd-popup3").css('opacity', '1');

        },
        error: function(data) {
            console.log(data)
        }
    });
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
                    $("#btnArea").append("<input id='ratingmembros' type='button' value='Classificar Membros'>")
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
            var popup = '';

            popup = popup + "<div class='cd-popup2' role='alert'><div class='cd-popup-container'>" +                 
                "<form id='addTask' action='javascript:void(0)'><div class='addTask_inputs'><h2>Adicionar nova tarefa</h2>" +
                "<label class='form-label'>Nome:</label><input class='form-input-text' type='text' name='tarefaName' required>" +
                "<label class='form-label'>Descrição:</label><textarea class='form-text-area' type='text' name='tarefaDescription'>" + 
                "</textarea>";

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
               name: taskName,
               description: taskDesc},
        success: function(data) {
            console.log("cool")
            $(".message").empty();
            
            $(".cd-popup2").css('visibility', 'hidden');
            $(".cd-popup2").css('opacity', '0');

            getTasks();
            
            $(".message").html("Tarefa adicionada com sucesso!");
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

            if(data.tasks.length != 0) {
                var table = "";
                table = table + "<table id='tab-gerir-tarefas'><tr><th>Tarefa</th>" +
                "<th>Membro Responsável</th><th>Completo</th><th></th></tr>";

                for(var i=0; i < data.tasks.length; i++) {
                    if(data.tasks[i].user_id == 0) {
                        table = table + "<tr><td>" + data.tasks[i].name + "</td><td>Ainda não atribuído</td>";
                    } else {
                        table = table + "<tr><td>" + data.tasks[i].name + "</td><td>" + data.members[i][0].name + " " + 
                        data.members[i][0].surname + "</td>";
                    }                    

                    if(data.tasks[i].done_date == "0000-00-00 00:00:00") {
                        table = table + "<td>Não</td>";
                    } else {
                        table = table + "<td>Sim</td>";
                    }

                    table = table + "<td><input class='taskInfo' id='" + data.tasks[i].id + "' type='button' value='Opções'></td></tr>";
                }

                table = table + "</table>"
                $(".tasksTable").html(table);
            } else {
                $(".tasksTable").html("<p>Não existem tarefas.</p>");
                
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

            $(".cd-popup").css('visibility', 'hidden');
            $(".cd-popup").css('opacity', '0');

            getTasks();
            $(".message").html("Tarefa eliminada com sucesso!");
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

function insertTaskStartDate(task_id) {
    $.ajax({
        type: "POST",
        url: base_url + "api/insertTaskStartDate/" + task_id,
        data: {grupo_id: localStorage.grupo_id, user_id: localStorage.user_id},
        success: function (data) {
            console.log(data)
            $(".startTask").empty();
            $(".startTask").append("<label><span class='startTask'>" + data + "</span></label>");
            $(".endTask").empty();
            $(".endTask").append("<input type='button' class='end_date_button' id='" + task_id + "' value='Terminar Tarefa'>");
        },
        error: function (data) {
            alert("Houve um erro a inserir a data-inicio da tarefa.")
            console.log(data)

        }
    })
}

function insertTaskEndDate(task_id) {
    $.ajax({
        type: "POST",
        url: base_url + "api/insertTaskEndDate/" + task_id,
        data: {grupo_id: localStorage.grupo_id, user_id: localStorage.user_id},
        success: function (data) {
            console.log(data)
            $(".endTask").empty();
            $(".endTask").append("<label>" + data + "</label>");
            var day = data.substring(8, 10) - $(".startTask").text().substring(8, 10);
            var hours = data.substring(11, 13) - $(".startTask").text().substring(11, 13);
            var min = data.substring(14, 16) - $(".startTask").text().substring(14, 16);
            var seconds = data.substring(17, 19) - $(".startTask").text().substring(17, 19);
            $(".time_spent").append("<h3>Tempo gasto na tarefa</h3></label>" + day + " dia(s) " + hours + " hora(s) " + min + " minutos " + Math.abs(seconds) + " segundos " + "</label>");
        },
        error: function (data) {
            alert("Houve um erro a inserir a data-fim da tarefa.")
            console.log(data)

        }
    })
}

function createPopUpEdit(task_id) {
	$.ajax({
		type: "GET",
		url: base_url + "api/getTaskById/" + task_id,
		success: function (data) {
			console.log(data)
			var popup = '';

			popup = popup + "<div class='cd-popup4' role='alert'><div class='cd-popup-container'>" +
				"<form id='editTask' action='javascript:void(0)'><div class='editTask_inputs'><h2>Editar tarefa</h2>" +
				"<label class='form-label'>Nome:</label><input class='form-input-text' type='text' name='tarefaName'>" +
				"<label class='form-label'>Descrição:</label><textarea class='form-text-area' type='text' name='tarefaDescription'>" +
                "</textarea>" + "<label class='form-label-title'> Começo:" +
                "</label><input class='form-input-date' type='datetime-local' name='startDate'>" +
                "<label class='form-label-title'> Fim: " +
                "</label><input class='form-input-date' type='datetime-local' name='doneDate'>";
                
            popup = popup + "</select></div><ul class='cd-buttons'><li><a href='#' id='editTask-form-submit'>" +
                "Confirmar</a></li><li><a href='#' id='closeButton'>Cancelar</a></li></ul></form>" +
                "<a class='cd-popup-close'></a></div></div>"

			$(".popupAdd").remove();
			$(".popupEdit").html(popup);
			$(".cd-popup4").css('visibility', 'visible');
			$(".cd-popup4").css('opacity', '1');

		},
		error: function (data) {
			console.log(data)
		}
	});
}