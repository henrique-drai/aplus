var agenda = {}

$(document).ready(()=>{
  generateAgendaDays()
  updateAgenda()
})


function renderAgenda(){
  $("#nav-menu-agenda").html("<p>Agenda</p>")

  
  let cols = []
  let ctr = 0

  for (const day of agenda.days){
    let head_day = $('<div class="day">'+week_days[day.getDay()].name+', '+day.getDate()+'</div>')
    let head = $('<div class="hcell"></div>').append(head_day)

    let cells = []
    
    for(const event of agenda.events)
    {
      if (event.start_time.getDate() == day.getDate())
      {
        let cell = $('<div class="cell"></div>')

        switch(event.type)
        {
          case "group":
          case "event":
            cell.append($('<div class="time">'+getTimeString(new Date(event.obj.start_date))+'</div>'))
            cell.append($('<div class="desc">'+event.obj.name+'</div>'))
            break
          
          case "submit":
            cell.append($('<div class="time">'+getTimeString(new Date(event.obj.deadline))+'</div>'))
            cell.append($('<div class="desc">'+event.obj.nome+' (Entrega de '+event.obj.sigla+')</div>'))
            break
        }
        cells.push(cell)
        ctr+=1
      }
    }

    if (cells.length){
      let col = $('<div class="col"></div>').append(head, cells)
      cols.push(col)
    }
  }

  if (!cols.length) {
    $("#nav-menu-agenda").append("<div class='nothing'>Não tem eventos próximos.</div>")
  } else {
    let inner = $('<div class="inner"></div>').append(cols)
    $("#nav-menu-agenda").append(inner)
  }
}

function updateAgenda(){
    $.ajax({
        type: "GET",
        headers: {"Authorization": localStorage.token},
        url: base_url + "api/agenda",
        success: function(data) {
            setAgenda(data)
            renderAgenda()
            //console.log(agenda)
        },
        error: function(data) {
            console.log("Problema na API ao buscar a agenda.")
            console.log(data)
        }
    })
}

function setAgenda(data){
    agenda.events = []

    for (const e of data.events)
      agenda.events.push({start_time: new Date(e.start_date), type: "event", obj: e})
    
    for (const ge of data.group_events)
      agenda.events.push({start_time: new Date(ge.start_date), type: "group", obj: ge})

    for (const s of data.submissions)
      agenda.events.push({start_time: new Date(s.deadline), type: "submit", obj: s})

    agenda.events.sort((x,y)=>(x.start_time.getTime() - y.start_time.getTime()))
}

function generateAgendaDays(){
    agenda.days = []
    let curr = new Date(); agenda.days.push(curr)
    var i = 1; for (; i<7; i++){
        curr = addDays(curr, 1); agenda.days.push(curr)
    }
}

function getTimeString(time){
    h = time.getHours(); m = time.getMinutes()
    return ((h < 10)? "0" + h : h) + ":" + ((m < 10)? "0" + m : m)
}