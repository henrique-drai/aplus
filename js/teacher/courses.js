$(document).ready(() => {
    showCadeiras();
})

function showCadeiras() {
    $.ajax({
        type: "POST",
        url: base_url + "api/teacher/getCadeiras",
        data: {id: localStorage.user_id},
        success: function(data) {
            for(var i = 0; i < data.cadeiras_id.length; i++) {
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
    var image_url = base_url + "uploads/profile/bjk43v23j4nb2m.jpg";
    $.ajax({
        type: "POST",
        url: base_url + "api/teacher/getCadeiraInfo",
        data: {cadeira_id: $var},
        success: function(data) {
            console.log(data);
            $(".cadeiras").append("<a href='" + url + "'><div id='card_info'><img src=" + image_url + "><div class='course'><p id='title'>Tecnologias de Informação</p><p>" + data.info[0].code + ": " + data.info[0].name + "</p></div></div></a>");
        },
        error: function(data) {
            alert("There was an error");
        }
    })
}