$(document).ready(() => {
    getInfo(localStorage.cadeira_code);
    $("#hours_inputs").hide();

    $("#edit_button").click(function() {
        var content = $("#summary").text();
        $("#save_button").show();
        $("#summary").empty();
        $("#summary").append("<textarea class='textarea'>" + content + "</textarea>");
    });

    $("#save_button").click(function() {
        var text = $("textarea").val();
        insertText(text);
        $("#summary").empty();
        $("#summary").append(text);
        $("#save_button").hide();
    });

    $("#edit_button_hours").click(function() {
        $("#hours p").hide();
        $("#hours_inputs").show();

        setHours(localStorage.getItem("cadeira_id"));
    })

    $("#add_hour").click(function() {
        var count = $(".minnuminput").last().attr("id");
        count++;
        $("#save_button_hours").hide();

        const hour = "<div id='element'><p><label class='form-label'>Início:</label>" +
            '<input type="time" class="form-input-number minnuminput" id="' + count + '"' +
            'name="start_time" min="09:00" max="18:00" required></p><p>' +
            '<label class="form-label">Fim:</label>' +
            '<input type="time" class="form-input-number maxnuminput" id="' + count + '"' +
            'name="end_time" min="09:00" max="18:00" required></p><p>' +
            '<label class="form-label">Dia da Semana:</label><select id="day">' +
            '<option value="Segunda-feira">Segunda-feira</option>' +
            '<option value="Terça-feira">Terça-feira</option>' +
            '<option value="Quarta-feira">Quarta-feira</option>' +
            '<option value="Quinta-feira">Quinta-feira</option>' +
            '<option value="Sexta-feira">Sexta-feira</option></select></p></div>';

        $("#hours_inputs").append(hour);
        $("#remove_hour").css('visibility','visible');
    })

    $("#remove_hour").click(function() {
        $("#hours_inputs > #element").last().remove();

        if($("#hours_inputs #element").length == 1) {
            $("#remove_hour").css('visibility','hidden');
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
        // saveHours();
        $("#hours_inputs").empty();
        getHours(localStorage.getItem("cadeira_id"));
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
            $("#" + id + ".minnuminput").css("border-left-color", "palegreen");
            $("#" + id +".maxnuminput").css("border-left-color", "palegreen");
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
            $("#course_title").append("<h1>" + data.info[0].name + "</h1>");
            if(data.info[0].description == "") {
                $("#summary").append("Não existe sumário para a cadeira.");
            } else {
                $("#summary").append(data.info[0].description);
            }
            localStorage.setItem('cadeira_id', data.info[0].id);
            getHours(data.info[0].id);
        },
        error: function(data) {
            alert("There was an error1. Try again");
        }
    });
}

function getHours($id) {
    $.ajax({
        type: "POST",
        url: base_url + "teacher/api/getHours",
        data: {cadeira_id: $id},
        success: function(data) {
            if(data['hours'].length != 0) {
                for(var i=0; i < data['user'].length; i++) {
                    $("#hours").append("<p><b>" + 
                    data.user[i].name + " " + data.user[i].surname + ":</b> " + 
                    data.hours[i].day + " " + data.hours[i].start_time.substring(0, 5) + " - " + 
                    data.hours[i].end_time.substring(0, 5) + "</p>");
                }
            } else {
                $("#hours").append("<p>Ainda não há horários de dúvidas disponíveis.</p>");
            }
            
        },
        error: function(data) {
            alert("There was an error2. Try again");
        }
    })
}

function insertText($text) {
    $.ajax({
        type: 'POST',
        url: base_url + "teacher/api/insertText",
        data: {text: $text, cadeira_id: localStorage.cadeira_id},
        success: function(data) {
            $(".message").fadeIn();
            setTimeout(function() {
                $(".message").fadeOut();
            }, 2000);
        },
        error: function(data) {
            alert("There was an error3. Try again");
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
            if(data['hours'].length != 0) {
                for(var i=0; i < data['user'].length; i++) {
                    if(data.user[i].id == localStorage.getItem("user_id")) {
                        $("#hours_inputs").append('<div id="element"><p>' +
                            '<label class="form-label">Início:</label>' +
                            '<input type="time" class="form-input-number minnuminput" id="' + count + '"' +
                            'name="start_time" min="09:00" max="18:00" value="' + 
                            data.hours[i].start_time.substring(0, 5) + '" required></p><p>' +
                            '<label class="form-label">Fim:</label>' +
                            '<input type="time" class="form-input-number maxnuminput" id="' + count + '"' +
                            'name="end_time" min="09:00" max="18:00" value="' + 
                            data.hours[i].end_time.substring(0, 5) + '" required></p><p>' +
                            '<label class="form-label">Fim:</label><select id="day">' +
                            '<option value="Segunda-feira">Segunda-feira</option>' +
                            '<option value="Terça-feira">Terça-feira</option>' +
                            '<option value="Quarta-feira">Quarta-feira</option>' +
                            '<option value="Quinta-feira">Quinta-feira</option>' +
                            '<option value="Sexta-feira">Sexta-feira</option>' +
                            '</select></p></div>');
                        
                        count++;
                        for(var j=0; j < $("#day option").length; j++) {
                            if($("#day option")[j].value == data.hours[i].day) {
                                $("#day option[value='" + data.hours[i].day + "']").last().attr("selected", "selected");
                            }
                        }
                    }

                    $(".minnuminput").css("border-left-color", "palegreen");
                    $(".maxnuminput").css("border-left-color", "palegreen");
                    
                    if($("#hours_inputs #element").length > 1) {
                        $("#remove_hour").css('visibility','visible');
                    }

                    $("#save_button_hours").show();
                }
            } else {
                $("#hours_inputs").append('<div id="element"><p>' +
                    '<label class="form-label">Início:</label>' +
                    '<input type="time" class="form-input-number minnuminput" id="' + count + '"' +
                    'name="start_time" min="09:00" max="18:00" required></p><p>' +
                    '<label class="form-label">Fim:</label>' +
                    '<input type="time" class="form-input-number maxnuminput" id="' + count + '"' +
                    'name="end_time" min="09:00" max="18:00" required></p><p>' +
                    '<label class="form-label">Fim:</label><select id="day">' +
                    '<option value="Segunda-feira">Segunda-feira</option>' +
                    '<option value="Terça-feira">Terça-feira</option>' +
                    '<option value="Quarta-feira">Quarta-feira</option>' +
                    '<option value="Quinta-feira">Quinta-feira</option>' +
                    '<option value="Sexta-feira">Sexta-feira</option>' +
                    '</select></p></div>');
            }
        },
        error: function(data) {
            alert("There was an error2. Try again");
        }
    })
}