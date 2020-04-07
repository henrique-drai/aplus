var navbar_is_active = false

$(document).ready(() => {
    $(".nav-menu-btn-logout").click(() => {endSession()})
    $("#nav-menu-toggle").click(()=>{toggleMenu()})
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
            localStorage.removeItem("profile_pic")
            localStorage.removeItem("token")
            localStorage.removeItem("user_id")
            window.location.href = base_url
        },
        error: function(data) {
            console.log("Problema na API: O logout deu erro.")
        }
    })
}