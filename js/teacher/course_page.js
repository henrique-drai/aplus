$(document).ready(() => {
    getInfo();
})

function getInfo() {
    $.ajax({
        type: "POST",
        url: base_url + "api/teacher/getDescription",
        data: {cadeira_id: localStorage.cadeira_id},
        success: function(data) {
            console.log(data.info);
        },
        error: function(data) {
            alert("error");
        }
    });
}