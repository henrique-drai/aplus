$(document).ready(() => {
    loadAdminHome();
    setInterval(loadAdminHome, 3000); 
})

function loadAdminHome() {
    $.ajax({
        type: "GET",
        headers: {
            "Authorization": localStorage.token
        },
        url: base_url + "admin/api/getAdminHome",
        success: function(data) {
            console.log(data)
            $("#hook-num_teachers").text(data.num_teachers)
            $("#hook-num_students").text(data.num_students)
            $("#hook-num_colleges").text(data.num_colleges)
            $("#hook-num_courses").text(data.num_courses)
        },
        error: function(data) {
            console.log("Erro na API:")
            console.log(data)
        }
    });
}
