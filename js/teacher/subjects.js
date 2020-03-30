$(document).ready(() => {
    showCadeiras();

    $("body").on("click", "a", function() {
        localStorage.setItem("cadeira_code", $(this).attr("id"));
        window.location = base_url + "subjects/subject/" + $(this).attr("id");
    })
})

function showCadeiras() {
    console.log(localStorage.user_id);
    var image_url = base_url + "uploads/pattern.jpg";
    $.ajax({
        type: "POST",
        url: base_url + "teacher/api/getCadeiras",
        data: {id: localStorage.user_id},
        success: function(data) {
            console.log(data);
            for(var i = 0; i < data.cadeiras_id.length; i++) {
                var url = base_url + "subjects/subject/" + data.info[i][0].code;
                $(".cadeiras").append("<a data-sort='" + data.info[i][0].code + "' id='" + data.info[i][0].code + "' href='" + url +
                "'><div class='card_info'><img src=" + image_url + "><div class='subject'>" +
                "<div id='title'>Tecnologias de Informação</div><div>" + data.info[i][0].code + ": " +
                data.info[i][0].name + "</div></div></div></a>");
            }
        },
        error: function(data) {
            alert("Houve um erro ao ir buscar a informação das cadeiras lecionadas.");
        }
    });
}