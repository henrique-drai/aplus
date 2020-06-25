$(document).ready(() => {
    setInterval(getFich, 5000);

    $('body').on('click', '.quitGroupButton', function(){
        var groupid = $(this).attr("id").split('"')[1];
        leaveGroupPage(groupid);
    })

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
    getFich();

    const id = localStorage.grupo_id;
    var task_id;
    var proj_name = $("#project_name").text();

    $("body").on("click", "#ratingmembros", function() {
        window.location = base_url + "app/rating/" + localStorage.grupo_id;
    })
    
    $("body").on("click", "#ficheiros", function() {
        window.location = base_url + "app/ficheiros/" + localStorage.grupo_id;
    })

    groupMembers(id);

    $("#newTarefa").click(function() {
        createPopUpAdd();
        $(".cd-popup2").css('visibility', 'visible');
        $(".cd-popup2").css('opacity', '1');

    })
	
	// close popup
	$('body').on('click', '.cd-popup2', function(){
		if( $(event.target).is('.cd-popup-close') || $(event.target).is('.cd-popup2') || $(event.target).is('#closeButton') ){
            event.preventDefault();
            $(".cd-popup2").css('visibility', 'hidden');
            $(".cd-popup2").css('opacity', '0');
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
        var taskName = $('input[name="tarefaName"]').last().val();
        var taskDesc = $('textarea[name="tarefaDescription"').last().val();

        if(taskName != '') {
            insertTask(taskName, taskDesc);
        } else {
            $(".message_error").fadeTo(2000, 1);
        }
    })

    $("body").on("click", ".remove", function () {
        task_id = $(this).attr("id");
        getTaskName(task_id);
    })

    $("body").on('click', '#confirmRemove', function(){
        deleteTaskById(task_id);
    })

    $('body').on('click', '.taskInfo', function(){
        var task_id = $(this).attr("id");
        var tr_id = $(this).parent().parent().attr("class");
        updateTaskPopup(task_id, proj_name, tr_id);
        $(this).css("background-color", "rgb(153, 156, 155)");      
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
        var tr_id = $(this).parent().parent().attr("class");
        if ($(this).css("background-color") == "rgb(153, 156, 155)"){
            updateTaskPopup(task_id, proj_name);
            $(this).css("background-color", "white");
        } else {
            createPopUpEdit(task_id, proj_name, tr_id);
            $(this).css("background-color", "rgb(153, 156, 155)");
        }  

    });

    $("body").on("click", "#editTask-form-submit", function() {
        var task_id = $(this).attr("class");
        updateTaskById(task_id, $('input[name="tarefaName"]').last().val(), $('textarea[name="tarefaDescription"').last().val(), proj_name);
    })

    disableTasksClose()

    // --------------------- EXPORT ----------------- //
    $("#exportInfo").on("click", function(e) {
        // console.log("entrou")
        e.preventDefault()
        $.ajax({
            type: "GET", 
            url: base_url + "api/exportCSVTasks",
            data:{role: "student", grupo_id: localStorage.grupo_id},
            success:function(data){
                var downloadLink = document.createElement("a");
                var fileData = ['\ufeff'+data];

                var blobObject = new Blob(fileData,{
                    type: "text/csv;charset=utf-8;"
                });

                var url = URL.createObjectURL(blobObject);
                downloadLink.href = url;

                downloadLink.download = "tarefas.csv";
                
                document.body.appendChild(downloadLink);
                downloadLink.click();
                document.body.removeChild(downloadLink);
            }, 
            error: function(data) {
                console.log("Erro:")
                console.log(data)
            }
        })
    })    
});

function leaveGroupPage(groupid){
    $.ajax({
        type: "DELETE",
        url: base_url + "api/leaveMyGroup",
        data: {grupo_id: groupid},
    });
}

function getFich() {
    $.ajax({
		type: "GET",
        url: base_url + "api/getFicheirosGrupo/" + localStorage.grupo_id,
        data: {
			grupo_id: localStorage.grupo_id
		},
		success: function (data) {
            $(".fichNumb").html("<p>Tem " + data.ficheiros.length + " ficheiro(s) na área de grupo");
        },
		error: function (data) {
            console.log("Erro na API:")
            console.log(data)
		}
	});
}

function disableTasksClose() {
	$.ajax({
		type: "GET",
		url: base_url + "api/getProjectStatus",
		data: {
			grupo_id: localStorage.grupo_id
		},
		success: function (data) {
            // console.log(data.date)
            
            if (new Date(data.date) < Date.now()){
                $("#newTarefa").remove();
                
                
                $('table tr').find('td:eq(5),th:eq(5)').remove();
                //apaga botao de opçoes
               // $('table tr').find('td:eq(4),th:eq(4)').remove();
            		
            }
        },
		error: function (data) {
            console.log("Erro na API:")
            console.log(data)
		}
	});
}



function updateTaskPopup(task_id, proj_name, tr_id){
    $.ajax({
        type: "GET",
        url: base_url + "api/getTaskById/" + task_id,
        success: function(data) {
            var popup = '';

            popup = popup +                 
                "<div class='infoTask_inputs'><h2>Tarefa para " + proj_name.substring(1, proj_name.length - 1) + "</h2>" +
                "<h3>Nome</h3><label>" + data.task[0].name + "</label>" +
                "<h3>Descrição</h3>";
                
            if(data.task[0].description == "") {
                popup = popup + "<label>Não tem descrição.</label>"
            } else {
                popup = popup + "<label>" + data.task[0].description + "</label>";
            }

            if(data.task[0].start_date == "0000-00-00 00:00:00") {
                popup = popup + "<div class='title'></div>";
                popup = popup + "<span class='startTask'><input type='button' class='start_date_button' id='" + data.task[0].id + "' value='Iniciar Tarefa'></span>";
            } else {
                popup = popup + "<h3>Data de Início</h3>";
                popup = popup + "<label><span class='startTask'>" + data.task[0].start_date + "</span></label>";
            }

            var completed = false;
            var time_spent = '';

            if(data.task[0].start_date == "0000-00-00 00:00:00") {
                completed = false;
                popup = popup + "<div class='title_end'></div>";
                popup = popup + "<label><span class='endTask'>A tarefa ainda não foi começada.</span></label></div>";
            } else if(data.task[0].done_date != "0000-00-00 00:00:00") {
                completed = true;
                popup = popup + "<h3>Data de Fim</h3>";
                var day = data.task[0].done_date.substring(8, 10) - data.task[0].start_date.substring(8, 10);
                var hours = data.task[0].done_date.substring(11, 13) - data.task[0].start_date.substring(11, 13);
                var min = data.task[0].done_date.substring(14, 16) - data.task[0].start_date.substring(14, 16);
                var seconds = data.task[0].done_date.substring(17, 19) - data.task[0].start_date.substring(17, 19);
                popup = popup + "<label>" + data.task[0].done_date + "</label><h3>Tempo gasto na tarefa</h3><label>" + 
                        day + " dia(s) " + hours + " hora(s) " + Math.abs(min) + " minutos " + Math.abs(seconds) + " segundos</label></div>";
                time_spent = day + " dia(s) " + hours + " hora(s) " + Math.abs(min) + " minutos " + Math.abs(seconds) + " segundos";
            } else if(data.task[0].user_id == localStorage.user_id){
                completed = false;
                popup = popup + "<div class='title_end'></div>";
                popup = popup + "<span class='endTask'><input type='button' class='end_date_button' id='" + data.task[0].id + "' value='Terminar Tarefa'></span><span class='time_spent'></span></div>";
            } else {
                completed = false;
                popup = popup + "<label>A tarefa ainda não foi terminada.</label></div>";
            }

            if(data.task[0].done_date != "0000-00-00 00:00:00") {
                popup = popup + "<a class='cd-popup-close'></a></div></div>";
            } else {
                popup = popup + "<div class='wrapper'><hr><input id='" + data.task[0].id + "' class='editTask' type='button' value='Editar Tarefa'>" +
                "</div><a class='cd-popup-close'></a></div></div>";
            }            
        
            $(".cd-message").html(popup);
            $(".cd-buttons").html('');
            $(".cd-popup2").css('visibility', 'visible');
            $(".cd-popup2").css('opacity', '1');

            var name = $(".member#" + data.task[0].id + " span").text();
            $(".insertHere ." + tr_id).empty();
            $(".insertHere ." + tr_id).append("<td>" + data.task[0].name + "</td>" +
                "<td class='member' id='" + data.task[0].id + "'><span>" + name + "</span></td>" +
                "<td  class='final'>" + (completed ? "Sim" : "Não") + "</td><td class='time_end'>" + (time_spent == '' ? "Ainda não terminado" : time_spent) + "</td>" +
                "<td><input class='taskInfo' id='" + data.task[0].id + "' type='button' value='Opções' style='background-color: rgb(153, 156, 155);'></td>" +
                "<td><input id='" + data.task[0].id + "' class='remove' type='button' value='Eliminar'></td></tr>");
            $(".taskInfo#" + data.task[0].id).css("background-color", "rgb(153, 156, 155)");

        },
        error: function(data) {
            console.log(data)
        }
    });
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
                    $("#btnArea>div:eq(1)").after("<div class='btnForArea'><input disabled type='button' value='Classificar Membros'> \
                        <p class='small-font'>A data limite foi ultrapassada.<p></div>")
                }
                else{
                    $("#btnArea>div:eq(1)").after("<input id='ratingmembros' type='button' value='Classificar Membros'>")

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

    $("body").on("click", "#closeError", function() {
        $(".message_error").fadeTo(2000, 0);
    })
}

function createPopUpAdd() {
    $(".cd-message").html(               
        "<form id='addTask' action='javascript:void(0)'></form>").append("<div class='addTask_inputs'><h2>Adicionar nova tarefa</h2>" +
        "<label class='form-label'>Nome:</label><input class='form-input-text' type='text' name='tarefaName' required>" +
        "<label class='form-label'>Descrição:</label><textarea class='form-text-area' type='text' name='tarefaDescription'>" + 
        "</textarea>");

    $(".cd-buttons").html('').append("<div class='message_error'>Preencha todos os campos  <i id='closeError' class='fa fa-times' aria-hidden='true'></i></div><li><a href='#' id='addTask-form-submit'>" +
    "Criar Tarefa</a></li><li><a href='#' id='closeButton'>Cancelar</a></li>");
}

function insertTask(taskName, taskDesc) {
    $.ajax({
        type: "POST",
        url: base_url + "api/insertTask",
        data: {user_id: localStorage.user_id,
               grupo_id: localStorage.grupo_id,
               name: taskName,
               description: taskDesc},
        success: function(data) {
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
            $(".tasksTable p").remove();
            $(".insertHere").empty();

            if(data.tasks.length != 0) {
                html = [];

                for(var i=0; i < data.tasks.length; i++) {
                    table = '';
                    if(data.tasks[i].user_id == 0) {
                        table = table + "<tr class='" + i + "'><td>" + data.tasks[i].name + "</td><td class='member' id='" + data.tasks[i].id + "'><span>Ainda não atribuído</span></td>";
                    } else {
                        table = table + "<tr class='" + i + "'><td>" + data.tasks[i].name + "</td><td class='member' id='" + data.tasks[i].id + "'><span>" + data.members[i][0].name + " " + 
                        data.members[i][0].surname + "</span></td>";
                    }                    

                    if(data.tasks[i].done_date == "0000-00-00 00:00:00") {
                        table = table + "<td class='final'>Não</td class='time_end'><td>Ainda não terminado</td>";
                    } else {
                        // console.log(data)
                        var day = data.tasks[i].done_date.substring(8, 10) - data.tasks[i].start_date.substring(8, 10);
                        var hours = data.tasks[i].done_date.substring(11, 13) - data.tasks[i].start_date.substring(11, 13);
                        var min = data.tasks[i].done_date.substring(14, 16) - data.tasks[i].start_date.substring(14, 16);
                        var seconds = data.tasks[i].done_date.substring(17, 19) - data.tasks[i].start_date.substring(17, 19);
                        table = table + "<td class='final'>Sim</td><td>" + day + " dia(s) " + hours + " hora(s) " + Math.abs(min) + " minutos " + Math.abs(seconds) + " segundos</td>";
                    }

                    table = table + "<td><input class='taskInfo' id='" + data.tasks[i].id + 
                    "' type='button' value='Opções'></td><td><input id='" + data.tasks[i].id + "' class='remove' type='button' value='Eliminar'></td></tr>";
                    html.push(table);
                }
                
                $('.container2').pagination({
					dataSource: html,
					pageSize: 5,
					callback: function(data, pagination) {
						$(".insertHere").html(data);
					}
                })
                
            } else {
                $('.container2').empty();
                $(".tasksTable p").remove();
                $(".tasksTable").append("<p>Não existem tarefas.</p>");
                
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
        data: {grupo_id: localStorage.grupo_id},
        success: function (data) {
            $(".message").empty();

            $(".cd-popup2").css('visibility', 'hidden');
            $(".cd-popup2").css('opacity', '0');

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
            $(".startTask").empty();
            $("#" + task_id + ".member").empty();
            $(".title").empty();
            $(".title").append("<h3>Data de Início</h3>");
            $(".startTask").append("<label><span class='startTask'>" + data.data + "</span></label>");
            $(".endTask").empty();
            $(".endTask").append("<input type='button' class='end_date_button' id='" + task_id + "' value='Terminar Tarefa'>");
            $(".infoTask_inputs").append("<span class='time_spent'></span>");
            $("#" + task_id + ".member").append("<span>" + data.user + "</span>");
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
            $(".endTask").empty();
            $(".title_end").empty();
            $(".endTask").append("<label>" + data + "</label>");
            var day = data.substring(8, 10) - $(".startTask").text().substring(8, 10);
            var hours = data.substring(11, 13) - $(".startTask").text().substring(11, 13);
            var min = data.substring(14, 16) - $(".startTask").text().substring(14, 16);
            var seconds = data.substring(17, 19) - $(".startTask").text().substring(17, 19);
            $(".time_spent").append("<h3>Tempo gasto na tarefa</h3></label>" + day + " dia(s) " + hours + " hora(s) " + Math.abs(min) + " minutos " + Math.abs(seconds) + " segundos " + "</label>");
            $(".time_end").empty();
            $(".title_end").append("<h3>Data de Fim</div>");
            $(".time_end").append(day + " dia(s) " + hours + " hora(s) " + Math.abs(min) + " minutos " + Math.abs(seconds) + " segundos")
            $(".wrapper").remove();
            $(".final").empty()
            $(".final").append("Sim");
        },
        error: function (data) {
            alert("Houve um erro a inserir a data-fim da tarefa.")
            console.log(data)

        }
    })
}

function createPopUpEdit(task_id, proj_name, tr_id) {
	$.ajax({
		type: "GET",
		url: base_url + "api/getTaskById/" + task_id,
		success: function (data) {
			// console.log(data)

            $(".cd-message").html("<form id='editTask' action='javascript:void(0)'></form>").append("<div class='editTask_inputs'>" +
                "<h2>Tarefa para " + proj_name.substring(1, proj_name.length - 1) + "</h2>" +
                "<h3>Nome</h3><input class='form-input-text' type='text' name='tarefaName' required>" +
                "<h3>Descrição</h3><textarea class='form-text-area' type='text' name='tarefaDescription' id='tarefaDescription'>" +
                "</textarea></div><div class='wrapper'><hr><input id='" + data.task[0].id + "' class='editTask' type='button' value='Voltar'>" +
                "</div>");

            $("input[name='tarefaName']").val(data.task[0].name);
            $("textarea[name=tarefaDescription]").val(data.task[0].description);

            $(".cd-buttons").html('').append("<li><a href='#' id='editTask-form-submit'class='" + data.task[0].id + "'>" +
            "Confirmar</a></li><li><a href='#' id='closeButton'>Cancelar</a></li>");

			$(".cd-popup2").css('visibility', 'visible');
            $(".cd-popup2").css('opacity', '1');

            $(".editTask").css("background-color", "rgb(153, 156, 155)");
		},
		error: function (data) {
			console.log(data)
		}
	});
}

function updateTaskById(task_id, name, description, proj_name) {
    $.ajax({
        type: "POST",
        url: base_url + "api/updateTaskById/" + task_id,
        data: {name: name, description: description, grupo_id: localStorage.grupo_id},
        success: function(data) {
            updateTaskPopup(task_id, proj_name);

            if ($(".editTask").css("background-color") == "rgb(153, 156, 155)"){
                $(".editTask").css("background-color", "white");
            } else {
                $(".editTask").css("background-color", "rgb(153, 156, 155)");
            }
        },
        error: function(data) {
            console.log("ups")
            console.log(data)
        }
    })
}

function getTaskName(task_id) {
    $.ajax({
		type: "GET",
		url: base_url + "api/getTaskById/" + task_id,
		success: function (data) {
            var name = data.task[0].name;
            
            $(".cd-message").html("<p>Tem a certeza que deseja eliminar a tarefa '" + name + "'?</p>");
            $(".cd-buttons").html('').append("<li><a href='#' id='confirmRemove'>" +
                "Sim</a></li><li><a href='#' id='closeButton'>Não</a></li>");

            $(".cd-popup2").css('visibility', 'visible');
            $(".cd-popup2").css('opacity', '1');
		},
		error: function (data) {
			console.log(data)
		}
	});
}

function groupMembers(group_id){;
    $.ajax({
        type: "GET",
        url: base_url + "api/getGroupMembers/" + group_id,
        data: {group_id: group_id},
        success: function(data) {
            var names = '';
            for(var j=0; j < data["users"].length; j++) {
                var _img = data["users"][j]["picture"]!=""? data["users"][j]["id"] + data["users"][j]["picture"] : "default.jpg";
                var _src = base_url + "uploads/profile/"+ _img; 
                var _name = data["users"][j]["name"] + data["users"][j]["surname"]
                names = names + '<a class="groupmember" href="'+ base_url +'app/profile/'+ data["users"][j]["id"] + '">' + '<img class="groupMemberImg" src="'+_src+'" alt="' + _name +'">' + "<span class='memberName'>" + data["users"][j]["name"] + " " + data["users"][j]["surname"] + "</span>" + "</a>";
            }
            $(".GroupMembers").html('<br><h3>Membros do grupo</h3>' + '<p>'+ names +'</p>');
        },
        error: function(data) {
            console.log(data);
        }
    });
}