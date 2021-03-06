var calendario = {}

$(document).ready(()=>{
    generateCalendarioDays()
    updateCalendario()
    eventOnClickCalendario()
})


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
            if (event.start_time.toDateString() == day.toDateString())
            {
                let start, desc, end, time
                let cell = $('<div class="cell"></div>')

                switch(event.type)
                {
                    case "class":
                        start = $('<div class="start">'+getClassTimeString(event.obj.start_time)+'</div>')
                        desc = $('<div class="desc">'+event.obj.sigla+' ('+event.obj.type+')</div>')
                        end = $('<div class="end">'+getClassTimeString(event.obj.end_time)+'</div>')
                        cell.css("background-color", applyAlphaChannel(event.obj.color))
                        break

                    case "duvidas":
                        start = $('<div class="start">'+getClassTimeString(event.obj.start_time)+'</div>')
                        desc = $('<div class="desc">'+event.obj.sigla+' (Dúvidas)</div>')
                        end = $('<div class="end">'+getClassTimeString(event.obj.end_time)+'</div>')
                        cell.css("background-color", applyAlphaChannel(event.obj.color))
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

        if (day.getDay() == 1) {
            cols.push($("<div class='whitespace'></div>"))
        }

        let col = $('<div class="col"></div>').append(head, cells)
        cols.push(col)
    }

    let inner = $('<div class="inner"></div>').append(cols)

    $("#calendario-hook").html("")

    if(!calendario.events.length){
        $("#calendario-hook").append(
            $("<div class='no-events-msg'>Não tem eventos próximos.</div>")
        )
    }

    $("#calendario-hook").append(inner)

    function applyAlphaChannel(hex) {
        var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
        let rgb = result ? {
            r: parseInt(result[1], 16),
            g: parseInt(result[2], 16),
            b: parseInt(result[3], 16)
        } : {r: null, g: null, b: null};
        return "rgba("+rgb.r+","+rgb.g+","+rgb.b+", 0.65)"
    }
}

function updateCalendario(){
    $.ajax({
        type: "GET",
        url: base_url + "api/calendario",
        success: function(data) {
            setCalendario(data)
            renderCalendario()
            // console.log(data)
            // console.log(calendario)
        },
        error: function(data) {
            console.log("Problema na API ao buscar o calendário.")
            console.log(data)
        }
    })
}

function setCalendario(data){

    function translateWeekDay(name){
        for (const day of week_days){
            if (day.name == name){
                return day.id
            } 
        }
    }

    calendario.events = []

    for (const c of data.classes){
        for (const day of calendario.days){
            if (day.getDay() == parseInt(c.day_week)){
                let date = new Date(day)
                let time = c.start_time.split(":")
                date.setHours(parseInt(time[0]),parseInt(time[1]),0)
                calendario.events.push({start_time: date, type: "class", obj: c})
            }
        }
    }
    for (const d of data.duvidas){
        for (const day of calendario.days){
            if (day.getDay() == translateWeekDay(d.day)){
                let date = new Date(day)
                let time = d.start_time.split(":")
                date.setHours(parseInt(time[0]),parseInt(time[1]),0)
                calendario.events.push({start_time: date, type: "duvidas", obj: d})
            }
        }
    }
    for (const e of data.events)
        calendario.events.push({start_time: new Date(e.start_date), type: "event", obj: e})
    
    for (const ge of data.group_events)
        calendario.events.push({start_time: new Date(ge.start_date), type: "group", obj: ge})

    for (const s of data.submissions){
        calendario.events.push({start_time: new Date(s.deadline), type: "submit", obj: s})
    }

    calendario.events.sort((x,y)=>(x.start_time.getTime() - y.start_time.getTime()))
}


function generateCalendarioDays(){
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




function eventOnClickCalendario(){
    $('#calendario-hook').on('click', '.cell .clickable', function(event){
        console.log(event.target.id)
        console.log(calendario.events)
        event = calendario.events[parseInt(event.target.id)]
        
        let message = $('<div class="calendario-msg"></div>')

        console.log(event)

        switch(event.type)
        {
            case "class":
                message.append("<h3>Aula de "+event.obj.name+" ("+event.obj.type+")</h3>")
                message.append("<p>" +
                    getClassTimeString(event.obj.start_time) + " - " +
                    getClassTimeString(event.obj.end_time) + "</p>")
                message.append("<p>Sala: " + event.obj.classroom + "</p>")
                $(".cd-popup #actionButton").html("Visitar Cadeira").off().click(()=>{
                        window.location.href = base_url + "subjects/subject/" + event.obj.code + "/" + event.obj.inicio
                    })
                break
            
            case "duvidas":
                message.append("<h3>Horário de dúvidas de "+event.obj.name+"</h3>")
                message.append("<p>" +
                    getClassTimeString(event.obj.start_time) + " - " +
                    getClassTimeString(event.obj.end_time) + "</p>")
                message.append("<p>Faculdade: " + event.obj.siglas + "</p>")
                $(".cd-popup #actionButton").html("Visitar Cadeira").off().click(()=>{
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
                $(".cd-popup #actionButton").html("Não Vou").off()
                    .click(()=>{ajaxNotGoing(event.obj.evento_id)})
                break

            case "event":
                message.append("<h3>"+event.obj.name+"</h3>")
                message.append("<p>" + event.obj.description + "</p>")
                message.append("<p>" +
                    getTimeString(new Date(event.obj.start_date)) + " - " +
                    getTimeString(new Date(event.obj.end_date)) + "</p>")
                message.append("<p>Localização: " + event.obj.location + "</p>")
                // $(".cd-popup #actionButton").html("Apagar Evento").off()
                //     .click(()=>{ajaxDeleteEventById(event.obj.evento_id)})
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
            $("#std-message .content").text("O evento foi cancelado.")
            $("#std-message").addClass("visible")
            $("#std-message").removeClass("error")
            $("#std-message").addClass("success")
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
            $("#std-message .content").text("O evento foi atualizado.")
            $("#std-message").addClass("visible")
            $("#std-message").removeClass("error")
            $("#std-message").addClass("success")
        },
        error: function(data) {
            console.log("Couldn't cancel event:")
            console.log(data)
        }
    })
}