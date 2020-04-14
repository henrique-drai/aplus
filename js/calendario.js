var calendario = {}



$(document).ready(()=>{
    generateDays()
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
            setCalendario(data)
            renderCalendario()
        },
        error: function(data) {
            console.log("Problema na API ao buscar o calendário.")
            console.log(data)
        }
    })
}

function setCalendario(data){
    //console.log(data)

    calendario.eventos = []
    calendario.cores = {}

    for (const c of data.classes){
        calendario.eventos.push({start_time: c.start_time, type: "class", obj: c})
    }
    for (const e of data.events)
        calendario.eventos.push({start_time: new Date(e.start_date), type: "event", obj: e})
    
    for (const ge of data.group_events)
        calendario.eventos.push({start_time: new Date(ge.start_date), type: "group", obj: ge})

    for (const s of data.submissions)
        calendario.eventos.push({start_time: new Date(s.deadline), type: "submission", obj: s})

    //calendario.eventos.sort((x)=>(x.start_time))
    console.log(calendario)
    
}

function addDays(date, days) {
    var result = new Date(date);
    result.setDate(result.getDate() + days);
    return result;
  }

//   eventos: [
// 	{
// 		start_time: "",
// 		type: "",
// 		obj: {

// 		}
// 	}
// ]

function generateDays(){
    calendario.days = []

    current = new Date(); calendario.days.push(current)

    var i = 1; for (; i<30; i++)
        current = addDays(current, 1); calendario.days.push(current)
}