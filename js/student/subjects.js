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
            $(".semestre1").empty();
            $(".semestre2").empty();

            if(data.cadeiras_id.length != 0) {
                var image_url = base_url + "uploads/pattern.jpg";
                $(".semestre1").append("<h3>1º Semestre</h3>");
                $(".semestre2").append("<h3>2º Semestre</h3>");

                for(var i = 0; i < data.cadeiras_id.length; i++) {
                    var url = base_url + "subjects/subject/" + data.info[i][0].code + "/" + data.year[0].inicio;
                    var color = convertHex(data.info[i][0].color, 52);

                    if(data.info[i][0].semestre == 0) {
                        $(".semestre1").append("<a id='" + data.info[i][0].code + "' href='" + url + 
                        "'><div class='card_info'><div class='color' style='background-image: linear-gradient(to bottom, " + color + ", " + color + ")," +
                        "url(" + image_url + "); height: 69%;'></div><div class='subject'>" +
                        "<div id='title'>Tecnologias de Informação</div><div>" + data.info[i][0].code + ": " +
                        data.info[i][0].name + "</div></div></div></a>");
                    } else {
                        $(".semestre2").append("<a id='" + data.info[i][0].code + "' href='" + url + 
                        "'><div class='card_info'><div class='color' style='background-image: linear-gradient(to bottom, " + color + ", " + color + ")," +
                        "url(" + image_url + "); height: 69%;'></div><div class='subject'>" +
                        "<div id='title'>Tecnologias de Informação</div><div>" + data.info[i][0].code + ": " +
                        data.info[i][0].name + "</div></div></div></a>");
                    }                    
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

function convertHex(hex,opacity){

    hex = hex.replace('#','');
    r = parseInt(hex.substring(0,2), 16);
    g = parseInt(hex.substring(2,4), 16);
    b = parseInt(hex.substring(4,6), 16);

    result = 'rgba('+r+','+g+','+b+','+opacity/100+')';
    return result;

}