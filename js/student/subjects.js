$(document).ready(() => {
    getCadeiras();

    $("body").on("click", "a", function() {
        var link = $(this).attr("href");
        localStorage.setItem("year", link.split("/").pop());
    })
});

function getCadeiras() {
    $.ajax({
        type: "GET",
        headers: {
            "Authorization": localStorage.token
        },
        url: base_url + "api/getCadeiras/" + localStorage.user_id + "/student",
        success: function(data) {
            console.log(data)
            $(".cadeiras").empty();

            if(data.cadeiras_id.length != 0) {
                var image_url = base_url + "uploads/pattern.jpg";

                for(var i = 0; i < data.cadeiras_id.length; i++) {
                    var url = base_url + "subjects/subject/" + data.info[i][0].code + "/" + data.year[0].inicio;
                    $(".cadeiras").append("<a id='" + data.info[i][0].code + "' href='" + url + 
                    "'><div class='card_info'><img src=" + image_url + "><div class='subject'>" +
                    "<div id='title'>Tecnologias de Informação</div><div>" + data.info[i][0].code + ": " +
                    data.info[i][0].name + "</div></div></div></a>");
                }
            } else {
                $(".cadeiras").append("<p>Ainda não tem cadeiras associadas.</p>");
            }
            
        },
        error: function(data) {
            alert("Houve um erro ao ir buscar a informação das cadeiras lecionadas.");
        }
    })
}