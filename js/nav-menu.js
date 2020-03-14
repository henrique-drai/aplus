$(document).ready(() => {
    setUserInfo()
})

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
    if (localStorage.profile_pic && fileExists(base_url + "uploads/profile/"+localStorage.profile_pic)){
        user_picture_href = base_url + "uploads/profile/"+localStorage.profile_pic
    }
    let img = $("<img src='" + user_picture_href + "' alt='Profile Picture'>")
    let hover = $("<div class='nav-menu-profile-picture-hover'>Edit</div>")
    let a = $("<a href='"+base_url+"app/profile'></a>")
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
        url: base_url + "api/user/getInfo",
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
        url: base_url + "api/user/logout",
        success: function(data) {
            localStorage.removeItem("profile_pic")
            localStorage.removeItem("token")
            localStorage.removeItem("user_id")
            window.location.href = base_url + "app/auth/login"
        },
        error: function(data) {
            console.log("Problema na API: O logout deu erro.")
        }
    })
}