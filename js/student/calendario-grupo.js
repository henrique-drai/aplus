var calendario = {}


$(document).ready(()=>{
    updateCalendario()

    $('#calendario-hook').on('click', '.cell .clickable', function(e){
        event = calendario.events[parseInt(e.target.id)]
        
        switch(event.type){            
            case "group": renderPopupGroupEvent(event); break
            case "submit": renderPopupSubmission(event); break
            default: break
        }

        $('.cd-popup').addClass('is-visible')
    });

    $(".add-event-icon").click(()=>{
        renderPopupAddEvent()
        $('.cd-popup').addClass('is-visible')
    })
})


function updateCalendario(){
  $.ajax({
      type: "GET",
      url: base_url + "api/grupo/" + localStorage.grupo_id + "/calendario",
      success: function(data) {
          setCalendario(data)
          renderCalendario()
          console.log(data)
      },
      error: function(data) {
          console.log("Problema na API ao buscar o calendário.")
          console.log(data)
      }
  })

    function setCalendario(data){
        calendario.teachers = data.teachers

        calendario.events = []
        
        for (const ge of data.group_events)
            calendario.events.push({start_time: new Date(ge.start_date), type: "group", obj: ge})

        for (const s of data.submissions)
            calendario.events.push({start_time: new Date(s.deadline), type: "submit", obj: s})

        calendario.events.sort((x,y)=>(x.start_time.getTime() - y.start_time.getTime()))

        calendario.days = []

        for (const event of calendario.events){
            //eliminar repetições
            if (!calendario.days.length || calendario.days.slice(-1)[0].getDate() != event.start_time.getDate()){
                calendario.days.push(event.start_time)
            }
        }
    }
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
                let cell = $('<div class="cell"></div>')

                switch(event.type)
                {                    
                    case "group":
                        cell.append(
                            $('<div class="start">'+getTimeString(new Date(event.obj.start_date))+'</div>'),
                            $('<div class="desc">'+event.obj.name+'</div>'),
                            $('<div class="end">'+getTimeString(new Date(event.obj.end_date))+'</div>')
                        )
                        break

                    case "submit":
                        cell.append(
                            $('<div class="start">'+getTimeString(new Date(event.obj.deadline))+'</div>'),
                            $('<div class="desc">'+event.obj.nome+' (Entrega)</div>')
                        )
                        break
                }

                cell.append( $("<div class='clickable' id='" + ctr + "'></div>") )
                cells.push(cell)
                ctr+=1
            }
        }

        let col = $('<div class="col"></div>').append(head, cells)
        cols.push(col)
    }

    let inner = $('<div class="inner"></div>').append(cols)

    $("#calendario-hook").html("")

    if(!calendario.events.length){
        $("#calendario-hook").append(
            $("<div class='no-events-msg left'>Não tem eventos próximos.</div>")
        )
    }

    $("#calendario-hook").append(inner)

    function getTimeString(time){
        h = time.getHours()
        m = time.getMinutes()
        return ((h < 10)? "0" + h : h) + ":" + ((m < 10)? "0" + m : m)
    }
}


function renderPopupGroupEvent(event) {
    let going = $('<div class="going"></div>')
    if (event.obj.people_going.find(elem => elem.user_id == localStorage.user_id)){
        going.append(
            $('<label><input type="radio" name="going" value="true" checked />Vou</label>'),
            $('<label><input type="radio" name="going" value="false" />Não Vou</label>')
        )
    } else {
        going.append(
            $('<label><input type="radio" name="going" value="true" />Vou</label>'),
            $('<label><input type="radio" name="going" value="false" checked />Não Vou</label>')
        )
    }

    let options_section = $('<div class="options"></div>').append(
        $('<span>Convidar Professor</span>').click(()=>{
            renderPopupInviteTeachers(event)
        }),
        $('<span class="whitespace"> | </span>'),
        $('<span>Desmarcar Reunião</span>').click(()=>{
            renderPopupConfirmDeleteMeeting(event)
        })
    )

    let delete_button = $('<i class="fa fa-trash" class="delete-meeting"></i>').click(()=>{
        renderPopupConfirmDeleteMeeting(event)
    })

    let people_section = $('<div class="people"></div>')

    event.obj.people_going.forEach(element => {
        const _img = element.picture.length? element.user_id + element.picture :  "default.jpg"
        const _src = base_url + "uploads/profile/" + _img
        const _name = element.name + " " + element.surname
        people_section.append('<img class="picture" src="'+_src+'" alt="'+_name+'" />')
    });

    const _temp = (event.obj.people_going.length === 1) ? " Pessoa Vai" : " Pessoas Vão"
    people_section.append("<div class='number'>" + event.obj.people_going.length + _temp + "</div>")

    let form = $('<form id="groupEventForm" action="javascript:void(0)"></form>').append(
        $('<h3> Editar Reunião </h3>'),
        options_section,
        people_section,
        going,
        '<label><b> Assunto </b></label>',
        '<input type="text" name="name" value="' + event.obj.name + '" required>',
        '<label>Descrição</label>',
        '<input type="text" name="description" value="' + event.obj.description + '" >',
        '<label>Localização</label>',
        '<input type="text" name="location" value="' + event.obj.location + '" >',
        $('<div class="time_div"></div>').append(
            $('<label>Início</label>').append(
                $('<input type="datetime-local" name="start_date" value="' + dateToISO(event.obj.start_date) + '" required>')
            ),
            $('<label>Fim</label>').append(
                $('<input type="datetime-local" name="end_date" value="' + dateToISO(event.obj.end_date) + '" required>')
            )
        )
    ).submit((e)=>{submitPopup()})

    $('.cd-popup .cd-message').html(
        $('<div class="calendario-msg"></div>').append(form) )

    $('.cd-buttons').html('').append(
        $('<li></li>')
            .append(
                $('<input type="submit" id="actionButton" value="Guardar" form="groupEventForm" />')
                    .css("background", "#3e5d4f") ),
        $('<li><a href="#" id="closeButton">Cancelar</a></li>')
            .click( () => { $('.cd-popup').removeClass('is-visible') } )
    )



    function dateToISO (dateSQL){
        date = new Date(dateSQL)
        date.setHours(date.getHours()+1)
        isoStr = date.toISOString()
        return isoStr.substring(0,isoStr.length-1)
    }

    function dateISOtoSQL (date){
        return date.slice(0, 19).replace('T', ' ')
    }

    function submitPopup() {
        $('#actionButton').prop("disabled", true).val("A PROCESSAR")
        $.ajax({
            type: "POST",
            url: base_url + 'api/event/' + event.obj.evento_id,
            data: {
                name: $('#groupEventForm input[name="name"]').val(),
                description: $('#groupEventForm input[name="description"]').val(),
                date: $('#groupEventForm input[name="date"]').val(),
                location: $('#groupEventForm input[name="location"]').val(),
                start_date: dateISOtoSQL($('#groupEventForm input[name="start_date"]').val()),
                end_date: dateISOtoSQL($('#groupEventForm input[name="end_date"]').val()),
                going: $('input[name=going]:checked', '#groupEventForm').val(),
                
            },
            success: function(data) {
                // console.log(data)
                updateCalendario()
                $('.cd-popup').removeClass('is-visible')
            },
            error: function(data) {
                console.log("Erro ao marcar reunião:")
                console.log(data)
            }
        });
    }

    function renderPopupConfirmDeleteMeeting (event) {

        function ajaxDeleteEventById(event_id){
            $.ajax({
                type: "DELETE",
                url: base_url + "api/event/" + event_id,
                success: function(data) {
                    updateCalendario()
                    $('.cd-popup').removeClass('is-visible')
                },
                error: function(data) {
                    console.log("Couldn't delete the event:")
                    console.log(data)
                }
            })
        }

        let message = $('<div class="calendario-msg"></div>')
        message.append("<h4>Tem a certeza que pretende desmarcar a seguinte reunião?</h4>")
        message.append("<p>" + event.obj.name + "</p>")
    
        $('.cd-buttons').html('').append(
            $('<li><a href="#" id="actionButton"> Desmarcar </a></li>')
                .click( () => { ajaxDeleteEventById(event.obj.evento_id) } ),
            $('<li><a href="#" id="closeButton"> Cancelar </a></li>')
                .click( () => { renderPopupGroupEvent(event) } )
        )
        
        $('.cd-popup .cd-message').html(message)
    }

    function renderPopupInviteTeachers (event) {

        function ajaxInviteToMeeting(event_id){

            
            var ids = $('#inviteTeachersForm input:checked').map(function() {
                return this.name;
            });

            console.log(ids)
            // $.ajax({
            //     type: "DELETE",
            //     url: base_url + "api/event/" + event_id,
            //     success: function(data) {
            //         updateCalendario()
            //         $('.cd-popup').removeClass('is-visible')
            //     },
            //     error: function(data) {
            //         console.log("Couldn't delete the event:")
            //         console.log(data)
            //     }
            // })
        }

        var teachers = $('<div class="teachers"></div>')

        calendario.teachers.forEach(teacher => {
            if(! event.obj.people_going.find(person => person.user_id == teacher.user_id)) {

                const _img = teacher.picture.length? teacher.user_id + teacher.picture :  "default.jpg"
                const _src = base_url + "uploads/profile/" + _img
                const _name = teacher.name + " " + teacher.surname

                teachers.append(
                    $('<div class="teacher"></div>').append(
                        $('<input type="checkbox" name="'+teacher.user_id+'">'),
                        $('<label for="' + teacher.user_id + '"> </label>').append(
                            $('<img class="picture" src="'+_src+'" alt="'+_name+'" />'),
                            $('<div>' + _name + '</div>')
                        ),
                        $('<div class="clickable"></div>')
                            .click(()=>{
                                let checkbox = $('#inviteTeachersForm input[name="'+teacher.user_id+'"]')
                                checkbox.prop("checked", !checkbox.prop("checked"));
                            }),
                    )
                )
            }
        })

        $('.cd-popup .cd-message').html(
            $('<form id="inviteTeachersForm" action="javascript:void(0)" ></form>')
                .append(
                    "<h4>Selecione quem quer convidar:</h4>",
                    "<div class='meeting'>" + event.obj.name + "</div>",
                    teachers )
                .submit((e)=>{
                    e.preventDefault()
                    ajaxInviteToMeeting(event)
                })
        )

        $('.cd-buttons').html('').append(
            $('<li></li>')
                .append($('<input type="submit" form="inviteTeachersForm" value="Convidar" id="actionButton" />')
                    .css("background", "#3e5d4f")),
            $('<li><a href="#" id="closeButton"> Cancelar </a></li>')
                .click( () => { renderPopupGroupEvent(event) } )
        )
    }
}


function renderPopupSubmission(event) {
    let message = $('<div class="calendario-msg"></div>')
    message.append("<h3>" + event.obj.nome + " (etapa do projeto)</h3>")
    message.append("<p>" + event.obj.description + "</p>")
    message.append("<p>" + event.obj.description + "</p>")

    $('.cd-buttons').html('').append(
        $('<li></li>').append(
            $('<a href="'+base_url + "projects/project/" + event.obj.projeto_id+'" id="actionButton"> Visitar Projeto </a>')
                .css("background", "#3e5d4f") ),
        $('<li><a href="#" id="closeButton">Cancelar</a></li>')
            .click( () => { $('.cd-popup').removeClass('is-visible') } )
    )
    
    $('.cd-popup .cd-message').html(message)
}

function renderPopupAddEvent(){

    let form = $('<form id="addGroupEventForm" action="javascript:void(0)"></form>').append(
        '<h3>Nova Reunião</h3>',
        '<label><b>Assunto</b></label>',
        '<input type="text" name="name" required>',
        '<label>Descrição</label>',
        '<input type="text" name="description">',
        '<label>Localização</label>',
        '<input type="text" name="location">',
        $('<div class="time_div"></div>').append(
            $('<label>Início</label>').append(
                $('<input type="datetime-local" name="start_date" value="' + dateToISO(new Date()) + '" required>')
            ),
            $('<label>Fim</label>').append(
                $('<input type="datetime-local" name="end_date" value="' + dateToISO(new Date()) + '" required>')
            )
        )
    ).submit((e)=>{submitPopup()})

    $('.cd-popup .cd-message').html(
        $('<div class="calendario-msg"></div>').append(form))

    $('.cd-buttons').html('').append(
        $('<li></li>')
            .append(
                $('<input type="submit" id="actionButton" value="Marcar Reunião" form="addGroupEventForm" />')
                    .css("background", "#3e5d4f") ),
        $('<li><a href="#" id="closeButton">Cancelar</a></li>')
            .click( () => { $('.cd-popup').removeClass('is-visible') } )
    )

    function dateToISO (date){
        date.setHours(date.getHours()+1)
        isoStr = date.toISOString()
        return isoStr.substring(0,isoStr.length-1)
    }

    function dateISOtoSQL (date){
        return date.slice(0, 19).replace('T', ' ')
    }

    function submitPopup() {
        $('#actionButton').prop("disabled", true).val("A PROCESSAR")
        $.ajax({
            type: "POST",
            url: base_url + 'api/event/group/' + localStorage.grupo_id,
            data: {
                name: $('#addGroupEventForm input[name="name"]').val(),
                description: $('#addGroupEventForm input[name="description"]').val(),
                date: $('#addGroupEventForm input[name="date"]').val(),
                location: $('#addGroupEventForm input[name="location"]').val(),
                start_date: dateISOtoSQL($('#addGroupEventForm input[name="start_date"]').val()),
                end_date: dateISOtoSQL($('#addGroupEventForm input[name="end_date"]').val()),
            },
            success: function(data) {
                console.log(data)
                updateCalendario()
                $('.cd-popup').removeClass('is-visible')
            },
            error: function(data) {
                console.log("Erro ao marcar reunião:")
                console.log(data)
            }
        });
    }
}