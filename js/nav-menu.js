var navbar_is_active = false

$(document).ready(() => {
    setUserInfo()

    if ($("#nav-menu-hook").length) {
        $("body").append(getMobileNavBar())
    }
})

function getMobileNavBar() {
    let bar = $("<div id='mobile-navbar'></div>")
    bar.append(getToggleButton())
    return bar
}

function getToggleButton() {
    let button = $("<div id='nav-menu-toggle'>></div>")

    button.click(()=>{
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
    })
    return button
}

// assim só precisam de indicar as páginas que vão estar disponíveis
// exemplo de utilização: js/teacher/nav-menu.js
function getNavBarLinks(pages)
{
    let link_list = $("<ul></ul>");

    for (const key in pages)
    {
        const className = (key == page_name) ? " class='nav-menu-selected-link'" : ""
        let li = $("<li"+className+"></li>")
        const link = $("<a href='"+pages[key].href+"'>"+pages[key].name+"</a>")
        li.append(link)
        link_list.append(li)
    }
    return link_list
}

function getNavBarProfilePic(){
    let user_picture_href = base_url + "uploads/profile/default.jpg"
    if (localStorage.has_pic === "1"){
        user_picture_href = "http://files.luzamag.com/profile/"+localStorage.user_id+".jpg?"+Date.now()
    }
    let img = $("<img src='" + user_picture_href + "' alt='Profile Picture' crossorigin='anonymous'>")
    let hover = $("<div class='nav-menu-profile-picture-hover'>Edit</div>")
    let a = $("<a href='"+base_url+"app/profile/"+localStorage.user_id+"'></a>")
    let outter = $("<div class='nav-menu-profile-picture'></div>")
    
    outter.append(a.append(img).append(hover))
    
    return outter
}

function getNavBarUserSection(){
    let user_section = $("<div class='nav-menu-user-section'></div>")
    user_section.append(getNavBarProfilePic())
    user_section.append("<div class='nav-menu-user-name'>Loading...</div>")
    user_section.append(getLogoutBtn())
    return user_section
}

function getLogoutBtn(){
    let logout_btn = $("<div class='nav-menu-btn-logout nav-menu-btn'>Logout</div>");
    logout_btn.click(() => {
        endSession()
    })
    return logout_btn
}

function loadNavBarUserInfo(){
    $.ajax({
        type: "POST",
        url: base_url + "user/api/getInfo",
        data: {user_id: localStorage.user_id},
        success: function(data) {
            data = JSON.parse(data)
            $(".nav-menu-user-name").html(data.name + " " + data.surname)
        },
        error: function(data) {
            console.log("Problema na API: O utilizador não foi atualizado.")
        }
    })
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
            window.location.href = base_url + "landing/login"
        },
        error: function(data) {
            console.log("Problema na API: O logout deu erro.")
        }
    })
}