var navbar_is_active = false

$(document).ready(() => {
    $(".nav-menu-btn-logout").click(() => {endSession()})
    $("#nav-menu-toggle").click(()=>{toggleMenu()})
    updateNavMenuData()
})

// assim só precisam de indicar as páginas que vão estar disponíveis
// exemplo de utilização: js/teacher/nav-menu.js
function printNavBarLinks(pages)
{
    let link_list = $("#nav-menu-links");

    for (const key in pages)
    {
        const className = (key == page_name) ? " class='nav-menu-selected-link'" : ""
        let li = $("<li"+className+">"+pages[key].name+"</li>")
        let link = $("<a href='"+pages[key].href+"'></a>")
        link.append(li)
        link_list.append(link)
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
        headers: {
            "Authorization": localStorage.token
        },
        url: base_url + "auth/logout",
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
        type: "POST",
        headers: {
            "Authorization": localStorage.token
        },
        data: {user_id: localStorage.user_id},
        url: base_url + "user/api/getInfo",
        success: function(data) {
            const obj = JSON.parse(data)
            console.log(obj)
            $(".nav-menu-user-name").text(obj.name + " " + obj.surname)
            // const picture = base_url + "uploads/profile/" + obj.id + obj.picture + "?" + Date.now()
            // $(".nav-menu-profile-picture img").attr("src", picture);
        },
        error: function(data) {
            console.log("Problema na API: user/getInfo.")
        }
    })
}