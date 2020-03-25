$(document).ready(() => {
    TeacherNavMenu();
})

function TeacherNavMenu() {
    let hook = $("#nav-menu-hook");

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

    hook.append(getNavBarUserSection())
    hook.append("<hr>")
    hook.append(getNavBarLinks(pages))

    loadNavBarUserInfo();
}

