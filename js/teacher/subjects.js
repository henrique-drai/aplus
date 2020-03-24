$(document).ready(() => {
    showCadeiras();

    $("body").on("click", "a", function() {
        localStorage.setItem("cadeira_code", $(this).attr("id"));
        window.location = base_url + "subjects/subject/" + $(this).attr("id");
    })
})

function showCadeiras() {
    console.log(localStorage.user_id);
    $.ajax({
        type: "POST",
        url: base_url + "teacher/api/getCadeiras",
        data: {id: localStorage.user_id},
        success: function(data) {
            for(var i = 0; i < data.cadeiras_id.length; i++) {
                show(data.cadeiras_id[i].cadeira_id);
            }

            var result = $(".cadeiras a").sort(function(a,b) {
                console.log("entrou")
                var contentA = parseInt( $(a).data('sort'));
                var contentB = parseInt( $(b).data('sort'));
                return (contentA < contentB) ? -1 : (contentA > contentB) ? 1 : 0;
            })

            $(".cadeiras").html(result);
        },
        error: function(data) {
            alert("Houve um erro ao ir buscar a informação das cadeiras lecionadas.");
        }
    });
}

function show($var) {
    var image_url = base_url + "uploads/profile/edu.jpg";
    $.ajax({
        type: "POST",
        url: base_url + "teacher/api/getCadeiraInfo",
        data: {cadeira_id: $var},
        success: function(data) {
            var url = base_url + "subjects/subject/" + data.info[0].code;
            $(".cadeiras").append("<a data-sort='" + data.info[0].code + "' id='" + data.info[0].code + "' href='" + url +
            "'><div class='card_info'><img src=" + image_url + "><div class='subject'>" +
            "<div id='title'>Tecnologias de Informação</div><div>" + data.info[0].code + ": " +
            data.info[0].name + "</div></div></div></a>");
        },
        error: function(data) {
            alert("Houve um erro a mostrar as cadeiras.");
        }
    })
}