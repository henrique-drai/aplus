

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
    console.log("Will show default picture if error occurs.")
    if (fileExists(base_url + "uploads/profile/"+localStorage.profile_pic)){
        user_picture_href = base_url + "uploads/profile/"+localStorage.profile_pic
    }
    return $("<img class='nav-menu-profile-picture' src='" + user_picture_href + "' alt='Profile Picture'>")
}

function getNavBarUserSection(){
    let user_section = $("<div class='nav-menu-user-section'></div>")
    user_section.append(getNavBarProfilePic())
    user_section.append("<div class='nav-menu-user-name'>Loading...</div>")
    return user_section
}

function loadNavBarUserInfo(){
    $.ajax({
        type: "POST",
        url: base_url + "api/getUserInfo",
        data: {user_id: localStorage.user_id},
        success: function(data) {
            data = JSON.parse(data)
            $(".nav-menu-user-name").html(data.name + " " + data.surname)
        },
        error: function(data) {
            console.log("Problema na API (getUserInfo)")
            console.log(data)
        }
    })
} 