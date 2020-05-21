$(document).ready(() => {
    loadAdminHome();
    setInterval(loadAdminHome, 3000); 
})

function loadAdminHome() {
    $.ajax({
        type: "GET",
        url: base_url + "api/getAdminHome",
        success: function(data) {
            $("#hook-num_teachers").text(data.num_teachers)
            $("#hook-num_students").text(data.num_students)
            $("#hook-num_colleges").text(data.num_colleges)
            $("#hook-num_courses").text(data.num_courses)
            $("#hook-num_academicYear").text(data.num_academicYear)
            $("#hook-num_subjects").text(data.num_subjects)
        },
        error: function(data) {
            console.log("Erro na API:")
            console.log(data)
        }
    });
}
