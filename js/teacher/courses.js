$(document).ready(() => {
    showCadeiras();

    $("body").on("click", "a", function() {
        localStorage.setItem("cadeira_id", $(this).attr("id"));
    })
})

function showCadeiras() {
    $.ajax({
        type: "POST",
        url: base_url + "teacher/api/getCadeiras",
        data: {id: localStorage.user_id},
        success: function(data) {
            for(var i = 0; i < data.cadeiras_id.length; i++) {
                console.log(data.cadeiras_id[i].cadeira_id);
                var cadeira_id = data.cadeiras_id[i].cadeira_id;
                show(cadeira_id);
            }
        },
        error: function(data) {
            alert("There was an error");
        }
    });
}

function show($var) {
    var url = base_url + "app/teacher/courses";
    var image_url = base_url + "uploads/profile/edu.jpg";
    $.ajax({
        type: "POST",
        url: base_url + "teacher/api/getCadeiraInfo",
        data: {cadeira_id: $var},
        success: function(data) {
            $(".cadeiras").append("<a id='" + data.info[0].code + "' href='" + url + "'><div id='card_info'><img src=" + image_url + "><div class='course'><div id='title'>Tecnologias de Informação</div><div>" + data.info[0].code + ": " + data.info[0].name + "</div></div></div></a>");
        },
        error: function(data) {
            alert("There was an error");
        }
    })
}