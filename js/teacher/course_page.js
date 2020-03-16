$(document).ready(() => {
    getInfo(localStorage.cadeira_id);

    $("#edit_button").click(function() {
        var content = $("#summary").text();
        $("#save_button").show();
        $("#summary").empty();
        $("#summary").append("<textarea class='textarea'>" + content + "</textarea>");
        $("#save_button").click(function() {
            var text = $("textarea").val();
            insertText(text);
            $("#summary").empty();
            $("#summary").append(text);
            $("#save_button").hide();
        })
    })
})

function getInfo($id) {
    $.ajax({
        type: "POST",
        url: base_url + "teacher/api/getDescription",
        data: {cadeira_id: $id},
        success: function(data) {
            $("#course_title").append("<h1>" + data.info[0].name + "</h1>");
            $("#summary").append(data.info[0].description);
            getHours(data.info[0].id);
            // $('#text').html($('p').val().replace(/ /g, '&nbsp'));
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
        data: {cadeira_id: $id, prof_id: localStorage.user_id},
        success: function(data) {
            console.log(data.user.name);
            $("#hours").append("<p><b>" + data.user.name + " " + data.user.surname + ":</b> " + data.hours[0].horário_duvidas + "</p>");
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
            console.log("adicionado à db");
        },
        error: function(data) {
            alert("There was an error3. Try again");
        }
    })
}