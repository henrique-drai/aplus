$(document).ready(() => {
    loadHome();
    setInterval(loadHome, 3000); 

    $("body").on("click", "a", function() {
        var link = $(this).attr("href");
        localStorage.setItem("year", link.split("/").pop());
    })
})

function loadHome() {
    $.ajax({
        type: "GET",
        url: base_url + "api/getCadeirasOrder/" + localStorage.user_id + "/" + user_role,
        success: function(data) {
            console.log(data)
            $("#subjects-hook").empty();

            if(data.cadeiras_id.length != 0) {
                var image_url = base_url + "uploads/pattern.jpg";
                $("#subjects-hook").append("<div class='cadeiras'></div>");

                for(var i = 0; i < 3; i++) {
                    var url = base_url + "subjects/subject/" + data.info[i][0].code + "/" + data.year[0].inicio;
                    var color = convertHex(data.info[i][0].color, 52);

                    $(".cadeiras").append("<a id='" + data.info[i][0].code + "' href='" + url +
                    "'><div class='card_info'><div class='color' style='background-image: linear-gradient(to bottom, " + color + ", " + color + ")," +
                    "url(" + image_url + "); height: 69%;'></div><div class='subject'>" +
                    "<div id='title'>Tecnologias de Informação</div><div>" + data.info[i][0].code + ": " +
                    data.info[i][0].name + "</div></div></div></a>");                
                }

            }
            
        },
        error: function(data) {
            console.log("Erro na API:")
            console.log(data)
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