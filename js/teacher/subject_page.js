$(document).ready(() => {
    getInfo(localStorage.cadeira_code);    
    $(".hours_inputs").hide();

    $("#edit_button").click(function() {
        var content = $(".summary").text();
        $("#save_button").show();
        $(".summary").empty();
        $(".summary").append("<textarea class='textarea'>" + content + "</textarea>");
    });

    $("#save_button").click(function() {
        var text = $("textarea").val();
        insertText(text);
        $(".summary").empty();
        $(".summary").append(text);
        $("#save_button").hide();
    });

    $("#edit_button_hours").click(function() {
        $(".hours").empty();
        $(".hours_inputs").show();

        setHours(localStorage.getItem("cadeira_id"));
    })

    $(".add_hour").click(function() {
        var count = $(".minnuminput").last().attr("id");
        count++;
        $("#save_button_hours").hide();

        const hour = "<div class='element'><p><label class='form-label'>Início:</label>" +
            '<input type="time" class="form-input-number minnuminput" id="' + count + '"' +
            'name="start_time" min="09:00" max="18:00" required></p><p>' +
            '<label class="form-label">Fim:</label>' +
            '<input type="time" class="form-input-number maxnuminput" id="' + count + '"' +
            'name="end_time" min="09:00" max="18:00" required></p><p>' +
            '<label class="form-label">Dia da Semana:</label><select class="day" id="' + count + '">' +
            '<option value="Segunda-feira">Segunda-feira</option>' +
            '<option value="Terça-feira">Terça-feira</option>' +
            '<option value="Quarta-feira">Quarta-feira</option>' +
            '<option value="Quinta-feira">Quinta-feira</option>' +
            '<option value="Sexta-feira">Sexta-feira</option></select></p></div>';

        $(".hours_inputs").append(hour);
        $(".remove_hour").css('visibility','visible');
    })

    $(".remove_hour").click(function() {
        var count = $(".minnuminput").last().attr("id");
        const data = {
            'user_id': localStorage.getItem('user_id'),
            'cadeira_id': localStorage.getItem('cadeira_id'),
            'start_time': $("#" + count+ ".minnuminput").val(),
            'end_time': $("#" + count + ".maxnuminput").val(),
            'day': $("#" + count + ".day").val(),
        }
        removeHours(data);

        $(".hours_inputs > .element").last().remove();

        var flag = true;
        var count = $(".minnuminput").last().attr("id");

        for (var i=0; i <= count; i++) {
            if($("#" + i + ".minnuminput").css("border-left-color") == 'rgb(66, 213, 66)') {
                flag = flag && true;
            } else {
                flag = flag && false;
            }
        }

        if (flag) {
            $("#save_button_hours").show();
        }

        if($(".hours_inputs .element").length == 1) {
            $(".remove_hour").css('visibility','hidden');
        }
    })

    $("body").on("keyup", ".maxnuminput", function(){
        var id = $(this).attr("id");
        validateFormNumb(id);
    })

    $("body").on("keyup", ".minnuminput", function(){
        var id = $(this).attr("id");
        validateFormNumb(id);
    })

    $("body").on("click", "#save_button_hours", function() {
        $(".hours p").remove();
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
        
        
        $(".hours_inputs").hide();
        $(".hours_inputs .element").remove();
        $("#save_button_hours").hide();
    })

    $("body").on("click", ".studentsList_button", function() {
        window.location = base_url + "app/students/studentsList";
    })

    $("body").on("click", ".newProject_button", function() {
        window.location = base_url + "projects/new/" + localStorage.cadeira_code;
    })
})

function validateFormNumb(id){
    if($("#" + id + ".minnuminput").val() != '' && $("#" + id +".maxnuminput").val() != ''){
        if($("#" + id +".maxnuminput").val() <= $("#" + id + ".minnuminput").val()){
            $("#" + id + ".minnuminput").css("border-left-color", "salmon");
            $("#" + id +".maxnuminput").css("border-left-color", "salmon");
            $("#save_button_hours").hide();
            return false;
        } else {
            $("#" + id + ".minnuminput").css("border-left-color", "#42d542");
            $("#" + id +".maxnuminput").css("border-left-color", "#42d542");
            $("#save_button_hours").show();
            return true;
        }
    }
}

function getInfo($id) {
    $.ajax({
        type: "POST",
        url: base_url + "teacher/api/getDescription",
        data: {cadeira_id: $id},
        success: function(data) {
            $("#subject_title").append("<h1>" + data.info[0].name + "</h1>");
            if(data.info[0].description == "") {
                $(".summary").append("Não existe sumário para a cadeira.");
            } else {
                $(".summary").append(data.info[0].description);
            }
            localStorage.setItem('cadeira_id', data.info[0].id);
            getHours(data.info[0].id);
            getProj(localStorage.cadeira_id);
        },
        error: function(data) {
            alert("Houve um erro ao ir buscar a informação da cadeira.");
        }
    });
}

function getHours($id) {
    $.ajax({
        type: "POST",
        url: base_url + "teacher/api/getHours",
        data: {cadeira_id: $id},
        success: function(data) {
            $(".hours p").remove();
            if(data['hours'].length != 0) {
                for(var i=0; i < data['user'].length; i++) {
                    $(".hours").append("<p><b>" + 
                    data.user[i].name + " " + data.user[i].surname + ":</b> " + 
                    data.hours[i].day + " " + data.hours[i].start_time.substring(0, 5) + " - " + 
                    data.hours[i].end_time.substring(0, 5) + "</p>");
                }
            } else {
                $(".hours").append("<p>Ainda não há horários de dúvidas disponíveis.</p>");
            }
            
        },
        error: function(data) {
            alert("Houve um erro a ir buscar os horários de dúvidas.");
        }
    })
}

function insertText($text) {
    $.ajax({
        type: 'POST',
        url: base_url + "teacher/api/insertText",
        data: {text: $text, cadeira_id: localStorage.cadeira_id},
        success: function(data) {
            $("#message1").fadeIn();
            setTimeout(function() {
                $("#message1").fadeOut();
            }, 2000);
        },
        error: function(data) {
            alert("Houve um erro ao inserir o texto.");
        }
    })
}

function setHours($id) {
    $.ajax({
        type: "POST",
        url: base_url + "teacher/api/getHours",
        data: {cadeira_id: $id},
        success: function(data) {
            var count = 0;
            var flag = false;

            for(var i=0; i < data['user'].length; i++) {
                if(data.user[i].id == localStorage.getItem("user_id")) {
                    flag= true;
                    break;
                } else {
                    flag = false;
                }
            }

            if(flag) {
                for(var i=0; i < data['user'].length; i++) {
                    if(data.user[i].id == localStorage.getItem("user_id")) {
                        $(".hours_inputs").append('<div class="element"><p>' +
                            '<label class="form-label">Início:</label>' +
                            '<input type="time" class="form-input-number minnuminput" id="' + count + '"' +
                            'name="start_time" min="09:00" max="18:00" value="' + 
                            data.hours[i].start_time.substring(0, 5) + '" required></p><p>' +
                            '<label class="form-label">Fim:</label>' +
                            '<input type="time" class="form-input-number maxnuminput" id="' + count + '"' +
                            'name="end_time" min="09:00" max="18:00" value="' + 
                            data.hours[i].end_time.substring(0, 5) + '" required></p><p>' +
                            '<label class="form-label">Dia da Semana:</label><select class="day" id="' + count + '">' +
                            '<option value="Segunda-feira">Segunda-feira</option>' +
                            '<option value="Terça-feira">Terça-feira</option>' +
                            '<option value="Quarta-feira">Quarta-feira</option>' +
                            '<option value="Quinta-feira">Quinta-feira</option>' +
                            '<option value="Sexta-feira">Sexta-feira</option>' +
                            '</select></p></div>');
                        
                        count++;
                        for(var j=0; j < $(".day option").length; j++) {
                            if($(".day option")[j].value == data.hours[i].day) {
                                $(".day option[value='" + data.hours[i].day + "']").last().attr("selected", "selected");
                            }
                        }
                    }

                    $(".minnuminput").css("border-left-color", "#42d542");
                    $(".maxnuminput").css("border-left-color", "#42d542");
                    
                    if($(".hours_inputs .element").length > 1) {
                        $(".remove_hour").css('visibility','visible');
                    }

                    $("#save_button_hours").show();
                }
            } else {
                $(".hours_inputs").append('<div class="element"><p>' +
                    '<label class="form-label">Início:</label>' +
                    '<input type="time" class="form-input-number minnuminput" id="' + count + '"' +
                    'name="start_time" min="09:00" max="18:00" required></p><p>' +
                    '<label class="form-label">Fim:</label>' +
                    '<input type="time" class="form-input-number maxnuminput" id="' + count + '"' +
                    'name="end_time" min="09:00" max="18:00" required></p><p>' +
                    '<label class="form-label">Dia da Semana:</label><select class="day" id="' + count + '">' +
                    '<option value="Segunda-feira">Segunda-feira</option>' +
                    '<option value="Terça-feira">Terça-feira</option>' +
                    '<option value="Quarta-feira">Quarta-feira</option>' +
                    '<option value="Quinta-feira">Quinta-feira</option>' +
                    '<option value="Sexta-feira">Sexta-feira</option>' +
                    '</select></p></div>');
            }
        },
        error: function(data) {
            alert("Houve um erro ao mostrar os horários de dúvidas.");
        }
    })
}

function saveHours(data) {
    $.ajax({
        type: "POST",
        url: base_url + "teacher/api/saveHours",
        data: data,
        success: function(data) {
            $("#message_hour").fadeIn();
            setTimeout(function() {
                $("#message_hour").fadeOut();
            }, 2000);

            getHours(localStorage.cadeira_id);
        },
        error: function(data) {
            alert("Houve um erro ao inserir as novas datas.")
        }
    })
}

function removeHours(data) {
    $.ajax({
        type: "POST",
        url: base_url + "teacher/api/removeHours",
        data: data,
        success: function(data) {
            console.log("apagou");
        },
        error: function(data) {
            alert("Houve um erro a remover a data.")
        }
    })
}

function getProj(data) {
    $.ajax({
        type: "POST",
        url: base_url + "teacher/api/getProj",
        data: {cadeira_id: data},
        success: function(data) {
            $(".projetos").empty();
            if(data.length == 0) {
                $(".projetos").append("<p>Ainda não existem projetos para a cadeira</p>");
            } else {
                for(var i=1; i <= data.length; i++) {
                    $(".projetos").append("<input type='button' value='Projeto " + i + "'>");
                }
                
            }
        },
        error: function(data) {
            alert("Houve um erro a remover a data.")
        }
    })
}