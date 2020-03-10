$(document).ready(() => {
    
    $.ajax({
        type: "POST",
        headers: {
            "Authorization": localStorage.token
        },
        url: base_url + "api/user/teste",
        data: {
            "kek":"oi"
        },
        success: function(data) {
            console.log(data)
        },
        error: function(data) {
            console.log("Erro na API:")
            console.log(data)
        }
    });
})

