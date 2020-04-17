var calendario = {}

$(document).ready(()=>{
    generateDays()
    updateCalendario()
})

function renderCalendario(){
    
    let cols = []

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
                        time = event.obj.start_time.split(":")
                        start = $('<div class="start">'+time[0]+":"+time[1]+'</div>')
                        desc = $('<div class="desc">'+event.obj.sigla+' ('+event.obj.type+')</div>')
                        time = event.obj.end_time.split(":")
                        end = $('<div class="end">'+time[0]+":"+time[1]+'</div>')
                        cell.css("background-color",calendario.cores[event.obj.cadeira_id])
                        break
                    
                    case "group":
                        time = getTimeString(new Date(event.obj.start_date))
                        start = $('<div class="start">'+time+'</div>')
                        desc = $('<div class="desc">'+event.obj.name+'</div>')
                        time = getTimeString(new Date(event.obj.end_date))
                        end = $('<div class="end">'+time+'</div>')
                        break

                    case "event":
                        time = getTimeString(new Date(event.obj.start_date))
                        start = $('<div class="start">'+time+'</div>')
                        desc = $('<div class="desc">'+event.obj.name+'</div>')
                        time = getTimeString(new Date(event.obj.end_date))
                        end = $('<div class="end">'+time+'</div>')
                        break
                    
                    case "submit":
                        time = getTimeString(new Date(event.obj.deadline))
                        start = $('<div class="start">'+time+'</div>')
                        desc = $('<div class="desc">'+event.obj.nome+' (Entrega de '+event.obj.sigla+')</div>')
                        break
                }

                cell.append(start,desc,end)
                cells.push(cell)
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
        type: "POST",
        headers: {"Authorization": localStorage.token},
        url: base_url + "user/api/getCalendario",
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

function getRandomColor(){
    let r,g,b
    do {
        r = Math.floor((Math.random() * 255) + 1);
        g = Math.floor((Math.random() * 255) + 1);
        b = Math.floor((Math.random() * 255) + 1);
    } while (r + g + b < 340 || 600 < r + g + b)
    return "rgba("+r+","+g+","+b+",0.5)"
}