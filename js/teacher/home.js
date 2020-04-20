$(document).ready(() => {
    loadProfHome();
    // setInterval(loadProfHome, 3000); 

    $("body").on("click", ".subject a", function(){
        localStorage.setItem("cadeira_code", $(this).attr("id"));
        window.location = base_url + "subjects/subject/" + $(this).attr("id") + "/" + $(this).attr("class");
    });
})

function loadProfHome() {
    $.ajax({
        type: "GET",
        headers: {
            "Authorization": localStorage.token
        },
        url: base_url + "api/getHome/" + localStorage.user_id,
        success: function(data) {
            console.log(data)
            var count = 0;
            $(".prof-subjects").empty();

            if(data.ids.length == 0) {
                $("#hook-num-cadeiras").text("Ainda não tem cadeiras associadas.");
            } else {
                $("#hook-num-cadeiras").text(data.ids.length);

                for(var i=0; i < data.info.length; i++) {
                    $(".prof-subjects").append("<div class='subject'><p>" + data.info[i][0].name + "</p><div class='prof-stats-btn'>" +
                        "<a id='" + data.info[i][0].code + "' class='" + data.year[i][0].inicio +
                        "'><div>Gerir</div></a></div>");
    
                    count = count + data.alunos[i].length;
                }
            }

            if(count == 0) {
                $("#hook-num-alunos").text("Ainda não tem alunos.");
            } else {
                $("#hook-num-alunos").text(count);
            }
        },
        error: function(data) {
            console.log("Erro na API:")
            console.log(data)
        }
    });
}
