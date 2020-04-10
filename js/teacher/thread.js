$(document).ready(() => {
    getInfo(localStorage.getItem("thread_id"));
})

function getInfo(id) {
    $.ajax({
        type: "GET",
        headers: {
            "Authorization": localStorage.token
        },
        url: base_url + "teacher/api/getThreadInfo",
        data: {thread_id: id},
        success: function(data) {
            console.log(data);
            $(".threadName").empty();
            $(".threadDesc").empty();
            $(".threadName").append(data.title);
            $(".threadDesc").append(data.content);
        },
        error: function(data) {
            console.log("Erro na API:")
            console.log(data)
        }
    })
}