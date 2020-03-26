$(document).ready(() => {
    TeacherNavMenu();
})

function TeacherNavMenu() {
    let container = $("<div id='nav-menu-container'></div>")

    const pages = {
        "home": {
            "href": base_url + "app",
            "name": "Painel de Controlo"
        },
        "subjects": {
            "href": base_url + "subjects",
            "name": "Cadeiras"
        }
    }

    container.append(getNavBarUserSection())
    container.append("<hr>")
    container.append(getNavBarLinks(pages))
    $("#nav-menu-hook").append(container)

    loadNavBarUserInfo();
}

