var navbar_is_active = false

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

$(document).ready(() => {
    $(".nav-menu-btn-logout").click(() => {endSession()})
    $("#nav-menu-toggle").click(()=>{toggleMenu()})
    $(".btn-notifications").click(()=>{toggleNotifications()})
    
    updateNavMenuData()
    updateNotifications()
    setInterval(updateNotifications, 5000)

    function toggleNotifications(){
        if($(".nav-notifications").hasClass("hidden"))
            $(".nav-notifications").removeClass("hidden")
        else
            $(".nav-notifications").addClass("hidden")
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
            url: base_url + "api/notifications/new",
            success: function(data) {
                if(data.length) {
                    $("#nav-menu-hook .alert").removeClass("hidden").text(data.length)
                    $("#mobile-navbar .alert").removeClass("hidden").text(data.length)
                } else {
                    $("#nav-menu-hook .alert").addClass("hidden")
                    $("#mobile-navbar .alert").addClass("hidden")  
                }
                renderNotifications(data)
            },
            error: function(data) {
                console.log("Problema na API: notifications.")
            }
        })
    }

    function renderNotifications(notifications){

        async function notificationSeen(id, callback=null){
            $.ajax({
                type: "POST",
                url: base_url + "api/notification/" + id,
                success: function(data) {
                    console.log(data)
                    if(callback)
                        callback()
                    },
                error: function(data) {
                    console.log("Problema em api/notification/seen POST")
                    }
            })
        }
    
        function getDate(date) {
            const diff = new Date() - new Date(date) + 3600000
        
            if (diff < 1000*60*60) 
                return "Há "+Math.floor(diff/1000/60)+" minutos"
            if (diff < 1000*60*60*24)
                return "Há "+Math.floor(diff/1000/60/60)+" horas"
        
            return "Há "+Math.floor(diff/1000/60/60/24)+" dias"
        }
    
        if(!notifications.length){
            $(".nav-notifications").html($('<div class="nothing">Não tem notificações novas.</div>'))
        }
        else {
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
                                )
                            ).click((e)=>{
                                // e.preventDefault()
                                notificationSeen(n.id)
                            })
                        )  
                    )
                )
            }
    
            $(".nav-notifications").html(divs)
        }
    
        $(".nav-notifications").append(
            $('<div class="see-more"></div>').append(
                $('<a href="' + base_url + 'app/notifications"></a>').append(
                    $('<div>VER TODAS</div>')
                )
            )
        )
    }
})











