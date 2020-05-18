$(document).ready(() => {

    getTasks();

    // dar set no id do grupo pelo url - ou seja - se o utilizador vier para esta pagina pelo link.

    var link = location.href.split("grupo");
    var id = link[1].replace("/","");
    localStorage.setItem("grupo_id", id);

    $("body").on("click", "#ratingmembros", function() {
        window.location = base_url + "app/rating/" + localStorage.grupo_id;
    })
    
    $("body").on("click", "#ficheiros", function() {
     
        window.location = base_url + "app/ficheiros/" + localStorage.grupo_id;
    })

    $("#newTarefa").click(function() {
        createPopUpAdd();
    })

    $('body').on("click", '.close', function() {
        $(".overlay").css('visibility', 'hidden');
        $(".overlay").css('opacity', '0');
    })

    $("body").on("keyup", "#maxnuminput", function(){
        validateFormNumb(id);
    })

    $("body").on("keyup", "#minnuminput", function(){
        validateFormNumb(id);
    })

    $("body").on("click", ".createTask", function(){
        var taskName = $('input[name="tarefaName"]').val();
        var taskDesc = $('textarea[name="tarefaDescription"').val();
        var taskMember = $('select').val();
        var beginDate = $('input[name="tarefaDateInicio"]').val();
        var endDate = $('input[name="tarefaDateFim"]').val();

        if(taskName != '' && taskDesc != '') {
            insertTask(taskName, taskDesc, taskMember, beginDate, endDate);
        }
    })

    checkClosedProject();

});

function validateFormNumb(id){
    if($("#minnuminput").val() != '' && $("#maxnuminput").val() != ''){
        if($("#maxnuminput").val() <= $("#minnuminput").val()){
            $("#minnuminput").css("border-left-color", "salmon");
            $("#maxnuminput").css("border-left-color", "salmon");
            $(".createTask").hide();
            return false;
        } else {
            $("#minnuminput").css("border-left-color", "#42d542");
            $("#maxnuminput").css("border-left-color", "#42d542");
            $(".createTask").show();
            return true;
        }
    }
}

function checkClosedProject(){
    $.ajax({
        type: "GET",
        headers: {
            "Authorization": localStorage.token
        },
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
                $("#btnArea").append("<input id='ratingmembros' type='button' value='Rating Membros'>")
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
        headers: {
            "Authorization": localStorage.token
        },
        url: base_url + "api/getGroupMembers/" + localStorage.grupo_id,
        success: function(data) {
            console.log(data)
            var popup = '';

            popup = popup + "<div class='overlay' id='tarefa-overlay-new'><div class='popup'" +
            "id='tarefa-form-popup'><a class='close' href='#'>&times;</a><div class='content'>" +
            "<form id='tarefa-form' action='javascript:void(0)'><p id='tarefa' class='tarefa'>" +
            "<h2>Adicionar nova tarefa</h2><label class='form-label'>Nome:</label><input class='form-input-text'" +
            "type='text' name='tarefaName' required><label class='form-label'>Descrição:</label><textarea " +
            "class='form-text-area' type='text' name='tarefaDescription' required></textarea><label " +
            "class='form-label'>Membro responsável:</label><select>";
            
            for(var i=0; i < data['users'].length; i++) {
                popup = popup + "<option value='" + data["users"][i]["id"] + "'>" + 
                data["users"][i]["name"] + " " + data["users"][i]["surname"] + "</option>";
            }

            popup = popup + "</select><label class='form-label'>Data de começo:</label><input class='" +
            "form-input-text' id='minnuminput' type='datetime-local' name='tarefaDateInicio' required><label class='form-label'>" +
            "Data de fim:</label><input class='form-input-text' id='maxnuminput' type='datetime-local' name='tarefaDateFim' " +
            "required></p><input type='submit' class='createTask' value='Criar'></form></div></div></div>";
        
            $(".popupAdd").html(popup);
            $(".overlay").css('visibility', 'visible');
            $(".overlay").css('opacity', '1');

        },
        error: function(data) {
            console.log(data)
        }
    });
}

function insertTask(taskName, taskDesc, taskMember, beginDate, endDate) {
    $.ajax({
        type: "POST",
        headers: {
            "Authorization": localStorage.token
        },
        url: base_url + "api/insertTask",
        data: {grupo_id: localStorage.grupo_id,
               user_id: taskMember,
               name: taskName,
               description: taskDesc,
               start_date: beginDate,
               done_date: endDate},
        success: function(data) {
            console.log("cool")
            
            $(".overlay").css('visibility', 'hidden');
            $(".overlay").css('opacity', '0');

            $(".message").fadeTo(2000, 1);
            setTimeout(function() {
                $(".message").fadeTo(2000, 0);
            }, 2000);
        },
        error: function(data) {
            console.log(data)
        }
    });
}

function getTasks() {
    $.ajax({
        type: "GET",
        headers: {
            "Authorization": localStorage.token
        },
        url: base_url + "api/getTasks/" + localStorage.grupo_id,
        success: function(data) {
            console.log(data)
            $(".tasksTable").empty();

            if(data.tasks.length != 0) {
                $(".tasksTable").append("<table id='tab-gerir-tarefas'><tr><th>Tarefa</th><th>Descrição</th>" +
                "<th>Membro Responsável</th><th>Começo</th><th>Fim</th></tr></table>");

                for(var i=0; i < data.tasks.length; i++) {
                    $("#tab-gerir-tarefas").append("<tr><td>" + data.tasks[i].name + "</td><td>" +
                    data.tasks[i].description + "</td><td>" + data.members[i][0].name + " " + 
                    data.members[i][0].surname + "</td><td>" + data.tasks[i].start_date + "</td><td>" + 
                    data.tasks[i].done_date + "</td></tr>");
                }
            } else {
                $(".tasksTable").append("<p>Não existem tarefas.</p>");
            }
        },
        error: function(data) {
            console.log(data)
        }
    });
}