var id
var code

$(document).ready(() => {
    getInfo();

    $("body").on("click", ".project_button", function() {
        window.location = base_url + "projects/project/" + $(this).attr("id");
    })

    $("body").on("click", ".new_forum", function() {
        window.location = base_url + "foruns/new/" + localStorage.cadeira_code + "/" + ano;
    })

    $("body").on("click", ".forum_button", function() {
        localStorage.setItem("forum_id", $(this).attr("id"));
        window.location = base_url + "foruns/forum/" + $(this).attr("id");
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
        url: base_url + "student/api/getInfo",
        data: {cadeira_id: id},
        success: function(data) {
            console.log(data);

            $("#subject_title").append("<h1>" + data.desc[0].name + "</h1>");
            if(data.desc[0].description == "") {
                $(".summary").append("<p>Não existe sumário para a cadeira.</p>");
            } else {
                $(".summary").append("<p>" + data.desc[0].description + "</p>");
            }

            $(".projetos").empty();
            if(data.proj.length == 0) {
                $(".projetos").append("<p>Ainda não existem projetos para a cadeira</p>");
            } else {
                for(var i=0; i < data.proj.length; i++) {
                    $(".projetos").append("<input type='button' class='project_button' id='" + data.proj[i].id +
                    "' value='Projeto " + (i+1) + "'>");
                }  
            }

            $(".foruns").empty();
            if(data.forum.length == 0) {
                $(".foruns").append("<p>Ainda não existem fóruns para a cadeira</p>");
            } else {
                for(var i=0; i < data.forum.length; i++) {
                    $(".foruns").append("<input type='button' class='forum_button' id='" + data.forum[i].id +
                    "' value='" + data.forum[i].name + "'>");
                }  
            }

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
            alert("Houve um erro ao ir buscar a informação da cadeira.");
        }
    });
}