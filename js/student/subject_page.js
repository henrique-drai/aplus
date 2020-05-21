var id
var code

$(document).ready(() => {
    insertLoggedDate(localStorage.cadeira_id);
    getInfo();

    var link = location.href.split(localStorage.cadeira_code);
    var ano = link[1].replace("/","");

    $("body").on("click", ".project_button", function() {
        window.location = base_url + "projects/project/" + $(this).attr("id");
    })

    $("body").on("click", ".forum_button", function() {
        localStorage.setItem("forum_id", $(this).attr("id"));
        window.location = base_url + "foruns/forum/" + $(this).attr("id");
    })

    $("body").on("click", ".add_event", function() {
        var hour_id = $(this).attr("id");
        localStorage.setItem("hour_" + hour_id, hour_id);
        $("#" + hour_id + ".add_event").hide();
        addEvent(hour_id);
    })

    $("body").on("click", ".filearea-button", function() {
        window.location = base_url + "subjects/ficheiros/" + localStorage.cadeira_code + "/" + ano;
    })

    
});

function setID(newid){
    id = newid;
    localStorage.setItem("cadeira_id", id);
}

function setCode(newcode){
    code = newcode;
    localStorage.setItem("cadeira_code", code);
}

function getInfo() {
    $.ajax({
        type: "GET",
        headers: {
            "Authorization": localStorage.token
        },
        url: base_url + "api/getCadeira/" + id,
        data: {user_id: localStorage.user_id},
        success: function(data) {
            console.log(data)

            var color = convertHex(data.desc[0].color, 52);

            $("#subject_title").append("<h1>" + data.desc[0].name + "</h1>");
            if(data.desc[0].description == "") {
                $(".summary").append("<p>Não existe sumário para a cadeira.</p>");
            } else {
                $(".summary").append("<p>" + data.desc[0].description + "</p>");
            }

            var image_url = base_url + "images/subjects/project_pattern.jpg";
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

            var image_url = base_url + "images/icons/add_event.png";
            $(".hours").empty();
            if(data['hours'].length != 0) {
                for(var i=0; i < data['user'].length; i++) {
                    var flag = false;
                    for(var j=0; j < data['evento'].length; j++) {
                        if(data['evento'][j][0].horario_id != data.hours[i].id) {
                            flag = false;
                        } else {
                            flag = true;
                            break;
                        }
                    }

                    if(flag) {
                        $(".hours").append("<div><p><b>" + 
                        data.user[i].name + " " + data.user[i].surname + ":</b> " + 
                        data.hours[i].day + " " + data.hours[i].start_time.substring(0, 5) + " - " + 
                        data.hours[i].end_time.substring(0, 5) + "</p></div>");
                    } else {
                        $(".hours").append("<div><p><b>" + 
                        data.user[i].name + " " + data.user[i].surname + ":</b> " + 
                        data.hours[i].day + " " + data.hours[i].start_time.substring(0, 5) + " - " + 
                        data.hours[i].end_time.substring(0, 5) + "<span>" +
                        "<img src='" + image_url + "' class='add_event' id='" + data.hours[i].id + "'></span></p></div>");
                    }                  
                }
            } else {
                $(".hours").append("<p>Ainda não há horários de dúvidas disponíveis.</p>");
            }
        },
        error: function(data) {
            alert("Houve um erro ao ir buscar a informação da cadeira.");
        }
    });
}

function addEvent(hours_id) {
    $.ajax({
        type: "POST",
        headers: {
            "Authorization": localStorage.token
        },
        url: base_url + "api/addEvent/" + hours_id,
        success: function(data) {
            console.log(data)
            $("#message_hour_s").fadeTo(2000, 1);
            setTimeout(function() {
                $("#message_hour_s").fadeTo(2000, 0);
            }, 2000);
        },
        error: function(data) {
            console.log(data)
            console.log("ups")
        }
    })
}

function insertLoggedDate(id) {
    $.ajax({
        type: "POST",
        headers: {
            "Authorization": localStorage.token
        },
        url: base_url + "api/insertDate/" + id + "/student",
        success: function(data) {
            console.log(data)
        },
        error: function(data) {
            alert("Houve um erro ao ir buscar a informação das cadeiras lecionadas.");
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