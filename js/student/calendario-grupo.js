var calendario = {}

$(document).ready(()=>{
    updateCalendario()
    eventOnClickCalendario()
})

function updateCalendario(){
  $.ajax({
      type: "GET",
      url: base_url + "api/grupo/"+localStorage.grupo_id+"/calendario",
      success: function(data) {
          setCalendario(data)
          renderCalendario()
          // console.log(data)
          console.log(calendario)
      },
      error: function(data) {
          console.log("Problema na API ao buscar o calendário.")
          console.log(data)
      }
  })
}

function renderCalendario(){
    // console.log(calendario)
    let cols = []
    let ctr = 0

    for (const day of calendario.days){
        let head_day = $('<div class="day">'+day.getDate()+'</div>')
        let head_week = $('<div class="week">'+week_days[day.getDay()].sigla+'</div>')
        let head = $('<div class="hcell"></div>').append(head_day,head_week)

        let cells = []

        for(const event of calendario.events)
        {
            if (event.start_time.getDate() == day.getDate())
            {
                let start, desc, end, time
                let cell = $('<div class="cell"></div>')

                switch(event.type)
                {                    
                    case "group":
                        start = $('<div class="start">'+getTimeString(new Date(event.obj.start_date))+'</div>')
                        desc = $('<div class="desc">'+event.obj.name+'</div>')
                        end = $('<div class="end">'+getTimeString(new Date(event.obj.end_date))+'</div>')
                        break

                    case "submit":
                        start = $('<div class="start">'+getTimeString(new Date(event.obj.deadline))+'</div>')
                        desc = $('<div class="desc">'+event.obj.nome+' (Entrega)</div>')
                        break
                }

                const clickable = $("<div class='clickable' id='" + ctr + "'></div>")
                cell.append(start,desc,end,clickable)
                cells.push(cell)
                ctr+=1
            }
        }

        let col = $('<div class="col"></div>').append(head, cells)
        cols.push(col)
    }

    let inner = $('<div class="inner"></div>').append(cols)
    $("#calendario-hook").html(inner)
}

function setCalendario(data){
    calendario.events = []
    
    for (const ge of data.group_events)
        calendario.events.push({start_time: new Date(ge.start_date), type: "group", obj: ge})

    for (const s of data.submissions)
        calendario.events.push({start_time: new Date(s.deadline), type: "submit", obj: s})

    calendario.events.sort((x,y)=>(x.start_time.getTime() - y.start_time.getTime()))

    calendario.days = []

    for (const event of calendario.events){
        calendario.days.push(event.start_time)
    }
}


function getTimeString(time){
    h = time.getHours()
    m = time.getMinutes()
    return ((h < 10)? "0" + h : h) + ":" + ((m < 10)? "0" + m : m)
}

function eventOnClickCalendario(){
    $('#calendario-hook').on('click', '.cell .clickable', function(event){

        event = calendario.events[parseInt(event.target.id)]
        
        let message = $('<div class="calendario-msg"></div>')

        switch(event.type)
        {            
            case "group":
                message.append("<h3>"+event.obj.name+"</h3>")
                message.append("<p>" + event.obj.description + "</p>")
                message.append("<p>" +
                    getTimeString(new Date(event.obj.start_date)) + " - " +
                    getTimeString(new Date(event.obj.end_date)) + "</p>")
                message.append("<p>Localização: " + event.obj.location + "</p>")
                $(".cd-popup #actionButton").html("Não Vou").off()
                    .click(()=>{ajaxNotGoing(event.obj.evento_id)})
                break
            
            case "submit":
                message.append("<h3>"+event.obj.nome+" (entrega de "+event.obj.name+")</h3>")
                message.append("<p>" + event.obj.description + "</p>")
                $(".cd-popup #actionButton").html("Visitar Projeto").off().click(()=>{
                    window.location.href = base_url + "projects/project/" + event.obj.projeto_id
                })
                break
        }

        $(".cd-popup #closeButton").html("Fechar")
        $('.cd-message').html(message)
        $('.cd-popup').addClass('is-visible')
    });


}



function ajaxDeleteEventById(event_id){
    $.ajax({
        type: "DELETE",
        url: base_url + "api/event/" + event_id,
        success: function(data) {
            //console.log(data)
            updateCalendario()
            $('.cd-popup').removeClass('is-visible')
        },
        error: function(data) {
            console.log("Couldn't delete the event:")
            console.log(data)
        }
    })
}

function ajaxNotGoing(event_id){
    $.ajax({
        type: "DELETE",
        url: base_url + "api/event/going/" + event_id,
        success: function(data) {
            //console.log(data)
            updateCalendario()
            $('.cd-popup').removeClass('is-visible')
        },
        error: function(data) {
            console.log("Couldn't cancel event:")
            console.log(data)
        }
    })
}

function insertEvent(){
    $.ajax({
        type: "POST",
        url: base_url + "api/grupo/"+localStorage.grupo_id+"/evento",
        data: {
            name: $('input[name="dateEvento"]').val(),
            description: $('input[name="descEvento"]').val(),
            date: $('input[name="dateEvento"]').val(),
            location: $('input[name="localEvento"]').val()
        },
        success: function(data) {
            
        },
        error: function(data) {
            console.log("Erro ao criar um evento de grupo:")
            console.log(data)
        }
    });
    
}