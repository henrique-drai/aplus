$(document).ready(() => {
    loadProfHome();
    // setInterval(loadProfHome, 3000); 
})

function loadProfHome() {
    $.ajax({
        type: "GET",
        headers: {
            "Authorization": localStorage.token
        },
        url: base_url + "teacher/api/getProfHome",
        data: {user_id: localStorage.user_id},
        success: function(data) {
            console.log(data);

            $("#hook-num-cadeiras").text(data.ids.length);

            for(var i=0; i < data.info.length; i++) {
                $(".prof-subjects").append("<div class='subject'><p>" + data.info[i][0].name + "<p><div class='prof-stats-btn'>" +
                    "<a href='<?php echo $base_url; ?>subjects/subject/" + data.info[i][0].code +
                    "'><div>Gerir</div></a></div>");
            }
        },
        error: function(data) {
            console.log("Erro na API:")
            console.log(data)
        }
    });
}
