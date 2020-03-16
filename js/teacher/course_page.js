$(document).ready(() => {
    getInfo(localStorage.cadeira_id);
})

function getInfo($id) {
    $.ajax({
        type: "POST",
        url: base_url + "teacher/api/getDescription",
        data: {cadeira_id: $id},
        success: function(data) {
            console.log(data.info);
            $("#course_title").append("<h1>" + data.info[0].name + "</h1>");
            $("#summary").append("<p>" + data.info[0].description + "</p>");
            getHours(data.info[0].id);
            // $('#text').html($('p').val().replace(/ /g, '&nbsp'));
        },
        error: function(data) {
            alert("error");
        }
    });
}

function getHours($id) {
    $.ajax({
        type: "POST",
    })
}