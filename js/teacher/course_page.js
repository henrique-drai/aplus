$(document).ready(() => {
    getInfo(localStorage.cadeira_id);

    $("#edit_button").click(function() {
        var content = $("#summary").text();
        $("#save_button").show();
        $("#summary").empty();
        $("#summary").append("<textarea class='textarea'>" + content + "</textarea>");
    });

    $("#save_button").click(function() {
        var text = $("textarea").val();
        // console.log(text);
        insertText(text);
        $("#summary").empty();
        $("#summary").append(text);
        $("#save_button").hide();
    });
})

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
            getHours(data.info[0].id);
            // $('#text').html($('p').val());
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
            console.log(data);
            for(var i=0; i < data['user'].length; i++) {
                $("#hours").append("<p><b>" + data.user[i].name + " " + data.user[i].surname + ":</b> " + data.hours[i].day + " " + data.hours[i].start_time + " - " + data.hours[i].end_time + "</p>");
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
            $("#message").fadeIn();
            setTimeout(function() {
                $("#message").fadeOut();
            }, 2000);
        },
        error: function(data) {
            alert("There was an error3. Try again");
        }
    })
}