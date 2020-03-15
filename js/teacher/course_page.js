$(document).ready(() => {
    getInfo(localStorage.cadeira_id);
})

function getInfo($id) {
    $.ajax({
        type: "POST",
        url: base_url + "teacher/api/getDescription",
        data: {cadeira_id: $id},
        success: function(data) {
            $("#course_title").append("<h1>" + data.info[0].name + "</h1>");
            $("#summary").append("<p>" + data.info[0].description + "</p>");
        },
        error: function(data) {
            alert("error");
        }
    });
}