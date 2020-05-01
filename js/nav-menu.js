var navbar_is_active = false

var notifications = []

$(document).ready(() => {
    $(".nav-menu-btn-logout").click(() => {endSession()})
    $("#nav-menu-toggle").click(()=>{toggleMenu()})
    $(".btn-notifications").click(()=>{toggleNotifications()})
    updateNavMenuData()
    updateNotifications()
})

// assim só precisam de indicar as páginas que vão estar disponíveis
// exemplo de utilização: js/teacher/nav-menu.js
function printNavBarLinks(pages){
    let link_list = $("#nav-menu-links")

    for (const key in pages) {
        const className = (key == page_name) ? " class='nav-menu-selected-link'" : ""
        let li = $("<li"+className+">"+pages[key].name+"</li>")
        let link = $("<a href='"+pages[key].href+"'></a>")
        link_list.append(link.append(li))
    }
}

function toggleMenu(){
    if(navbar_is_active){
        $("#nav-menu-hook").removeClass('active')
        $("#nav-menu-container").removeClass('active')
        $("#nav-menu-toggle").text(">")
    } else {
        $("#nav-menu-hook").addClass('active')
        $("#nav-menu-container").addClass('active')
        $("#nav-menu-toggle").text("<")
    }
    navbar_is_active = !navbar_is_active
}

function endSession(){
    $.ajax({
        type: "POST",
        headers: {"Authorization": localStorage.token},
        url: base_url + "api/logout",
        success: function(data) {
            localStorage.removeItem("token")
            localStorage.removeItem("user_id")
            window.location.href = base_url
        },
        error: function(data) {
            console.log("Problema na API: O logout deu erro.")
        }
    })
}

function updateNavMenuData(){
    $.ajax({
        type: "GET",
        headers: {"Authorization": localStorage.token},
        url: base_url + "api/user",
        success: function(data) {
            const obj = JSON.parse(data)
            $(".nav-menu-user-name").text(obj.name + " " + obj.surname)
        },
        error: function(data) {
            console.log("Problema na API: api/user get.")
        }
    })
}

function updateNotifications(){
    $.ajax({
        type: "GET",
        headers: {"Authorization": localStorage.token},
        url: base_url + "api/notifications/new",
        success: function(data) {
            notifications = data
            
            if(data.length)
                $("#nav-menu-hook .alert").removeClass("hidden").text(data.length)
            else
                $("#nav-menu-hook .alert").addClass("hidden")  

            renderNotifications()
        },
        error: function(data) {
            console.log("Problema na API: notifications.")
        }
    })
}

function renderNotifications(){

    function getDate(date){
        const diff = Date.now() - new Date(date)

        if (diff < 1000*60*60*24)
            return "Há "+Math.floor(diff/1000/60/60)+" horas"

        return "Há "+Math.floor(diff/1000/60/60/24)+" dias"
    }

    let divs = []
    
    for (const n of notifications) {
        let img

        switch(n.type){
            case "message":
                img = $('<img src="' + base_url + 'images/icons/message.png" alt="Message Notification">')
                break
            case "alert":
                img = $('<img src="' + base_url + 'images/icons/alert.png" alt="Alert Notification">')
                break
            default: break
        }
        
        divs.push(
            $('<div class="notification"></div>').append(
                $('<div class="icon"></div>').append(img),
                $('<div class="body"></div>').append(
                    $('<a href="' + base_url + n.link + '"></a>').append(
                        $("<div></div>").append(
                            $('<div class="title">' + n.title + '</div>'),
                            $('<div class="content">' + n.content + '</div>'),
                            $('<div class="date">' + getDate(n.date) + '</div>')
        )))))
    }

    $(".nav-notifications").html(divs)
}

function toggleNotifications(){
    if($(".nav-notifications").hasClass("hidden"))
        $(".nav-notifications").removeClass("hidden")
    else
        $(".nav-notifications").addClass("hidden")
}