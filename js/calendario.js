var calendario = {}

$(document).ready(()=>{
    generateDays()
    updateCalendario()
    eventOnClick()
})


function renderCalendario(){
    
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
                    case "class":
                        start = $('<div class="start">'+getClassTimeString(event.obj.start_time)+'</div>')
                        desc = $('<div class="desc">'+event.obj.sigla+' ('+event.obj.type+')</div>')
                        end = $('<div class="end">'+getClassTimeString(event.obj.end_time)+'</div>')
                        cell.css("background-color",calendario.cores[event.obj.cadeira_id])
                        break
                    
                    case "group":
                        start = $('<div class="start">'+getTimeString(new Date(event.obj.start_date))+'</div>')
                        desc = $('<div class="desc">'+event.obj.name+'</div>')
                        end = $('<div class="end">'+getTimeString(new Date(event.obj.end_date))+'</div>')
                        break

                    case "event":
                        start = $('<div class="start">'+getTimeString(new Date(event.obj.start_date))+'</div>')
                        desc = $('<div class="desc">'+event.obj.name+'</div>')
                        end = $('<div class="end">'+getTimeString(new Date(event.obj.end_date))+'</div>')
                        break
                    
                    case "submit":
                        start = $('<div class="start">'+getTimeString(new Date(event.obj.deadline))+'</div>')
                        desc = $('<div class="desc">'+event.obj.nome+' (Entrega de '+event.obj.sigla+')</div>')
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

function updateCalendario(){
    $.ajax({
        type: "GET",
        headers: {"Authorization": localStorage.token},
        url: base_url + "api/calendario",
        success: function(data) {
            setCalendario(data)
            renderCalendario()
            console.log(calendario)
        },
        error: function(data) {
            console.log("Problema na API ao buscar o calendário.")
            console.log(data)
        }
    })
}

function setCalendario(data){
    //console.log(data)

    calendario.events = []
    calendario.cores = {}

    for (const c of data.classes){
        for (const day of calendario.days){
            if (day.getDay() == parseInt(c.day_week)){
                let date = new Date(day)
                let time = c.start_time.split(":")
                date.setHours(parseInt(time[0]),parseInt(time[1]),0)
                calendario.events.push({start_time: date, type: "class", obj: c})
            }
        }
        if (!calendario.cores[c.cadeira_id]){
            calendario.cores[c.cadeira_id] = getRandomColor()
        }
    }
    for (const e of data.events)
        calendario.events.push({start_time: new Date(e.start_date), type: "event", obj: e})
    
    for (const ge of data.group_events)
        calendario.events.push({start_time: new Date(ge.start_date), type: "group", obj: ge})

    for (const s of data.submissions)
        calendario.events.push({start_time: new Date(s.deadline), type: "submit", obj: s})

    calendario.events.sort((x,y)=>(x.start_time.getTime() - y.start_time.getTime()))
}

function addDays(date, days) {
    var result = new Date(date);
    result.setDate(result.getDate() + days);
    return result;
  }


function generateDays(){
    calendario.days = []

    let curr = new Date(); calendario.days.push(curr)

    var i = 1; for (; i<28; i++){
        curr = addDays(curr, 1);
        calendario.days.push(curr)
    }
}


function getTimeString(time){
    h = time.getHours()
    m = time.getMinutes()
    return ((h < 10)? "0" + h : h) + ":" + ((m < 10)? "0" + m : m)
}
function getClassTimeString(time){
    return time.split(":")[0] + ":" + time.split(":")[1]
}

function getRandomColor(){
    let r,g,b
    do {
        r = Math.floor((Math.random() * 255) + 1);
        g = Math.floor((Math.random() * 255) + 1);
        b = Math.floor((Math.random() * 255) + 1);
    } while (r + g + b < 340 || 600 < r + g + b)
    return "rgba("+r+","+g+","+b+",0.5)"
}




function eventOnClick(){
    $('#calendario-hook').on('click', '.cell .clickable', function(event){
        event = calendario.events[parseInt(event.target.id)]
        console.log(event.obj)
        let message = $('<div class="calendario-msg"></div>')

        switch(event.type)
        {
            case "class":
                message.append("<h3>Aula de "+event.obj.name+" ("+event.obj.type+")</h3>")
                message.append("<p>" +
                    getClassTimeString(event.obj.start_time) + " - " +
                    getClassTimeString(event.obj.end_time) + "</p>")
                message.append("<p>Sala: " + event.obj.classroom + "</p>")
                $(".cd-popup #actionButton")
                    .html("Visitar Cadeira")
                    .off()
                    .click(()=>{
                        window.location.href = base_url + "subjects/subject/" + event.obj.code + "/" + event.obj.inicio
                    })
                break
            
            case "group":
                message.append("<h3>"+event.obj.name+"</h3>")
                message.append("<p>" + event.obj.description + "</p>")
                message.append("<p>" +
                    getTimeString(new Date(event.obj.start_date)) + " - " +
                    getTimeString(new Date(event.obj.end_date)) + "</p>")
                message.append("<p>Localização: " + event.obj.location + "</p>")
                $(".cd-popup #actionButton")
                .html("Não Vou").off()
                .click(()=>{ajaxNotGoing(event.obj.evento_id)})
                break

            case "event":
                message.append("<h3>"+event.obj.name+"</h3>")
                message.append("<p>" + event.obj.description + "</p>")
                message.append("<p>" +
                    getTimeString(new Date(event.obj.start_date)) + " - " +
                    getTimeString(new Date(event.obj.end_date)) + "</p>")
                message.append("<p>Localização: " + event.obj.location + "</p>")
                $(".cd-popup #actionButton")
                .html("Apagar Evento").off()
                .click(()=>{ajaxDeleteEventById(event.obj.evento_id)})
                break
            
            case "submit":

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
        headers: {"Authorization": localStorage.token},
        url: base_url + "api/event/" + event_id,
        success: function(data) {
            console.log(data)
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
        headers: {"Authorization": localStorage.token},
        url: base_url + "api/event/going/" + event_id,
        success: function(data) {
            console.log(data)
            updateCalendario()
            $('.cd-popup').removeClass('is-visible')
        },
        error: function(data) {
            console.log("Couldn't cancel event:")
            console.log(data)
        }
    })
}