$(document).ready(() => {
    getInfo(localStorage.getItem("forum_id"));
})

function getInfo(id) {
    $.ajax({
        type: "GET",
        headers: {
            "Authorization": localStorage.token
        },
        url: base_url + "teacher/api/getForumInfo",
        data: {forum_id: id},
        success: function(data) {
            $(".forumName").append(data.info[0].name);
            $(".forumDesc").append(data.info[0].description);
        },
        error: function(data) {
            console.log("Erro na API:")
            console.log(data)
        }
    })
}