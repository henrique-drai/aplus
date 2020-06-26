var id
var code

$(document).ready(() => {
    insertLoggedDate(localStorage.cadeira_id);
    getInfo(localStorage.cadeira_code);   
    localStorage.setItem("role", "teacher");

    $("#edit_button").click(function() {
        var content = $(".summary p").text();
        $("#save_button").show();
        $(".summary").empty();
        $(".summary").append("<textarea class='textarea'>" + content + "</textarea>");
        $("#edit_button").hide();
    });

    $("#save_button").click(function() {
        var text = $("textarea").val();
        insertText(text);
        $(".summary").empty();
        $(".summary").append("<p>" + text + "</p>");
        $("#save_button").hide();
        $("#edit_button").show();
    });

    $("#edit_button_hours").click(function() {
        setHours(localStorage.cadeira_id);
    })

    $("body").on("click", ".add_hour_button", function() {
        var count = $(".minnuminput").last().attr("id");
        var popup = '';
        count++;

        if(count == 0) {
            popup = popup + '<div id="' + count + '"><h4>Horário ' + (count + 1) + '</h4>';
        } else {
            popup = popup + '<div id="' + count + '"><span><img class="remove_hour" id="' + count + '" src="' + base_url + 'images/icons/delete.png"></span><h4>Horário ' + (count + 1) + '</h4>';
        }
       
        popup = popup + '<div class="dates"><label class="form-label">Início:' +
            '<input type="time" class="form-input-number minnuminput" id="' + count + '"' +
            'name="start_time" min="09:00" max="18:00" required></label>' +
            '<label class="form-label">Fim:' +
            '<input type="time" class="form-input-number maxnuminput" id="' + count + '"' +
            'name="end_time" min="09:00" max="18:00" required></label></div>' +
            '<label class="form-label" id="label_day">Dia da Semana:</label><select class="day" id="' + count + '">' +
            '<option value="Segunda-feira">Segunda-feira</option>' +
            '<option value="Terça-feira">Terça-feira</option>' +
            '<option value="Quarta-feira">Quarta-feira</option>' +
            '<option value="Quinta-feira">Quinta-feira</option>' +
            '<option value="Sexta-feira">Sexta-feira</option>' +
            '</select></div>';

        $(".infoTask_inputs").append(popup);
    })

    $("body").on("click", ".remove_hour", function() {
        var count = $(this).attr("id");
        $("#" + count).remove();

        refreshHours();
    })

    $("body").on("click", ".delete_img", function(){
        var id = $(this).attr("id");
        $(".cd-message").html("<p>Tem a certeza que deseja eliminar o horário de dúvidas?</p>");
        $(".cd-buttons").html('').append("<li><a href='#' id='confirmRemove'>" +
            "Sim</a></li><li><a href='#' id='closeButton'>Não</a></li>");
        
        $(".cd-popup").css('visibility', 'visible');
        $(".cd-popup").css('opacity', '1');

        $("body").on("click", "#confirmRemove", function() {
            deleteHourById(id);
        })
    })

    $("body").on("keyup", ".maxnuminput", function(){
        var id = $(this).attr("id");
        validateFormNumb(id);
    })

    $("body").on("keyup", ".minnuminput", function(){
        var id = $(this).attr("id");
        validateFormNumb(id);
    })

    $("body").on("click", "#add_hour_confirm", function() {
        var flag = false;

        $('.infoTask_inputs input').each(function(index){
            if($(this).css('border-left-color') == 'rgb(255, 0, 0)') {
                flag = false;
                return false;
            } else {
                flag = true;
            }
        })

        if(flag == false) {
            $(".message_error").css('opacity', '1');
        } else {
            for(var i=0; i <= $(".minnuminput").last().attr("id"); i++) {
                const data = {
                    'user_id': localStorage.getItem('user_id'),
                    'cadeira_id': localStorage.getItem('cadeira_id'),
                    'start_time': $("#" + i + ".minnuminput").val(),
                    'end_time': $("#" + i + ".maxnuminput").val(),
                    'day': $("#" + i + ".day").val(),
                }
                saveHours(data);
            }
            
            $(".cd-popup").css('visibility', 'hidden');
            $(".cd-popup").css('opacity', '0');
        }        
    })

    var link = location.href.split(localStorage.cadeira_code);
    var ano = link[1].replace("/","");


    $("body").on("click", ".studentsList_button", function() {
        window.location = base_url + "subjects/students/" + localStorage.cadeira_code + "/" + ano;
    })

    $("body").on("click", ".filearea-button", function() {
        window.location = base_url + "subjects/ficheiros/" + localStorage.cadeira_code + "/" + ano;
    })

    $("body").on("click", ".newProject_button", function() {
        window.location = base_url + "projects/new/" + localStorage.cadeira_code + "/" + ano;
    })

    $("body").on("click", ".project_button", function() {
        window.location = base_url + "projects/project/" + $(this).attr("id");
    })

    $("body").on("click", ".new_forum", function() {
        window.location = base_url + "foruns/new/" + localStorage.cadeira_code + "/" + ano;
    })

    $("body").on("click", ".forum_button", function() {
        localStorage.setItem("role", "teacher");
        localStorage.setItem("forum_id", $(this).attr("id"));
        window.location = base_url + "foruns/forum/" + $(this).attr("id");
    })

    //close popup
	$('body').on('click', '.cd-popup', function(){
		if( $(event.target).is('.cd-popup-close') || $(event.target).is('.cd-popup') || $(event.target).is('#closeButton') ){
            event.preventDefault();
            $(this).css('visibility', 'hidden');
            $(this).css('opacity', '0');
		}
    });

    $("body").on("click", "#closeError", function(){
        $(".message_error").css('opacity', '0');
    })
})

function setID(newid){
    id = newid;
    localStorage.setItem("cadeira_id", id);
}

function setCode(newcode){
    code = newcode;
    localStorage.setItem("cadeira_code", code);
}

function validateFormNumb(id){
    if($("#" + id + ".minnuminput").val() != '' && $("#" + id +".maxnuminput").val() != ''){
        if($("#" + id +".maxnuminput").val() <= $("#" + id + ".minnuminput").val()){
            $("#" + id + ".minnuminput").css("border-left-color", "red");
            $("#" + id +".maxnuminput").css("border-left-color", "red");
            return false;
        } else {
            $("#" + id + ".minnuminput").css("border-left-color", "#42d542");
            $("#" + id +".maxnuminput").css("border-left-color", "#42d542");
            return true;
        }
    }
}

function getInfo() {
    $.ajax({
        type: "GET",
        url: base_url + "api/getCadeira/" + id,
        data: {role: "teacher", user_id: localStorage.user_id},
        success: function(data) {
            var color = convertHex(data.desc[0].color, 52);

            $("#subject_title").empty();
            $("#subject_title").append("<h1>" + data.desc[0].name + "</h1>");
            if(data.desc[0].description == "") {
                $(".summary").append("<p>Não existe sumário para a cadeira.</p>");
            } else {
                $(".summary").append("<p>" + data.desc[0].description + "</p>");
            }

            var image_url = base_url + "images/subjects/project_pattern.png";
            $(".projetos").empty();
            if(data.proj.length == 0) {
                $(".projetos").append("<p>Ainda não existem projetos para a cadeira</p>");
            } else {
                for(var i=0; i < data.proj.length; i++) {
                    $(".projetos").append("<a class='project_button' id='" + data.proj[i].id + "' href='#" +
                    "'><div class='card_info_project'><div class='color_project' style='background-image: linear-gradient(to bottom, " + color + ", " + color + ")," +
                    "url(" + image_url + "); height: 69%;'></div><div class='subject'>" +
                    "<div id='title'>" + data.desc[0].name + "</div><div>Projeto " + (i+1) + "</div></div></div></a>");
                }  
            }

            var image_url = base_url + "images/subjects/forum_pattern.png";
            $(".foruns").empty();
            if(data.forum.length == 0) {
                $(".foruns").append("<p>Ainda não existem fóruns para a cadeira</p>");
            } else {
                for(var i=0; i < data.forum.length; i++) {
                    $(".foruns").append("<a class='forum_button' id='" + data.forum[i].id + "' href='#" +
                    "'><div class='card_info_forum'><div class='color_forum' style='background-image: linear-gradient(to bottom, " + color + ", " + color + ")," +
                    "url(" + image_url + "); height: 69%;'></div><div class='subject'>" +
                    "<div id='title'>" + data.desc[0].name + "</div><div>" + data.forum[i].name + "</div></div></div></a>");
                }  
            }

            var image_url = base_url + "images/icons/trash.png";
            $(".hours p").remove();
            if(data['hours'].length != 0) {
                for(var i=0; i < data['user'].length; i++) {
                    $(".hours").append("<p><span><img src='" + image_url + "' class='delete_img' id='" + data.hours[i].id + "'></span><b>" + 
                    data.user[i].name + " " + data.user[i].surname + ":</b> " + 
                    data.hours[i].day + " " + data.hours[i].start_time.substring(0, 5) + " - " + 
                    data.hours[i].end_time.substring(0, 5) + "</p>");
                }
            } else {
                $(".hours").append("<p>Ainda não há horários de dúvidas disponíveis.</p>");
            }
        },
        error: function(data) {
            console.log("Houve um erro ao ir buscar a informação da cadeira.");
        }
    });
}

function insertText($text) {
    $.ajax({
        type: 'POST',
        url: base_url + "api/insertText",
        data: {text: $text, cadeira_id: localStorage.cadeira_id},
        success: function(data) {
            $("#message1").fadeTo(2000, 1);
            setTimeout(function() {
                $("#message1").fadeTo(2000, 0);
            }, 2000);
        },
        error: function(data) {
            console.log("Houve um erro ao inserir o texto.");
        }
    })
}

function setHours() {
    $.ajax({
        type: "GET",
        url: base_url + "api/getHours/" + id,
        success: function(data) {
            var count = 0;
            var flag = false;
            var popup = "<h2>Editar Horários de Dúvidas</h2>" +
            "<input type='button' class='add_hour_button' value='Adicionar Horário'><div class='infoTask_inputs'>";

            for(var i=0; i < data['user'].length; i++) {
                if(data.user[i].id == localStorage.user_id) {
                    flag= true;
                    break;
                } else {
                    flag = false;
                }
            }

            if(flag) {
                for(var i=0; i < data['user'].length; i++) {
                    if(data.user[i].id == localStorage.user_id) {
                        if(count == 0) {
                            popup = popup + '<div id="' + count + '"><h4>Horário ' + (count + 1) + '</h4>';
                        } else {
                            popup = popup + '<div id="' + count + '"><span><img class="remove_hour" id="' + count + '" src="' + base_url + 'images/icons/delete.png"></span><h4>Horário ' + (count + 1) + '</h4>';
                        }
                        
                        popup = popup + '<div class="dates"><label class="form-label">Início:' +
                            '<input type="time" class="form-input-number minnuminput" id="' + count + '"' +
                            'name="start_time" min="09:00" max="18:00" value="' + 
                            data.hours[i].start_time.substring(0, 5) + '" required></label>' +
                            '<label class="form-label">Fim:' +
                            '<input type="time" class="form-input-number maxnuminput" id="' + count + '"' +
                            'name="end_time" min="09:00" max="18:00" value="' + 
                            data.hours[i].end_time.substring(0, 5) + '" required></label></div>' +
                            '<label class="form-label" id="label_day" >Dia da Semana:</label><select class="day" id="' + count + '">' +
                            '<option value="Segunda-feira" ' + (data.hours[i].day == "Segunda-feira" ? "selected" : "") + '>Segunda-feira</option>' +
                            '<option value="Terça-feira" ' + (data.hours[i].day == "Terça-feira" ? "selected" : "") + '>Terça-feira</option>' +
                            '<option value="Quarta-feira" ' + (data.hours[i].day == "Quarta-feira" ? "selected" : "") + '>Quarta-feira</option>' +
                            '<option value="Quinta-feira" ' + (data.hours[i].day == "Quinta-feira" ? "selected" : "") + '>Quinta-feira</option>' +
                            '<option value="Sexta-feira" ' + (data.hours[i].day == "Sexta-feira" ? "selected" : "") + '>Sexta-feira</option>' +
                            '</select></div>';
                        
                        $(".cd-message").html(popup);
                        
                        // for(var j=0; j < $("#" + count + " > .day option").length; j++) {
                        //     if($("#" + count + " > .day option")[j].value == data.hours[i].day) {
                        //         $("#" + count + ".day").val(data.hours[i].day);
                        //         // $("#" + count + " > .day option[value='" + data.hours[i].day + "']").prop("selected", true);
                        //         // $("#" + count + " > .day option[value='" + data.hours[i].day + "']").attr("selected", "selected");
                        //         console.log( $("#" + count + ".day").val())
                        //     }
                        // }

                        count++;
                    }

                    $(".minnuminput").css("border-left-color", "#42d542");
                    $(".maxnuminput").css("border-left-color", "#42d542");
                }
            } else {
                if(count == 0) {
                    popup = popup + '<div id="' + count + '"><h4>Horário ' + (count + 1) + '</h4>';
                } else {
                    popup = popup + '<div id="' + count + '"><span><img class="remove_hour" id="' + count + '" src="' + base_url + 'images/icons/delete.png"></span><h4>Horário ' + (count + 1) + '</h4>';
                }

                popup = popup + '<div class="dates"><label class="form-label">Início:' +
                    '<input type="time" class="form-input-number minnuminput" id="' + count + '"' +
                    'name="start_time" min="09:00" max="18:00" required></label>' +
                    '<label class="form-label">Fim:' +
                    '<input type="time" class="form-input-number maxnuminput" id="' + count + '"' +
                    'name="end_time" min="09:00" max="18:00" required></label></div>' +
                    '<label class="form-label" id="label_day">Dia da Semana:</label><select class="day" id="' + count + '">' +
                    '<option value="Segunda-feira">Segunda-feira</option>' +
                    '<option value="Terça-feira">Terça-feira</option>' +
                    '<option value="Quarta-feira">Quarta-feira</option>' +
                    '<option value="Quinta-feira">Quinta-feira</option>' +
                    '<option value="Sexta-feira">Sexta-feira</option>' +
                    '</select></div>';

                $(".cd-message").html(popup);
            }

            $(".cd-buttons").html('').append("<div class='message_error'>Preencha todos os campos  <i id='closeError' class='fa fa-times' aria-hidden='true'></i></div>" +
                "<li><a href='#' id='add_hour_confirm'>" +
                "Confirmar</a></li><li><a href='#' id='closeButton'>Cancelar</a></li>");
            
            $(".cd-popup").css('visibility', 'visible');
            $(".cd-popup").css('opacity', '1');
        },
        error: function(data) {
            console.log("Houve um erro ao mostrar os horários de dúvidas.");
        }
    })
}

function getHours($id) {
    $.ajax({
        type: "GET",
        url: base_url + "api/getHours/" + id,
        success: function(data) {
            var image_url = base_url + "images/icons/trash.png";

            $(".hours p").remove();
            if(data['hours'].length != 0) {
                for(var i=0; i < data['user'].length; i++) {
                    $(".hours").append("<p><span><img src='" + image_url + "' class='delete_img' id='" + data.hours[i].id + "'></span><b>" + 
                    data.user[i].name + " " + data.user[i].surname + ":</b> " + 
                    data.hours[i].day + " " + data.hours[i].start_time.substring(0, 5) + " - " + 
                    data.hours[i].end_time.substring(0, 5) + "</p>");
                }
            } else {
                $(".hours").append("<p>Ainda não há horários de dúvidas disponíveis.</p>");
            }
            
        },
        error: function(data) {
            console.log("Houve um erro a ir buscar os horários de dúvidas.");
        }
    })
}

function saveHours(data) {
    $.ajax({
        type: "POST",
        url: base_url + "api/insertHours",
        data: data,
        success: function(data) {
            $("#message_hour").fadeTo(2000, 1);
            setTimeout(function() {
                $("#message_hour").fadeTo(2000, 0);
            }, 2000);

            getHours(id);
        },
        error: function(data) {
            console.log("Houve um erro ao inserir as novas datas.")
        }
    })
}

function removeHours(data) {
    $.ajax({
        type: "DELETE",
        url: base_url + "api/removeHours",
        data: data,
        success: function(data) {
            console.log("apagou");
        },
        error: function(data) {
            console.log("Houve um erro a remover a data.")
        }
    })
}

function deleteHourById(id) {
    $.ajax({
        type: "DELETE",
        url: base_url + "api/deleteHourById",
        data: {id: id, user_id: localStorage.user_id, cadeira_id: localStorage.cadeira_id},
        success: function(data) {
            getHours(id);
            $(".cd-popup").css('visibility', 'hidden');
            $(".cd-popup").css('opacity', '0');
        },
        error: function(data) {
            console.log("Houve um erro a remover a data.")
        }
    })
}

function insertLoggedDate(id) {
    $.ajax({
        type: "POST",
        url: base_url + "api/insertDate/" + id + "/teacher",
        success: function(data) {
            console.log(data)
        },
        error: function(data) {
            console.log("Houve um erro ao ir buscar a informação das cadeiras lecionadas.");
        }
    })
}

function convertHex(hex,opacity){

    hex = hex.replace('#','');
    r = parseInt(hex.substring(0,2), 16);
    g = parseInt(hex.substring(2,4), 16);
    b = parseInt(hex.substring(4,6), 16);

    result = 'rgba('+r+','+g+','+b+','+opacity/100+')';
    return result;

}

function refreshHours() {
    $('h4').each(function(index){
        $(this).text('Horário ' + index.toString());
    })
}