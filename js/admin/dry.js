$(document).ready(() => {
      
})



function kek () {
    $.ajax({
        type: "POST",
        headers: {
            "Authorization": localStorage.token
        },
        url: base_url + "api/user/teste",
        data: {
            "fake":"taxi"
        },
        success: function(data) {
            console.log(data)
        },
        error: function(data) {
            console.log("Erro na API:")
            console.log(data)
        }
    });
}
