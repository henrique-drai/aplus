$(document).ready(() => {
    loadAdminHome();
    setTimeout(loadAdminHome(), 3000); 
})

function loadAdminHome() {
    $.ajax({
        type: "POST",
        headers: {
            "Authorization": localStorage.token
        },
        url: base_url + "admin/api/getAdminHome",
        success: function(data) {
            console.log(data)
            $("#hook-num_teachers").text(data.num_teachers)
            $("#hook-num_students").text(data.num_students)
            $("#hook-num_colleges").text(data.num_colleges)
        },
        error: function(data) {
            console.log("Erro na API:")
            console.log(data)
        }
    });
}