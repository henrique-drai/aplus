var calendario = {
    state: {

    }
}

$(document).ready(()=>{
    updateCalendario()
})

function renderCalendario(){
    let link = $("<a href='#'>In Development (abram a consola para ver o progresso)</a>")


    const outter = $('<div class="outter"></div>').append(link)
    $("#calendario-hook").html(outter)
}

function updateCalendario(){
    $.ajax({
        type: "POST",
        headers: {"Authorization": localStorage.token},
        url: base_url + "user/api/getCalendario",
        success: function(data) {
            console.log(data)
            setCalendario(data)
            renderCalendario()
        },
        error: function(data) {
            console.log(data)
            console.log("Problema na API ao buscar o calendário.")
        }
    })
    
}

function setCalendario(data){
    
}